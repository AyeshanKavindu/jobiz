const sentences = [
    "Getting a new job is never easy.",
    "Check what new jobs we have.",
    "Your dream job might be just one click away!"
];

let i = 0, j = 0, currentSentence = '', isDeleting = false;
const typingSpeed = 100, pauseTime = 1000;

function type() {
    const typedTextEl = document.getElementById('typed-text');
    if (!typedTextEl) return;

    // Add blinking cursor dynamically
    const cursor = '<span class="cursor">|</span>';

    if (!isDeleting) {
        currentSentence = sentences[i].substring(0, j + 1);
        j++;
        if (j === sentences[i].length) {
            isDeleting = true;
            setTimeout(type, pauseTime);
            typedTextEl.innerHTML = currentSentence + cursor;
            return;
        }
    } else {
        currentSentence = sentences[i].substring(0, j - 1);
        j--;
        if (j === 0) {
            isDeleting = false;
            i = (i + 1) % sentences.length;
        }
    }

    typedTextEl.innerHTML = currentSentence + cursor;
    setTimeout(type, typingSpeed);
}

document.addEventListener('DOMContentLoaded', type);