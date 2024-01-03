<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Question;
use App\Models\Result;
use App\Models\User;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;
use Spatie\Permission\Traits\HasRoles;

class ExamController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'duration' => 'required|integer|min:1',
            'status' => 'required|in:draft,published',
            'questions' => 'required|array|min:1',
            'questions.*.text' => 'required|string|max:255',
            'questions.*.options' => 'required|array|min:1',
        ]);

        $exam = Exam::create([
            'user_id' => auth()->user()->id,
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'duration' => $request->input('duration'),
            'status' => $request->input('status'),
        ]);

        foreach ($request->input('questions') as $questionData) {
            $question = Question::create([
                'text' => $questionData['text'],
                'exam_id' => $exam->id,
                'options' => $questionData['options'],
                 'correct_answer' => $questionData['correct_answer']
            ]);
        }

        return redirect()->route('exams.index')->with('success', 'Exam created successfully!');
    }

    public function create(){
        return view('exams.create');
    }

    public function index(){
        $user = User::find(auth()->user()->id) ;
        if($user->hasRole('admin')){
        $exams = $user->exams;
        return view('index',['exams'=>$exams]);
        }else{
            $examspassed =  $user->passedExams->pluck('exam_id');
            $exams = Exam::whereNotIn('id', $examspassed)->get();
            return view('exams.student',['exams'=>$exams]);
        }
    }

    public function show(Exam $exam) {

        return view('exams.show',['exam'=>$exam]);
    }

    public function publish(Exam $exam) {
        $exam->update(['status'=>"published"]);
        return redirect()->route('exams.index');
    }

    public function delete(Exam $exam) {
        $exam->delete();
        return redirect()->route('exams.index');
    }

    public function pass(Exam $exam){
        return view('exams.take',['exam'=>$exam]);
    }

    public function submit(Request $request, Exam $exam)
    {
        $validatedData = $request;

       
        $submittedAnswers = $validatedData['answers'];

       
        $user = User::find(auth()->user()->id);

        foreach ($submittedAnswers as $questionId => $selectedOptions) {
         
            $user->responses()->create([
                'question_id' => $questionId,
                'selected_answers' => $selectedOptions,
                'exam_id'=> $exam->id,
            ]);
        }

        $score = $this->calculateResult(auth()->user(), $exam);

       
        Result::create([
            'user_id' => auth()->user()->id,
            'exam_id' => $exam->id,
            'score' => $score,
        ]);

        return redirect()->route('exams.index')->with('success', 'Exam submitted successfully!');
    }


    public function calculateResult(User $user, Exam $exam)
    {
        
        $responses = $user->responses()->whereIn('question_id', $exam->questions->pluck('id'))->get();
        $totalQuestions = $exam->questions->count();
        $correctAnswers = 0;

        foreach ($responses as $response) {
            
            $selectedOptions = $response->selected_answers;

            
            $correctOptions = $response->question->correct_answer;

            
            if (count(array_diff($selectedOptions, $correctOptions)) == 0 &&
                count(array_diff($correctOptions, $selectedOptions)) == 0) {
                $correctAnswers++;
            }
        }

       
        $score = ($correctAnswers / $totalQuestions) * 100;

        return $score;
    }

    public function result(){
         $user = User::find(auth()->user()->id);
            if($user->hasRole('admin')){
                $results = Result::with('exam', 'user')
            ->whereHas('exam', function ($query) {
                $query->where('user_id', auth()->id());
            })
            ->get();

             return view('results', compact('results'));
            }else{
     
         $results = Result::where('user_id', $user->id)->with('exam')->get();
 
         return view('exams.results', ['results' => $results]);
    }}
}
