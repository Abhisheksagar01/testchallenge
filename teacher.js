const questions = [];

function addQuestion() {
    const question = document.getElementById('question').value;
    const options = [
        document.getElementById('option1').value,
        document.getElementById('option2').value,
        document.getElementById('option3').value,
        document.getElementById('option4').value
    ];
    const correctAnswer = document.getElementById('correct-answer').value;

    questions.push({
        question,
        options,
        correctAnswer
    });

    // Clear the form
    document.getElementById('question-form').reset();
}
