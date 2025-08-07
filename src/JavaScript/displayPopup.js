// Display page popup functionality
document.addEventListener('DOMContentLoaded', function() {
    const successPopup = document.getElementById('successPopup');
    const confirmationPopup = document.getElementById('confirmationPopup');
    const okBtn = document.getElementById('okBtn');
    const cancelDeleteBtn = document.getElementById('cancelDeleteBtn');
    const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');
    const popupIcon = document.querySelector('.successPopup .popupIcon');
    const popupTitle = document.getElementById('popupTitle');
    const popupText = document.getElementById('popupText');
    
    let pendingDeleteId = null;

    // Show success/error popup
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

    // Show confirmation popup for delete
    function showDeleteConfirmation(studentId) {
        pendingDeleteId = studentId;
        confirmationPopup.style.display = 'flex';
    }

    // Close success popup
    if (okBtn) {
        okBtn.addEventListener('click', function() {
            successPopup.style.display = 'none';
        });
    }

    // Close success popup when clicking outside
    successPopup.addEventListener('click', function(e) {
        if (e.target === successPopup) {
            successPopup.style.display = 'none';
        }
    });

    // Cancel delete operation
    if (cancelDeleteBtn) {
        cancelDeleteBtn.addEventListener('click', function() {
            confirmationPopup.style.display = 'none';
            pendingDeleteId = null;
        });
    }

    // Confirm delete operation
    if (confirmDeleteBtn) {
        confirmDeleteBtn.addEventListener('click', function() {
            if (pendingDeleteId) {
                // Create a form to submit the delete request
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = 'delete_student.php';
                
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'student_id';
                input.value = pendingDeleteId;
                
                form.appendChild(input);
                document.body.appendChild(form);
                form.submit();
            }
            confirmationPopup.style.display = 'none';
        });
    }

    // Close confirmation popup when clicking outside
    confirmationPopup.addEventListener('click', function(e) {
        if (e.target === confirmationPopup) {
            confirmationPopup.style.display = 'none';
            pendingDeleteId = null;
        }
    });

    // Check if there's a session message and show popup
    const messageElement = document.querySelector('.sessionMessage .message');
    if (messageElement) {
        const message = messageElement.textContent.trim();
        const type = messageElement.classList.contains('success') ? 'success' : 'error';
        
        // Hide the original message element
        messageElement.style.display = 'none';
        
        // Show the popup instead
        showPopup(message, type);
    }

    // Make functions globally available
    window.showDeleteConfirmation = showDeleteConfirmation;
    window.updateStudent = function(id) {
        window.location.href = 'update_student.php?id=' + id;
    };
    
    window.deleteStudent = function(id) {
        showDeleteConfirmation(id);
    };
});
