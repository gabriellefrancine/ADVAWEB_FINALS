<?php
// Start session to handle messages
session_start();

// Database Connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "school_db";

$allStudents = [];
$students = [];
$totalRecords = 0;
$recordsPerPage = 4;
$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($currentPage - 1) * $recordsPerPage;
$searchTerm = isset($_GET['search']) ? trim($_GET['search']) : '';

try {
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    // Build query with search functionality
    if (!empty($searchTerm)) {
        $sql = "SELECT id, full_name, dob, gender, course, year_level, contact_number, email, created_at FROM students WHERE full_name LIKE '%$searchTerm%' OR course LIKE '%$searchTerm%' OR year_level LIKE '%$searchTerm%' ORDER BY id DESC";
    } else {
        $sql = "SELECT id, full_name, dob, gender, course, year_level, contact_number, email, created_at FROM students ORDER BY id DESC";
    }
    
    $result = $conn->query($sql);
    
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $allStudents[] = $row;
        }
    }
    
    // Use count() function to get total records
    $totalRecords = count($allStudents);
    
    // Calculate total pages
    $totalPages = ceil($totalRecords / $recordsPerPage);
    
    // Get students for current page using array_slice
    $students = array_slice($allStudents, $offset, $recordsPerPage);
    
    $conn->close();
    
} catch (Exception $e) {
    $error_message = "Error fetching data: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="/src/style.css">
    <script defer src="/src/JavaScript/messageHandler.js"></script>
    <script defer src="/src/JavaScript/displayPopup.js"></script>
    <title>Student Records</title>
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

    <div class="mainWrapper">        
        <!--contains title, search bar, and filter -->
        <div class="featuresContainer">
            <div class="title">
                <h1>Student Records</h1>
            </div>

            <form class="searchBar" method="GET">
                <input type="text" placeholder="Search by name, program, or year level..." name="search" value="<?php echo htmlspecialchars($searchTerm); ?>">
                <button type="submit">
                    <i class="fa fa-search"></i>
                </button>
                <?php if (!empty($searchTerm)): ?>
                    <a href="display.php" class="clearSearch" title="Clear search">
                        <i class="fa fa-times"></i>
                    </a>
                <?php endif; ?>
            </form>
        </div>

        <!--table for student records -->
        <div class="studentData">
            <!--count of entries found -->
            <div class="topContainer">
                <div class="message">
                    <?php if (isset($error_message)): ?>
                        <p style="color: red;"><?php echo htmlspecialchars($error_message); ?></p>
                    <?php else: ?>
                        <?php if (!empty($searchTerm)): ?>
                            <p>Search results for "<?php echo htmlspecialchars($searchTerm); ?>": Page <?php echo $currentPage; ?> of <?php echo $totalPages; ?> (<?php echo $totalRecords; ?> found)</p>
                        <?php else: ?>
                            <p>Page <?php echo $currentPage; ?> of <?php echo $totalPages; ?> (<?php echo $totalRecords; ?> total records)</p>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
                
                <!-- Display session messages on the right side -->
                <div class="sessionMessage">
                    <?php if (isset($_SESSION['message'])): ?>
                        <div class="message <?php echo $_SESSION['messageType']; ?>">
                            <?php 
                            echo htmlspecialchars($_SESSION['message']); 
                            unset($_SESSION['message'], $_SESSION['messageType']);
                            ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="pageController">
                    <?php if ($currentPage > 1): ?>
                        <button class="prevPage" onclick="window.location.href='?page=<?php echo $currentPage - 1; ?><?php echo !empty($searchTerm) ? '&search=' . urlencode($searchTerm) : ''; ?>'">
                            <i class="fa fa-chevron-left"></i>
                        </button>
                    <?php else: ?>
                        <button class="prevPage" disabled>
                            <i class="fa fa-chevron-left"></i>
                        </button>
                    <?php endif; ?>
                    
                    <span class="pageInfo">Page <?php echo $currentPage; ?> of <?php echo $totalPages; ?></span>
                    
                    <?php if ($currentPage < $totalPages): ?>
                        <button class="nextPage" onclick="window.location.href='?page=<?php echo $currentPage + 1; ?><?php echo !empty($searchTerm) ? '&search=' . urlencode($searchTerm) : ''; ?>'">
                            <i class="fa fa-chevron-right"></i>
                        </button>
                    <?php else: ?>
                        <button class="nextPage" disabled>
                            <i class="fa fa-chevron-right"></i>
                        </button>
                    <?php endif; ?>
                </div>
            </div>

            <table class ="dataTable">
                <thead>
                    <tr>
                        <th>Picture</th>
                        <th>ID</th>
                        <th>Full Name</th>
                        <th>Date of Birth</th>
                        <th>Gender</th>
                        <th>Program</th>
                        <th>Year Level</th>
                        <th>Contact Number</th>
                        <th>Email</th>
                        <th>Date Registered</th>
                        <th></th>
                    </tr>
                </thead>
               <tbody id="studentTableBody">
                    <?php if (empty($students) && !isset($error_message)): ?>
                        <tr>
                            <td colspan="11" style="text-align: center; padding: 2rem;">
                                No student records found. <a href="form.php">Add a student</a>
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($students as $student): ?>
                            <tr>
                                <td>
                                    <img src="display_image.php?id=<?php echo $student['id']; ?>" 
                                         alt="Student Picture" 
                                         style="width: 60px; height: 60px; object-fit: cover; border-radius: 4px; border: 1px solid #ddd;"
                                         onerror="this.src='data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHJlY3Qgd2lkdGg9IjYwIiBoZWlnaHQ9IjYwIiBmaWxsPSIjZjBmMGYwIi8+Cjx0ZXh0IHg9IjMwIiB5PSIzNSIgdGV4dC1hbmNob3I9Im1pZGRsZSIgZm9udC1zaXplPSIxMCIgZmlsbD0iIzk5OSI+Tm8gSW1hZ2U8L3RleHQ+Cjwvc3ZnPg==';">
                                </td>
                                <td><?php echo htmlspecialchars($student['id']); ?></td>
                                <td><?php echo htmlspecialchars($student['full_name']); ?></td>
                                <td><?php echo htmlspecialchars($student['dob']); ?></td>
                                <td><?php echo htmlspecialchars(ucfirst($student['gender'])); ?></td>
                                <td><?php echo htmlspecialchars($student['course']); ?></td>
                                <td><?php echo htmlspecialchars($student['year_level']); ?></td>
                                <td><?php echo htmlspecialchars($student['contact_number']); ?></td>
                                <td><?php echo htmlspecialchars($student['email']); ?></td>
                                <td><?php echo isset($student['created_at']) ? date('Y-m-d', strtotime($student['created_at'])) : 'N/A'; ?></td>
                                <td>
                                    <div class="buttonCont">
                                        <button onclick="updateStudent(<?php echo $student['id']; ?>)">Update</button>
                                        <button onclick="deleteStudent(<?php echo $student['id']; ?>)">Delete</button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
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
                <p id="popupText">Operation completed successfully!</p>
            </div>
            <div class="popupButtons">
                <button type="button" class="okBtn" id="okBtn">OK</button>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Popup -->
    <div class="confirmationPopup" id="confirmationPopup">
        <div class="popupContent">
            <div class="popupIcon">
                <i class="fas fa-question-circle" id="questionIcon"></i>
            </div>
            <div class="popupMessage">
                <h3 id="confirmTitle">Confirm Delete</h3>
                <p id="confirmText">Are you sure you want to delete this student record? This action cannot be undone.</p>
            </div>
            <div class="popupButtons">
                <button type="button" class="cancelBtn" id="cancelDeleteBtn">CANCEL</button>
                <button type="button" class="confirmBtn" id="confirmDeleteBtn">DELETE</button>
            </div>
        </div>
    </div>

</body>
</html>