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
        } else {
            // No image - show placeholder
            header('Content-Type: image/svg+xml');
            echo '<svg width="100" height="100" xmlns="http://www.w3.org/2000/svg">
                    <rect width="100" height="100" fill="#f0f0f0"/>
                    <text x="50" y="50" text-anchor="middle" dy=".3em" fill="#999">No Image</text>
                  </svg>';
        }
    } else {
        // Student not found
        header('Content-Type: image/svg+xml');
        echo '<svg width="100" height="100" xmlns="http://www.w3.org/2000/svg">
                <rect width="100" height="100" fill="#f0f0f0"/>
                <text x="50" y="50" text-anchor="middle" dy=".3em" fill="#999">Not Found</text>
              </svg>';
    }
    
    $stmt->close();
    // Close the connection
    $conn->close();
} else {
    // No ID provided
    header('Content-Type: image/svg+xml');
    echo '<svg width="100" height="100" xmlns="http://www.w3.org/2000/svg">
            <rect width="100" height="100" fill="#f0f0f0"/>
            <text x="50" y="50" text-anchor="middle" dy=".3em" fill="#999">No ID</text>
          </svg>';
}
?>
