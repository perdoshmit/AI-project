
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
