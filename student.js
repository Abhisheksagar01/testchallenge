function displayQuestions() {
    const questionList = document.getElementById('question-list');
    constquestionList.innerHTML = '';

    for (let i = 0; i < questions.length; i++) {
        const questionDiv = document.createElement('div');
        const questionDiv.innerHTML = `<p>${questions[i].question}</p>`;

        for (let j = 0; j < questions[i].options.length; j++) {
            const questionDiv.innerHTML += `
                <input type="radio" name="q${i}" value="${j}">
                <label>${questions[i].options[j]}</label><br>
            `;
        }

        const questionList.appendChild(questionDiv);
    }
}

function submitAnswers() {
    // Collect student answers and check correctness
    const studentAnswers = [];

    for (let i = 0; i < questions.length; i++) {
        const selectedOption = document.querySelector(`input[name="q${i}"]:checked`);

        if (selectedOption) {
            const answerIndex = parseInt(selectedOption.value);
            const isCorrect = questions[i].options[answerIndex] === questions[i].correctAnswer;

            studentAnswers.push({
                question: questions[i].question,
                isCorrect
            });
        } else {
            studentAnswers.push({
                question: questions[i].question,
                isCorrect: false
            });
        }
    }

    // Display results to the student (You can customize this part)
    const resultContainer = document.getElementById('result-container');
    resultContainer.innerHTML = '<h2>Results:</h2>';

    for (let i = 0; i < studentAnswers.length; i++) {
        const resultDiv = document.createElement('div');
        resultDiv.innerHTML = `<p>${studentAnswers[i].question} - ${studentAnswers[i].isCorrect ? 'Correct' : 'Incorrect'}</p>`;
        resultContainer.appendChild(resultDiv);
    }
}

// Call displayQuestions() when the page loads.
window.onload = displayQuestions;
