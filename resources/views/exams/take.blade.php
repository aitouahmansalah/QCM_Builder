

@extends('layouts.app')

@section('title', 'Take Exam')

@section('content')
    <div class="container mt-4">
        <h2>{{ $exam->title }}</h2>
        <h4>the Duration :{{ $exam->duration }}</h4>
        <h4>the Prof :{{ $exam->user->name }}</h4>
        <form id="Form" action="{{ route('exams.submit', $exam->id) }}" method="post">
            @csrf
            @foreach($exam->questions as $question)
                <div class="mb-4">
                    <p>{{ $question->text }}</p>
                    @foreach($question->options as $id => $option)
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="answers[{{ $question->id }}][]" value="option{{ $id +1 }}">
                            <label class="form-check-label">{{ $option }}</label>
                        </div>
                    @endforeach
                </div>
            @endforeach
            <button type="submit" class="btn btn-primary">Submit Answers</button>
        </form>
    </div>
    <script>
      
        const examDuration = {{ $exam->duration }} * 60 * 1000; 
        const submissionTime = Date.now() + examDuration;
        setTimeout(() => {
            document.getElementById('Form').submit();
        }, examDuration);

        window.addEventListener('beforeunload', (event) => {
            const remainingTime = submissionTime - Date.now();
            if (remainingTime > 0) {
                document.getElementById('Form').submit;
            }
        });
    </script>
@endsection
