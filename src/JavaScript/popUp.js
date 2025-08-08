const resetBtn = document.getElementById('resetBtn');
const form = document.querySelector('form');
const clearInfoOverlay = document.getElementById('clearInfoOverlay');
const clearInfoPopup = document.getElementById('clearInfoPopup');
const cancelBtn = document.getElementById('cancel');
const confirmBtn = document.getElementById('confirm');

resetBtn.addEventListener('click', function (event) {
    event.preventDefault(); 
    clearInfoOverlay.style.display = 'flex'; // show dim background
    clearInfoPopup.style.display = 'block';  // show popup
});

//close popup
cancelBtn.addEventListener('click', function () {
    clearInfoOverlay.style.display = 'none'; 
    clearInfoPopup.style.display = 'none';
});

//reset
confirmBtn.addEventListener('click', function () {
    form.reset(); 
    clearInfoOverlay.style.display = 'none';
    clearInfoPopup.style.display = 'none';
});
