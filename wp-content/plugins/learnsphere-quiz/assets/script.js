// fichier du script score du quiz

// script pour la logique de test
// permet de calculer le score directement dans le nav sans reload
function checkQuiz(id) {
    let score = 0;
    let total = document.querySelectorAll("#quiz-form-" + id + " .question-block").length;
    let answers = document.querySelectorAll("#quiz-form-" + id + " input[type=\'radio\']:checked");

    // calcul le score
    answers.forEach(input => {
        if (input.value === "1") score++;
    });

    document.getElementById("quiz-result-" + id).innerHTML = "Score : " + score + " / " + total;
}

