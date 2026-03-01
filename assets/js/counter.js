// assets/js/counter.js
document.addEventListener('DOMContentLoaded', () => {
    const counter = document.getElementById('job-counter');
    if (!counter) return;

    const target = +counter.getAttribute('data-count'); // get the target number
    let count = 0;
    const duration = 2000; // total animation duration in ms
    const interval = 50; // how often to update in ms
    const increment = target / (duration / interval);

    const updateCounter = () => {
        count += increment;
        if (count < target) {
            counter.textContent = Math.floor(count).toLocaleString();
            setTimeout(updateCounter, interval);
        } else {
            counter.textContent = target.toLocaleString();
        }
    };

    updateCounter();
});