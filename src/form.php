<?php
// Only include insert.php when form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include 'insert.php';
}

// Check for session messages
session_start();
$message = $_SESSION['message'] ?? null;
$messageType = $_SESSION['messageType'] ?? null;

// Clear session messages after displaying
if ($message) {
    unset($_SESSION['message']);
    unset($_SESSION['messageType']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/src/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script defer src="/src/JavaScript/validation.js"></script>
    <script defer src="/src/JavaScript/animation.js"></script>
    <script defer src="/src/JavaScript/popUp.js"></script>
    <script defer src="/src/JavaScript/successPopup.js"></script>
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
            <?php if (isset($message)): ?>
                <div class="message <?php echo $messageType; ?>">
                    <?php echo htmlspecialchars($message); ?>
                </div>
            <?php endif; ?>
            
            <div class="formContainer">
                <form method="POST" enctype="multipart/form-data">
                   <div class="formFields">
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
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                            <option value="Other">Other</option>
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
                   </div>
                    
                    <!-- Submit Button -->
                    <div class="buttonContainer">
                        <button type="submit" class="submitBtn">SUBMIT</button>
                        <!-- Reset Button -->
                        <button type="reset" class="submitBtn" id="resetBtn">RESET</button>
                    </div>
                </form>
            </div>
            <div class="clearInfo" id="clearInfoPopup">
                <div class="question">
                    <p>This will reset all fields. Proceed?</p>
                </div>
                <div class="answer">
                    <button type="confirm" class="confirmBtn" id="confirm">CONFIRM</button>
                    <button type="cancel" class="cancelBtn" id="cancel">CANCEL</button>
                </div>
            </div>
            
            <!-- Success/Error Popup -->
            <div class="successPopup" id="successPopup">
                <div class="popupContent">
                    <div class="popupIcon">
                        <i class="fas fa-check-circle" id="successIcon"></i>
                        <i class="fas fa-exclamation-triangle" id="errorIcon"></i>
                    </div>
                    <div class="popupMessage">
                        <h3 id="popupTitle">Success!</h3>
                        <p id="popupText">Student record has been submitted successfully!</p>
                    </div>
                    <div class="popupButtons">
                        <button type="button" class="okBtn" id="okBtn">OK</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <canvas id="circleAnimation"></canvas>
</body>
</html>