<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/src/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script defer src="/public/assets/JavaScript/sidebar.js"></script>
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
                        <div class="leftSideForm">
                            <label for="fullName">Full Name:</label>
                            <input type="text" id="fullName" name="fullName" required>

                            <div class="genderAndBirthday">
                                <div class="stack">
                                    <label for="gender">Gender:</label>
                                    <select id="gender" name="gender" required>
                                        <option value="" disabled selected>Select Gender</option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
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
                                    <label for="telNum">Tel. Number:</label>
                                    <input type="text" id="telNum" name="telNum" required>
                                </div>
                            </div>

                            <label for="email">Email:</label>
                            <input type="email" id="email" name="email" required>
                        </div>
                        <div class="rightSideForm">
                            <label for="program">Program:</label>
                            <select id="program" name="program" required>
                                <option value="" disabled selected>Select Program</option>
                                <option value="bsit">Bachelor of Science in Computer Science with Specialization in Software Engineering</option>
                                <option value="bshrm">Bachelor of Science in Hotel and Restaurant Management</option>
                                <option value="bsba">Bachelor of Science in Business Administration</option>
                            </select>
                            <label for="yearLevel">Year Level:</label>
                            <select id="yearLevel" name="yearLevel" required>
                                <option value="" disabled selected>Select Year Level</option>
                            </select>
                        </div>
                    </div>
                </form>
                <!-- Image Upload Section -->
                <div class="studentImage">
                    <form method="POST" antion="form.php" enctype="multipart/form-data">
                        <div class="uploadSection">
                            <label for="image">Student Photo:</strong></label>
                            <input type="file" name="image" id="image">
                        </div>
                    </form>
                </div>
            </div>
            <!-- Submit Button -->
            <div class="buttonContainer">
                <button type="submit" class="submitBtn">SUBMIT</button>
            </div>
        </div>
    </div>
</body>
</html>