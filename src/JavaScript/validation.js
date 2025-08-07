document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');

    form.addEventListener('submit', function(event) {
  
        const fullName = document.getElementById('fullName').value;
        if (fullName === "") {
            alert("Full Name must be filled out");
            event.preventDefault();
            return;
        }
        const fullNamePattern = /^[a-zA-Z\s]+$/;
        if (!fullNamePattern.test(fullName)) {
            alert("Full Name must contain only letters and spaces");
            event.preventDefault();
            return;
        }

        const gender = document.getElementById('gender').value;
        if (gender === "") {
            alert("Gender must be selected");
            event.preventDefault();
            return;
        }

        const birthday = document.getElementById('birthday').value;
        if (birthday === "") {
            alert("Birthday must be selected");
            event.preventDefault();
            return;
        }

        const mobNum = document.getElementById('mobNum').value;
        if (mobNum === "") {
            alert("Mobile Number must be filled out");
            event.preventDefault();
            return;
        }
        const mobNumPattern = /^\+?\d{10,15}$/;
        if (!mobNumPattern.test(mobNum)) {
            alert("Please enter a valid mobile number (10-15 digits, optional leading +)");
            event.preventDefault();
            return;
        }

        const email = document.getElementById('email').value;
        if (email === "") {
            alert("Email must be filled out");
            event.preventDefault();
            return;
        }
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailPattern.test(email)) {
            alert("Please enter a valid email address");
            event.preventDefault();
            return;
        }

        const program = document.getElementById('program').value;
        if (program === "") {
            alert("Program must be filled out");
            event.preventDefault();
            return;
        }

        const yearLevel = document.getElementById('yearLevel').value;
        if (yearLevel === "") {
            alert("Year Level must be filled out");
            event.preventDefault();
            return;
        }

        const image = document.getElementById('image').files[0];
        if (!image) {
            alert("Please upload a student photo");
            event.preventDefault();
            return;
        }
        const validImageTypes = ['image/jpeg', 'image/png', 'image/gif'];
        if (!validImageTypes.includes(image.type)) {
            alert("Invalid image type. Please upload a JPEG, PNG, or GIF image.");
            event.preventDefault();
            return;
        }
        if (image.size > 5 * 1024 * 1024) { // 5MB limit
            alert("Image size exceeds 5MB. Please upload a smaller image.");
            event.preventDefault();
            return;
        }

        alert("Form submitted successfully!");
        event.preventDefault();
    });
});