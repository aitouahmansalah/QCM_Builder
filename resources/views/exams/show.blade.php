@extends('layouts.app')

@section('title', $exam->title)

@section('content')
    <h2>{{ $exam->title }}</h2>

    <p>{{ $exam->description }}</p>

    <h4>Questions</h4>
    <ul class="list-group">
        @foreach($exam->questions as $question)
            <li class="list-group-item">
                {{ $question->text }}
                <ul>
                    @foreach($question->options as $option)
                        <li>{{ $option }}</li>
                    @endforeach
                </ul>
            </li>
        @endforeach
    </ul>

    <a href="{{ route('exams.index') }}" class="btn btn-secondary mt-3">Back to Exams</a>
@endsection
