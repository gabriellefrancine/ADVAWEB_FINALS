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
    
    if ($conn->connect_error) {
        $_SESSION['message'] = "Connection failed: " . $conn->connect_error;
        $_SESSION['messageType'] = "error";
    } else {
        // Simple DELETE query
        $sql = "DELETE FROM students WHERE id = $student_id";
        
        if ($conn->query($sql) === TRUE) {
            $_SESSION['message'] = "Student record deleted successfully.";
            $_SESSION['messageType'] = "success";
        } else {
            $_SESSION['message'] = "Error: " . $conn->error;
            $_SESSION['messageType'] = "error";
        }
    }
    
    $conn->close();
} else {
    $_SESSION['message'] = "Invalid request.";
    $_SESSION['messageType'] = "error";
}

// Redirect back to display page
header("Location: display.php");
exit();
?>
