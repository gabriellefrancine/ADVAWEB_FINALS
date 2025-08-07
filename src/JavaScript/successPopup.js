// Success Popup Handler
document.addEventListener('DOMContentLoaded', function() {
    const successPopup = document.getElementById('successPopup');
    const okBtn = document.getElementById('okBtn');
    const popupIcon = document.querySelector('.popupIcon');
    const popupTitle = document.getElementById('popupTitle');
    const popupText = document.getElementById('popupText');

    // Show popup with message from PHP
    function showPopup(message, type) {
        if (message) {
            // Set popup content based on type
            if (type === 'success') {
                popupIcon.className = 'popupIcon success';
                popupTitle.textContent = 'Success!';
                popupText.textContent = message;
            } else if (type === 'error') {
                popupIcon.className = 'popupIcon error';
                popupTitle.textContent = 'Error!';
                popupText.textContent = message;
            }
            
            // Show the popup
            successPopup.style.display = 'flex';
        }
    }

    // Close popup when OK button is clicked
    if (okBtn) {
        okBtn.addEventListener('click', function() {
            successPopup.style.display = 'none';
            
            // If it was a success message, reset the form
            if (popupIcon.classList.contains('success')) {
                const form = document.querySelector('form');
                if (form) {
                    form.reset();
                }
            }
        });
    }

    // Close popup when clicking outside the content
    successPopup.addEventListener('click', function(e) {
        if (e.target === successPopup) {
            successPopup.style.display = 'none';
            
            // If it was a success message, reset the form
            if (popupIcon.classList.contains('success')) {
                const form = document.querySelector('form');
                if (form) {
                    form.reset();
                }
            }
        }
    });

    // Check if there's a message from PHP and show popup
    const messageElement = document.querySelector('.message');
    if (messageElement) {
        const message = messageElement.textContent.trim();
        const type = messageElement.classList.contains('success') ? 'success' : 'error';
        
        // Hide the original message element
        messageElement.style.display = 'none';
        
        // Show the popup instead
        showPopup(message, type);
    }
});
