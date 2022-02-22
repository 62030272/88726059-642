var POSSIBLE_WORDS = ["obdurate", "varisimilitude", "defenestrate", 
                    "obsequious", "dissonant", "today", "idempotent"];
var MAX_GUESSES = 6;

var word = "?";
var guesses ="";
var guessCount = MAX_GUESSES;

function newGame() {
    var randomIndex = parseInt(Math.random() * POSSIBLE_WORDS.length);
    word = POSSIBLE_WORDS[randomIndex];
    guessCount = MAX_GUESSES;
    guesses = "";
    updatePage();
}

function guessLetter() {
    var input = document.getElementById("guess");
    var clue = document.getElementById("clue");
    var letter = input.value;

    if (guessCount == 0 || clue.innerHTML.indexOf("_") < 0 ||
        guesses.indexOf(letter) >= 0) {
            return;
        }
    
    guesses += letter;

    if (word.indexOf(letter) < 0) {
        guessCount--;
    }
    updatePage();
}

function updatePage() {
    var clueString = "";
    for (var i = 0; i < word.length; i++) {
        var letter = word.charAt(i);
        if (guesses.indexOf(letter) >= 0) {
            clueString += letter + " ";
        } else {
            clueString += "_";
        }
    }

    var clue = document.getElementById("clue");
    clue.innerHTML = clueString;

    var guessArea = document.getElementById("guesses");
    if (guessCount == 0) {
        guessArea.innerHTML = "You lose.";
    } else if (clueString.indexOf("_") < 0) {
        guessArea.innerHTML = "You win!!!";
    } else {
        guessArea.innerHTML = "Guesses: " + guesses;
    }

    var image = document.getElementById("hangmanpic");
    image.src = "hangman" + guessCount + ".gif";
}