// fichier du script score du quiz


// permet de calculer le score directement dans le nav sans devoir reload la page
function caculateQuizScore(quizId) {
    // cible le form correspondant au quiz sur lequel il y a eu un clic
    // utilise lid pour bien cibler car il peut y en avoir plusieurs
    let quizForm = document.getElementById("quiz-form-" + quizId);

    // SI le form nexiste pas, la fonction se stop
    if (!quizForm) {
        return;
    }
    // prépare les var pour le comptage des points
    let score = 0;

    // cible les questions (blocs div) notées dans le formulaire
    let allQuestions = quizForm.querySelectorAll(".ls-question-block");

    // compte les questions pour le score total
    let totalNumberOfQuestions = allQuestions.length;

    // vérifie chaque question avec une boucle foreach
    allQuestions.forEach(function (blocQuestion, index) {
        // le compte commence à 0
        // cible le nom de la question
        let questionName = 'q' + (index + 1);

        // btn radio: rond à selectionné
        // cible btn radio l'utilisateur a coché pour la question en particulier
        let userChoice = quizForm.querySelector('input[name="' + questionName + '"]:checked');

        // reboot le style par défaut (retire anciens resultats)
        blocQuestion.classList.remove('ls-correct', 'ls-wrong', 'ls-empty');

        // SI l'utilisateur a coché une réponse alors
        if (userChoice) {

            // vérifie si la valeur est 1 soit true alors
            if (userChoice.value === "1") {
                // increment +1 point au score
                score = score + 1;
                // petite bordure si cest valide
                blocQuestion.classList.add('ls-correct');
            } else {
                // SINON en cas de 0 soit false alors petite bordure rouge
                blocQuestion.classList.add('ls-wrong');
            }
        } else {
            // SINON en cas d'aucune réponse alors petite bordure orange
            blocQuestion.classList.add('ls-empty');
        }
    });

    // prépare l'affichage du score total
    let resultArea = document.getElementById("ls-results-" + quizId);

    // prépare des messages differents selon le résultat
    let message = "";
    // SI aucune erreur alors
    if (score === totalNumberOfQuestions) {
        message = "Bravo ! Vous n'avez fait aucune erreur !";
        // SINON SI la moitié des bonnes réponses alors
    } else if (score >= (totalNumberOfQuestions / 2)) {
        message = "Bravo ! Vous avez correctement répondu à au moins la moitié des questions";
        // SINON en dessous de la moitié ou moins
    } else {
        message = "Vous avez fait quelques erreurs. Révisez et retentez le quiz pour améliorer votre score !";
    }

    // met le score total dans la page
    resultArea.innerHTML = "<strong>Votre score : " + score + " / " + totalNumberOfQuestions + "</strong><br>" + message;

    // rend le score visible
    resultArea.classList.add('ls-show-result');
}