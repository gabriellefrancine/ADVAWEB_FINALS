// Handle form submission
function validateForm(event) {
    const fullName = document.getElementById('fullName').value;
    if (fullName === "") {
        alert("Full Name must be filled out");
        return false;
    }

    const gender = document.getElementById('gender').value;
    if (gender === "") {
        alert("Gender must be selected");
        return false;
    }

    const birthday = document.getElementById('birthday').value;
    if (birthday === "") {
        alert("Birthday must be selected");
        return false;
    }

    const mobNum = document.getElementById('mobNum').value;
    if (mobNum === "") {
        alert("Mobile Number must be filled out");
        return false;
    }

    const mobNumPattern = /^\+?\d{10,15}$/;
    if (!mobNumPattern.test(mobNum)) {
        alert("Please enter a valid mobile number");
        return false;
    }

    const email = document.getElementById('email').value;
    if (email === "") {
        alert("Email must be filled out");
        return false;
    }

    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (email === "" || !emailPattern.test(email)) {
        alert("Please enter a valid email address");
        return false;
    }

    const program = document.getElementById('program').value;
    if (program === "") {
        alert("Program must be filled out");
        return false;
    }

    const yearLevel = document.getElementById('yearLevel').value;
    if (yearLevel === "") {
        alert("Year Level must be filled out");
        return false;
    }

    const image = document.getElementById('image').files[0];
    if (!image) {
        alert("Please upload a student photo");
        return false;
    }

    // Validate image type and size
    const validImageTypes = ['image/jpeg', 'image/png', 'image/gif'];
    if (!validImageTypes.includes(image.type)) {
        alert("Invalid image type. Please upload a JPEG, PNG, or GIF image.");
        return false;
    }

    if (image.size > 5 * 1024 * 1024) { // 5MB limit
        alert("Image size exceeds 5MB. Please upload a smaller image.");
        return false;
    }

    document.addEventListener('DOMContentLoaded', function() {
        const form = document.querySelector('form');
        form.addEventListener('reset', function(e) {
            if (!confirm("Are you sure you want to clear the form?")) {
                e.preventDefault();
            }
        });
    });

    // If all validations pass, allow form submission
    event.preventDefault();
    alert("Form submitted successfully!");  
    return true;
}

document.querySelector('form').onsubmit = validateForm;
