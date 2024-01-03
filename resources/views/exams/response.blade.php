@extends('layouts.app')

@section('title', 'Submit Response')

@section('content')
    <h2>Submit Response</h2>

    <form action="{{ route('student_responses.store') }}" method="POST">
        @csrf
        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
        <input type="hidden" name="exam_id" value="{{ $exam->id }}">

        <h4>Questions</h4>
        @foreach($exam->questions as $question)
            <div class="form-group">
                <label>{{ $question->text }}</label>
                @foreach($question->options as $option)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="selected_answers[{{ $question->id }}][]" value="{{ $option }}">
                        <label class="form-check-label">{{ $option }}</label>
                    </div>
                @endforeach
            </div>
        @endforeach

        <button type="submit" class="btn btn-primary">Submit Response</button>
    </form>
@endsection
