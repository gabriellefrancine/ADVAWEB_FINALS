<?php
session_start();

// Get student ID from URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    $_SESSION['message'] = "No student ID provided.";
    $_SESSION['messageType'] = "error";
    header("Location: display.php");
    exit();
}

$student_id = intval($_GET['id']);

// Database Connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "school_db";

$student = null;
$message = "";
$messageType = "";

try {
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    }
    
    // Handle form submission (UPDATE)
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $fullName = $_POST['fullName'];
        $gender = $_POST['gender'];
        $birthday = $_POST['birthday'];
        $mobNum = $_POST['mobNum'];
        $email = $_POST['email'];
        $program = $_POST['program'];
        $yearLevel = $_POST['yearLevel'];
        $uploadedImage = $_FILES['image'] ?? null;
        
        // Handle image upload
        $imageData = null;
        if ($uploadedImage && $uploadedImage['error'] === UPLOAD_ERR_OK) {
            $imageData = file_get_contents($uploadedImage['tmp_name']);
        }
        
        // Simple UPDATE query
        if ($imageData) {
            $stmt = $conn->prepare("UPDATE students SET full_name = ?, dob = ?, gender = ?, course = ?, year_level = ?, contact_number = ?, email = ?, student_picture = ? WHERE id = ?");
            $stmt->bind_param("ssssisssi", $fullName, $birthday, $gender, $program, $yearLevel, $mobNum, $email, $imageData, $student_id);
        } else {
            $stmt = $conn->prepare("UPDATE students SET full_name = ?, dob = ?, gender = ?, course = ?, year_level = ?, contact_number = ?, email = ? WHERE id = ?");
            $stmt->bind_param("ssssissi", $fullName, $birthday, $gender, $program, $yearLevel, $mobNum, $email, $student_id);
        }
        
        if ($stmt->execute()) {
            $_SESSION['message'] = "Student record updated successfully!";
            $_SESSION['messageType'] = "success";
            header("Location: display.php");
            exit();
        } else {
            $message = "Error: " . $stmt->error;
            $messageType = "error";
        }
        
        $stmt->close();
    }
    
    // Fetch student data for the form
    $stmt = $conn->prepare("SELECT * FROM students WHERE id = ?");
    $stmt->bind_param("i", $student_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows === 0) {
        $_SESSION['message'] = "Student not found.";
        $_SESSION['messageType'] = "error";
        header("Location: display.php");
        exit();
    }
    
    $student = $result->fetch_assoc();
    $stmt->close();
    $conn->close();
    
} catch (Exception $e) {
    $message = "Error: " . $e->getMessage();
    $messageType = "error";
}

// Check for session messages (for when redirected back from display.php)
if (isset($_SESSION['message']) && empty($message)) {
    $message = $_SESSION['message'];
    $messageType = $_SESSION['messageType'];
    unset($_SESSION['message'], $_SESSION['messageType']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/src/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script defer src="/src/JavaScript/updatePopup.js"></script>
    <title>Update Student</title>
</head>
<body>
    <header class="header_container">
        <img src="/Images/logo.svg" alt="iACADEMY Logo">
        <div class="navBar">
            <p>Admin</p>
            <p>Faculty</p>
            <p class="active">Student</p>
            <p>Non-Teaching Staff</p>
            <p>Logout</p>
        </div>
    </header>

    <!-- Form -->
    <div class="mainContainer">
        <div class="admissionForm">
            <h1>Update Student Information</h1>
            
            <?php if (!empty($message)): ?>
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
                                <input type="text" id="fullName" name="fullName" value="<?php echo htmlspecialchars($student['full_name']); ?>" required>

                                <div class="genderAndBirthday">
                                    <div class="stack">
                                        <label for="gender">Gender:</label>
                                        <select id="gender" name="gender" required>
                                            <option value="Male" <?php echo ($student['gender'] === 'Male') ? 'selected' : ''; ?>>Male</option>
                                            <option value="Female" <?php echo ($student['gender'] === 'Female') ? 'selected' : ''; ?>>Female</option>
                                            <option value="Other" <?php echo ($student['gender'] === 'Other') ? 'selected' : ''; ?>>Other</option>
                                        </select>
                                    </div>

                                    <div class="stack">
                                        <label for="birthday">Birthday:</label>
                                        <input type="date" id="birthday" name="birthday" value="<?php echo htmlspecialchars($student['dob']); ?>" required>
                                    </div>
                                </div>

                                <div class="contactInfo">
                                    <div class="stack">
                                        <label for="mobNum">Mobile Number:</label>
                                        <input type="text" id="mobNum" name="mobNum" value="<?php echo htmlspecialchars($student['contact_number']); ?>" required>
                                    </div>

                                    <div class="stack">
                                        <label for="email">Email:</label>
                                        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($student['email']); ?>" required>
                                    </div>
                                </div>
                            </div>

                            <!-- Student Academic Information -->
                            <div class="academicDetails">
                                <label for="program">Program:</label>
                                <input type="text" id="program" name="program" value="<?php echo htmlspecialchars($student['course']); ?>" required>

                                <label for="yearLevel">Year Level:</label>
                                <input type="number" id="yearLevel" name="yearLevel" value="<?php echo htmlspecialchars($student['year_level']); ?>" required>
                            </div>
                        </div>

                         <!-- Image Upload Section -->
                            <div class="studentImage">
                                <div class="uploadSection">
                                    <label for="image">Student Photo:</label>
                                    <input type="file" name="image" id="image">
                                    <small>Leave empty to keep current photo</small>
                                    <?php if ($student['student_picture']): ?>
                                        <div style="margin-top: 1rem;">
                                            <p>Current Photo:</p>
                                            <img src="display_image.php?id=<?php echo $student['id']; ?>" 
                                                alt="Current Student Picture" 
                                                style="width: 100px; height: 100px; object-fit: cover; border-radius: 4px; border: 1px solid #ddd;">
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                    </div>
                    
                    <!-- Submit Buttons -->
                    <div class="buttonContainer">
                        <button type="submit" class="submitBtn">UPDATE</button>
                        <a href="display.php" class="submitBtn" style="text-decoration: none; text-align: center;">CANCEL</a>
                    </div>
                </form>
            </div>
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
                <p id="popupText">Student record has been updated successfully!</p>
            </div>
            <div class="popupButtons">
                <button type="button" class="okBtn" id="okBtn">OK</button>
            </div>
        </div>
    </div>
</body>
</html>
