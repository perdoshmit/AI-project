var timerStart = new Date();
var input = document.getElementById("input");
var letters = document.querySelectorAll("span.letter");

if(localStorage.getItem(lessonId)){
    showPrevStats();
}

input.oninput = function() {

    if(input.value.length == letters.length){
        statistics();
    }

    for(let i=0; i<letters.length ;i++){
        
        if(input.value[i] == letters[i].textContent){
            letters[i].classList.remove("badTyped");
            letters[i].classList.add("goodTyped");
        }else if(input.value[i] != letters[i].textContent){
            letters[i].classList.remove("goodTyped");
            letters[i].classList.add("badTyped");
        }

        if(i >= input.value.length){
            letters[i].classList.remove("goodTyped");
            letters[i].classList.remove("badTyped");
        }
    }
};

function statistics(){
    let timer = new Date() - timerStart;
    let accuracy = 0;

    for(let i=0;i<letters.length;i++){
        if(letters[i].textContent==input.value[i]){
            accuracy++;
        }
    }
    accuracy = (accuracy/letters.length)*100;
    saveStatistics(accuracy, timer);
}

function saveStatistics(accuracy, time){
    let stats = {
        lesson: lessonId,
        accuracy: accuracy,
        time: time
    };
    localStorage.setItem(lessonId, JSON.stringify(stats));
}

function showPrevStats(){
    let prevStats = JSON.parse(localStorage.getItem(lessonId));
    let nav = document.body.getElementsByTagName("nav")[0];
    
    let statsDiv = document.createElement("div");
    statsDiv.className = "statsDiv";

    let statsSpan = document.createElement("span");
    statsSpan.className = "statsSpan";

    let time = msToMins(prevStats["time"]);

    statsSpan.textContent = `Ostatni wynik: ${time["min"]}m ${time["sec"]}s ${time["ms"]}ms z dokładnością: ${prevStats["accuracy"].toFixed(2)}%`

    statsDiv.appendChild(statsSpan);

    nav.after(statsDiv);
}

document.addEventListener('keydown', function(event) {
    const pressedKey = event.key.toUpperCase();
    const keyElement = document.querySelector(`[data-key="${pressedKey}"]`);
    if (keyElement) {
        keyElement.classList.add('pressed');
    }
});

document.addEventListener('keyup', function(event) {
    const pressedKey = event.key.toUpperCase();
    const keyElement = document.querySelector(`[data-key="${pressedKey}"]`);

    if (keyElement) {
        keyElement.classList.remove('pressed');
    }
});

function msToMins(time){

    let min = Math.floor(time / (1000 * 60));
    let sec = Math.floor((time % (1000 * 60)) / 1000);
    let ms = time % 1000;

    return {min: min, sec: sec, ms: ms};
}