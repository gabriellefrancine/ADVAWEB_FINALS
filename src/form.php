<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullName = $_POST['fullName'];
    $gender = $_POST['gender'];
    $birthday = $_POST['birthday'];
    $mobNum = $_POST['mobNum'];
    $telNum = $_POST['telNum'];
    $email = $_POST['email'];
    $program = $_POST['program'];
    $yearLevel = $_POST['yearLevel'];
    $uploadedImage = $_FILES['image'] ?? null;

    // PHPMyAdmin Connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "school_db";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $stmt = $conn->prepare("INSERT INTO students (full_name, dob, gender, course, year_level, contact_number, email, student_picture) VALUES (?, ?, ?, ?, ?, ?, ?, ?)"); 
    // execute the prepared statement
    $stmt->bind_param("ssssssss", $fullName, $birthday, $gender, $program, $yearLevel, $mobNum, $email, $imagePath);
    $stmt->execute();
}
?>

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