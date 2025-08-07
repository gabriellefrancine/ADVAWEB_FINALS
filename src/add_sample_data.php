<?php
// Database Connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "school_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Sample data arrays
$firstNames = [
    "John", "Jane", "Michael", "Sarah", "David", "Emily", "James", "Jessica", 
    "Robert", "Ashley", "William", "Amanda", "Christopher", "Stephanie", "Matthew", 
    "Nicole", "Joshua", "Elizabeth", "Andrew", "Megan", "Daniel", "Rachel", 
    "Anthony", "Lauren", "Mark"
];

$lastNames = [
    "Smith", "Johnson", "Williams", "Brown", "Jones", "Garcia", "Miller", "Davis", 
    "Rodriguez", "Martinez", "Hernandez", "Lopez", "Gonzalez", "Wilson", "Anderson", 
    "Thomas", "Taylor", "Moore", "Jackson", "Martin", "Lee", "Perez", "Thompson", 
    "White", "Harris"
];

$genders = ["Male", "Female", "Other"];

$programs = [
    "Computer Science", "Information Technology", "Business Administration", 
    "Marketing", "Engineering", "Psychology", "Nursing", "Education", 
    "Graphic Design", "Accounting", "Finance", "Communication Arts"
];

$domains = ["gmail.com", "yahoo.com", "hotmail.com", "outlook.com", "university.edu"];

echo "Adding 25 sample student records...\n";

for ($i = 1; $i <= 25; $i++) {
    // Generate random data
    $firstName = $firstNames[array_rand($firstNames)];
    $lastName = $lastNames[array_rand($lastNames)];
    $fullName = $firstName . " " . $lastName;
    
    $gender = $genders[array_rand($genders)];
    
    // Random birth date between 1995 and 2005
    $year = rand(1995, 2005);
    $month = str_pad(rand(1, 12), 2, '0', STR_PAD_LEFT);
    $day = str_pad(rand(1, 28), 2, '0', STR_PAD_LEFT);
    $dob = "$year-$month-$day";
    
    // Random phone number
    $contactNumber = "09" . rand(100000000, 999999999);
    
    // Generate email
    $email = strtolower($firstName . "." . $lastName . rand(1, 999) . "@" . $domains[array_rand($domains)]);
    
    $course = $programs[array_rand($programs)];
    $yearLevel = rand(1, 4);
    
    // Simple INSERT query
    $sql = "INSERT INTO students (full_name, dob, gender, course, year_level, contact_number, email) 
            VALUES ('$fullName', '$dob', '$gender', '$course', $yearLevel, '$contactNumber', '$email')";
    
    if ($conn->query($sql) === TRUE) {
        echo "Record $i: Added $fullName\n";
    } else {
        echo "Error adding record $i: " . $conn->error . "\n";
    }
}

$conn->close();
echo "\nDone! Added 25 sample student records to the database.";
?>
