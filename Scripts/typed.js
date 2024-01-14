let input = document.getElementById("input");
let letters = document.querySelectorAll("span.letter");
console.log(letters)
input.oninput = function() {

    for(let i=0; i<letters.length ;i++){
        console.log(input.value[i] == letters[i].textContent)
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