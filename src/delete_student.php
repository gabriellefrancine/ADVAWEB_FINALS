<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['student_id'])) {
    $student_id = intval($_POST['student_id']);
    
    // Database Connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "school_db";
    
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    if ($conn->connect_error) { // COnnection Error
        $_SESSION['message'] = "Connection failed: " . $conn->connect_error;
        $_SESSION['messageType'] = "error";
    } else {
        // Prepare and execute the DELETE query using prepared statement
        $stmt = $conn->prepare("DELETE FROM students WHERE id = ?");
        $stmt->bind_param("i", $student_id);
        
        if ($stmt->execute()) {
            $_SESSION['message'] = "Student record deleted successfully.";
            $_SESSION['messageType'] = "success";
        } else {
            $_SESSION['message'] = "Error: " . $stmt->error;
            $_SESSION['messageType'] = "error";
        }
        
        $stmt->close();
    }
    
    $conn->close();
} else {
    // this means the request is invalid
    $_SESSION['message'] = "Invalid request.";
    $_SESSION['messageType'] = "error";
}

// Redirect back to display page
header("Location: display.php");
exit();
?>
