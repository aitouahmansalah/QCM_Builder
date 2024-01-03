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
                        <input type="text" class="form-control" name="questions[${questionCounter}][options][]" value="Option 1" required>
                        <button type="button" class="btn btn-danger btn-sm" onclick="removeOption(${questionCounter}, this)">Remove</button>
                    </div>
                    <!-- Add more options as needed -->
                </div>
                <button type="button" class="btn btn-secondary" onclick="addOption(${questionCounter})">Add Option</button>
            </div>
        </div>
    `;

    document.getElementById('questions-container').insertAdjacentHTML('beforeend', questionHtml);
}

function addOption(questionIndex) {
    const optionsContainer = document.getElementById(`options-container-${questionIndex}`);
    const optionHtml = `
        <div class="option form-check mb-2">
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

    // If all options are removed, add an empty option to ensure at least one option is present
    if (optionsContainer.children.length === 0) {
        addOption(questionIndex);
    }
}

function validateFormAndSubmit() {
    // Validate correct answers for each question
    const form = document.getElementById('createExamForm');
    const questions = form.querySelectorAll('.question');

    for (const question of questions) {
        const optionsContainer = question.querySelector('[name$="[options]"]');
        const options = Array.from(optionsContainer.querySelectorAll('[name$="[options][]"]')).map(input => input.value);
        const correctAnswer = Array.from(question.querySelectorAll('[name$="[correct_answer][]"]:checked')).map(input => input.value);

        // Ensure that correct answers are valid options for the question
        const validAnswers = correctAnswer.filter(answer => options.includes(answer));

        if (validAnswers.length !== correctAnswer.length) {
            alert('Invalid correct answer for a question.');
            return; // Stop form submission
        }
    }

    // If all validations pass, submit the form
    form.submit();
}