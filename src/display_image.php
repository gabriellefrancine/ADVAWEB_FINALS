<?php
if (isset($_GET['id'])) {
    $studentId = intval($_GET['id']);
    
    // Database Connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "school_db";
    
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    // Use prepared statement to get image
    $stmt = $conn->prepare("SELECT student_picture FROM students WHERE id = ?");
    $stmt->bind_param("i", $studentId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $imageData = $row['student_picture'];
        
        if ($imageData) {
            header('Content-Type: image/jpeg');
            echo $imageData;
        }
    }
    // Close Connection
    $stmt->close();
    $conn->close();
}
?>
