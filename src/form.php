<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/src/style.css">
    <script defer src="/src/JavaScript/validation.js"></script>
    <script defer src="/src/JavaScript/animation.js"></script>
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
                   <div class="formFields">
                        <div class="studentInfo">
                            <!--Student Personal Information-->
                            <div class="personalDetails">
                                <label for="fullName">Full Name:</label>
                                <input type="text" id="fullName" name="fullName">

                                <div class="genderAndBirthday">
                                    <div class="stack">
                                        <label for="gender">Gender:</label>
                                        <select id="gender" name="gender">
                                            <option value="" disabled selected>Select Gender</option>
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                            <option value="other">Other</option>
                                        </select>
                                    </div>

                                    <div class="stack">
                                        <label for="birthday">Birthday:</label>
                                        <input type="date" id="birthday" name="birthday">
                                    </div>
                                </div>

                                <div class="contactInfo">
                                    <div class="stack">
                                        <label for="mobNum">Mobile Number:</label>
                                        <input type="text" id="mobNum" name="mobNum">
                                    </div>

                                    <div class="stack">
                                        <label for="email">Email:</label>
                                        <input type="email" id="email" name="email">
                                    </div>
                                </div>
                            </div>

                            <!-- Student Academic Information -->
                            <div class="academicDetails">
                                <label for="program">Program:</label>
                                <input type="text" id="program" name="program">

                                <label for="yearLevel">Year Level:</label>
                                <input type="number" id="yearLevel" name="yearLevel">
                            </div>
                        </div>

                        <!-- Image Upload Section -->
                        <div class="studentImage">
                            <div class="uploadSection">
                                <label for="image">Student Photo:</label>
                                <input type="file" name="image" id="image">
                            </div>
                        </div>
                   </div>
            
                    <div class="buttonContainer">
                        <!-- Submit Button -->
                        <button type="submit" class="submitBtn">SUBMIT</button>

                        <!-- Reset Button -->
                        <button type="reset" class="submitBtn" id="reserBtn">RESET</button>
                    </div>
                </form>
            </div>
            <div class="clearInfo" id="clearInfoPopup">
                <div class="question">
                    <p>Are you sure you want to clear the form?</p>
                </div>
                <div class="answer">
                    <button type="yes" class="submitBtn" id="yes">YES</button>
                    <button type="cancel" class="submitBtn" id="cancel">CANCEL</button>
                </div>
            </div>
        </div>
    </div>


    <canvas id="circleAnimation"></canvas>
</body>
</html>