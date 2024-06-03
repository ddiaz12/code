var timeout;
var timerElement = document.getElementById('timer');
var timeLeft = 59 * 60; // 59 minutes in seconds

function logout() {
    window.location.href = '<?= base_url('auth/logout') ?>';
}

function resetTimer() {
    clearTimeout(timeout);
    timeLeft = 59 * 60; // Reset the time left to 59 minutes
    timeout = setTimeout(logout, timeLeft * 1000);
}

// Detect user interaction and reset the timer
window.onload = resetTimer;
document.onmousemove = resetTimer;
document.onkeypress = resetTimer;

// Update the timer every second
setInterval(function() {
    timeLeft--;
    var minutes = Math.floor(timeLeft / 60);
    var seconds = timeLeft % 60;
    timerElement.textContent = minutes + ':' + (seconds < 10 ? '0' : '') + seconds;
}, 1000);