Create a database in PHPMyAdmin
```
school_db
```
now inside school_db you will need to create this table:
```
CREATE TABLE students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(100),
    dob DATE,
    gender ENUM('Male','Female','Other'),
    course VARCHAR(50),
    year_level INT,
    contact_number VARCHAR(15),
    email VARCHAR(100),
    student_picture LONGBLOB,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

