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