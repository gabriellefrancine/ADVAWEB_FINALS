const resetBtn = document.getElementById('resetBtn');
    const form = document.querySelector('form'); 
    const clearInfoPopup = document.getElementById('clearInfoPopup');
    const cancelBtn = document.getElementById('cancel');
    const confirmBtn = document.getElementById('confirm');

    resetBtn.addEventListener('click', function(event) {
        event.preventDefault(); // Prevent default reset
        clearInfoPopup.style.display = 'block';
    });

    cancelBtn.addEventListener('click', function() {
        clearInfoPopup.style.display = 'none';
    });

    confirmBtn.addEventListener('click', function() {
        form.reset(); // Reset the form
        clearInfoPopup.style.display = 'none'; // Hide the popup
        alert("Form has been cleared.");
    });