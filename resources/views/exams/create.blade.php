@extends('layouts.app')

@section('title', 'Create Exam')

@section('content')
    <div class="container mt-4">
        <h2 class="mb-4">Create Exam</h2>

        <form id="createExamForm" action="{{ route('exams.store')}}" method="POST">
            @csrf
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" name="title" class="form-control" required>
            </div>
    
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea name="description" class="form-control"></textarea>
            </div>
    
            <div class="form-group">
                <label for="duration">Duration (in minutes):</label>
                <input type="number" name="duration" class="form-control" required>
            </div>
    
            <div class="form-group">
                <label for="status">Status:</label>
                <select name="status" class="form-control">
                    <option value="draft">Draft</option>
                    <option value="published">Published</option>
                </select>
            </div>

            <h4 class="mb-3">Add Questions</h4>
            <div id="questions-container">
                <div class="question mb-4 border p-3">
                    <div class="mb-3">
                        <label for="question-text" class="form-label">Question Text:</label>
                        <input type="text" name="questions[0][text]" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="options" class="form-label">Options:</label>
                        <div id="options-container-0" class="mb-2">
                            <div class="option form-check">
                                <input type="checkbox" class="form-check-input" name="questions[0][correct_answer][]" value="option1" checked>
                                <div class="container">
                                    <div class="row">
                                        <div class="col-10">
                                            <input type="text" class="form-control" name="questions[0][options][]" value="Option 1" required>
                                        </div>
                                        <div class="col-2">
                                            <button type="button" class="btn btn-danger btn-sm" onclick="removeOption(0, this)">Remove</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-secondary m-3" onclick="addOption(0)">Add Option</button>
                    </div>

                    <div class="mb-3 d-flex justify-content-center">
                        <button type="button" class="btn btn-danger" onclick="removeQuestion(this)">Remove Question</button>
                    </div>
                </div>
            </div>

            <button type="button" class="btn btn-primary" onclick="addQuestion()">Add Another Question</button>

            <button type="submit" class="btn btn-success mt-3">Create Exam</button>
        </form>
    </div>

    <script>
        let questionCounter = 1;

        function addQuestion() {
            questionCounter++;

            const questionHtml = `
                <div class="question mb-4 border p-3">
                    <hr>
                    <div class="mb-3">
                        <label for="question-text" class="form-label">Question Text:</label>
                        <input type="text" name="questions[${questionCounter}][text]" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="options" class="form-label">Options:</label>
                        <div id="options-container-${questionCounter}" class="mb-2">
                            <div class="option form-check">
                                <input type="checkbox" class="form-check-input" name="questions[${questionCounter}][correct_answer][]" value="option1" checked>
                                <div class="container">
                                    <div class="row">
                                        <div class="col-10">
                                <input type="text" class="form-control" name="questions[${questionCounter}][options][]" value="Option 1" required>
                            </div>
                <div class="col-2">
                                <button type="button" class="btn btn-danger btn-sm" onclick="removeOption(${questionCounter}, this)">Remove</button>
                            </div></div
                            <!-- Add more options as needed -->
                        </div>
                        <button type="button" class="btn btn-secondary m-2" onclick="addOption(${questionCounter})">Add Option</button>
                    </div>

                    <div class="mb-3 d-flex justify-content-center">
                        <button type="button" class="btn btn-danger" onclick="removeQuestion(this)">Remove Question</button>
                    </div>
                </div>
            `;

            document.getElementById('questions-container').insertAdjacentHTML('beforeend', questionHtml);
        }

        function addOption(questionIndex) {
            const optionsContainer = document.getElementById(`options-container-${questionIndex}`);
            const optionHtml = `
                <div class="option form-check mb-2 mt-2">
                    <input type="checkbox" class="form-check-input" name="questions[${questionIndex}][correct_answer][]" value="option${optionsContainer.children.length + 1}">
                    <div class="container">
                    <div class="row">
                    <div class="col-10">
                    <input type="text" class="form-control" name="questions[${questionIndex}][options][]" value="Option ${optionsContainer.children.length + 1}" required>
                </div>
                <div class="col-2">
                    <button type="button" class="btn btn-danger btn-sm" onclick="removeOption(${questionIndex}, this)">Remove</button>
                </div> </div>
                </div>
                </div>
            `;

            optionsContainer.insertAdjacentHTML('beforeend', optionHtml);
        }

        function removeOption(questionIndex, button) {
            const optionsContainer = button.closest('.question').querySelector(`#options-container-${questionIndex}`);
            button.closest('.option').remove();

            if (optionsContainer.children.length === 0) {
                addOption(questionIndex);
            }
        }

        function removeQuestion(button) {
            const questionContainer = button.closest('.question');
            questionContainer.remove();
        }
    </script>
@endsection
