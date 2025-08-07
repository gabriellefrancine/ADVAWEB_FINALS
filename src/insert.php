<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullName = $_POST['fullName'];
    $gender = $_POST['gender'];
    $birthday = $_POST['birthday'];
    $mobNum = $_POST['mobNum'];
    $email = $_POST['email'];
    $program = $_POST['program'];
    $yearLevel = $_POST['yearLevel'];
    $uploadedImage = $_FILES['image'] ?? null;

    // Database Connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "school_db";

    try {
        // Handle image upload
        $imageData = null;
        if ($uploadedImage && $uploadedImage['error'] === UPLOAD_ERR_OK) {
            $imageData = file_get_contents($uploadedImage['tmp_name']);
        }

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        
        if ($conn->connect_error) {
            throw new Exception("Connection failed: " . $conn->connect_error);
        }
        
        // Simple INSERT query
        $stmt = $conn->prepare("INSERT INTO students (full_name, dob, gender, course, year_level, contact_number, email, student_picture) VALUES (?, ?, ?, ?, ?, ?, ?, ?)"); 
        $stmt->bind_param("ssssisss", $fullName, $birthday, $gender, $program, $yearLevel, $mobNum, $email, $imageData);
        
        if ($stmt->execute()) {
            $message = "Student record added successfully!";
            $messageType = "success";
        } else {
            $message = "Error: " . $stmt->error;
            $messageType = "error";
        }
        
        $stmt->close();
        $conn->close();

        // Redirect to avoid resubmission
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
        
    } catch (Exception $e) {
        $message = "Error: " . $e->getMessage();
        $messageType = "error";
    }
}
?>