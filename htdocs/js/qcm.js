const blockReponses = document.querySelector('.reponses');
const reponses = document.querySelectorAll('.reponse');
const question = document.querySelector('.question');
const suivant = document.querySelector('#suivant');
const testo = document.querySelector('.testo');
const timebar = document.querySelector('#progress');
let markValidity = 0;
let markIterator = 0;
let score = 0;

// Contient le parametre get et sa valeur
let getParameters = window.location.search.substr(1).split('=');

if (getParameters.length > 2) {
    throw new Error('Les paramètres GET ne sont pas ceux attendus.');
}
if (getParameters[0] != 'theme' && (getParameters.includes('cuisine') || getParameters.includes('science'))) {
    throw new Error('Les paramètres GET ne sont pas ceux attendus.');
}

// On récupère le nom du thème
getParameters = getParameters[1];


const getJsonData = async () => {
    const response = await fetch('../data/questions.json');

    if (response.ok) {
        let jsonResponse = await response.json();

        return jsonResponse;
    }
};

const ucfirst = (str) => {
    if (typeof str !== 'string') return '';
    return str.charAt(0).toUpperCase() + str.slice(1);
};

const iterQuestions = async (fin = 5) => {

    const dataQuestions = await getJsonData();

    const iterator = {
        next: function () {
            let resultat;
            if (markIterator < fin) {
                resultat = {
                    value: [
                        dataQuestions[ucfirst(getParameters)][markIterator]['Question'],
                        [
                            dataQuestions[ucfirst(getParameters)][markIterator]['Réponses'][0],
                            dataQuestions[ucfirst(getParameters)][markIterator]['Réponses'][1],
                            dataQuestions[ucfirst(getParameters)][markIterator]['Réponses'][2],
                            dataQuestions[ucfirst(getParameters)][markIterator]['Réponses'][3]
                        ],
                        dataQuestions[ucfirst(getParameters)][markIterator]['Valide']
                    ],
                    done: false
                };
                markIterator += 1;
                return resultat;
            }
            return { done: true };
        }
    };

    return iterator;
};

const checkValidity = async (event) => {
    const tgt = event.target;
    const dataQuestions = await getJsonData();

    if (markValidity == 1) {
        return;
    }

    const validIndex = dataQuestions[ucfirst(getParameters)][markIterator - 1]['Valide'];
    const validAnswer = dataQuestions[ucfirst(getParameters)][markIterator - 1]['Réponses'][validIndex]

    if (tgt.innerText == validAnswer) {
        tgt.style.backgroundColor = 'green';
        score += 10;
        console.log(score);

    } else {
        if (tgt.classList != 'reponses' && tgt.id != 'suivant') {
            tgt.style.backgroundColor = 'firebrick';
            reponses.forEach((reponse) => {
                if (reponse.innerText == validAnswer) {
                    reponse.style.backgroundColor = 'green';
                }
            });
        }
    }

    if (markIterator == 5) {
        suivant.classList.add('d-none');
        const link = document.createElement('a');
        const textlink = document.createTextNode('Résultats');
        link.appendChild(textlink);
        link.setAttribute('href', 'resultats.php?score=' + score);
        link.classList.add('btn')
        link.classList.add('btn-outline-dark');
        testo.appendChild(link);
        console.log(score);
    }

    if (!tgt.classList.contains('reponses')) {
        markValidity = 1;
        suivant.disabled = false;
    }
};

const nextQuestion = async (event) => {
    let it = await iterQuestions();
    let resultat = it.next();
    // timer(); // FIXME: 
    // const teamout = setTimeout(() => {
    //     nextQuestion();
    //     clearTimeout(teamout);
    // }, 10200);


    if (!resultat.done) {
        question.innerText = resultat.value[0];
        reponses.forEach((reponse, markIterator) => {
            reponse.innerText = resultat.value[1][markIterator];
        });
        console.log(score);
    }

    reponses.forEach((reponse) => {
        reponse.style.backgroundColor = '#dfc010';
    });
    markValidity = 0;
    suivant.disabled = true;


};

const timer = () => {
    let width = 0;
    let id = setInterval(frame, 10);
    function frame() {
        if (width >= 100) {
            clearInterval(id);
        } else {
            width += 0.1;
            timebar.style.width = width + '%';
        }
    }
};



document.addEventListener("DOMContentLoaded", function () {
    nextQuestion();
});
blockReponses.addEventListener('click', checkValidity);
suivant.addEventListener('click', nextQuestion);

