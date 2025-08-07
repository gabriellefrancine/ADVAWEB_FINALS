<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/src/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <title>Student Admission</title>
</head>
<body>
    <header class="header_container">
        <img src="/Images/logo.svg" alt="iACADEMY Logo">
        <div class="navBar">
            <p>About Us</p>
            <p>Programs</p>
            <p class="active">Admissions</p>
            <p>FAQs</p>
            <p>Contact Us</p>
        </div>
    </header>

    <!-- Form -->
    <div class="mainContainer">
        <div class="admissionForm">
            <h1>Student Admission Form</h1>
            <div class="formContainer">
                <form method="POST" action="#">
                    <div class="studentInfo">
                        <!--Student Personal Information-->
                        <div class="personalDetails">
                            <label for="fullName">Full Name:</label>
                            <input type="text" id="fullName" name="fullName" required>

                            <div class="genderAndBirthday">
                                <div class="stack">
                                    <label for="gender">Gender:</label>
                                    <select id="gender" name="gender" required>
                                        <option value="" disabled selected>Select Gender</option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                        <option value="other">Other</option>
                                    </select>
                                </div>

                                <div class="stack">
                                    <label for="birthday">Birthday:</label>
                                    <input type="date" id="birthday" name="birthday" required>
                                </div>
                            </div>

                            <div class="contactInfo">
                                <div class="stack">
                                    <label for="mobNum">Mobile Number:</label>
                                    <input type="text" id="mobNum" name="mobNum" required>
                                </div>

                                <div class="stack">
                                    <label for="email">Email:</label>
                                     <input type="email" id="email" name="email" required>
                                </div>
                            </div>
                        </div>

                        <!-- Student Academic Information -->
                        <div class="academicDetails">
                            <label for="program">Program:</label>
                            <input type="text" id="program" name="program" required>

                            <label for="yearLevel">Year Level:</label>
                            <input type="number" id="yearLevel" name="yearLevel" required>
                        </div>
                    </div>

                    <!-- Image Upload Section -->
                    <div class="studentImage">
                        <div class="uploadSection">
                            <label for="image">Student Photo:</label>
                            <input type="file" name="image" id="image">
                        </div>
                    </div>
                </form>
            </div>
            <!-- Submit Button -->
            <div class="buttonContainer">
                <button type="submit" class="submitBtn">SUBMIT</button>
            </div>
            </form>
        </div>
    </div>
</body>
<script>
    // Handle form submission
    function validateForm(event) {
        const fullName = document.getElementById('fullName').value;
        if (fullName === "") {
            alert("Full Name must be filled out");
            return false;
        }

        const gender = document.getElementByID('gender').value;
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

        const mobNumPattern = /^\+?d{10,15}$/;
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

        if (image.size > 2 * 1024 * 1024) { // 2MB limit
            alert("Image size exceeds 2MB. Please upload a smaller image.");
            return false;
        }

        // If all validations pass, allow form submission
        document.querySelector('form').reset();
        alert("Form submitted successfully!");
        return true;
    }
    document.querySelector('form').onsubmit = validateForm;
</script>
</html>