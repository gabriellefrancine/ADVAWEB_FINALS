<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="/src/style.css">
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

            <form class="searchBar">
                <input type="text" placeholder="Search..." name="search">
                <button type="submit">
                    <i class="fa fa-search"></i>
                </button>
            </form>
        </div>

        <!--table for student records -->
        <div class="studentData">
            <!--count of entries found -->
            <div class="topContainer">
                <div class="message">
                    <p>Dito lalagay kung ilan entries nahanap if nag search</p>
                </div>

                <div class="pageController">
                    <button class="prevPage"><i class="fa fa-chevron-left"></i></button>
                    <button class="nextPage"><i class="fa fa-chevron-right"></i></button>
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
                    <tr>
                        <td><img src="/Images/logo.svg" alt="Picture"></td>
                        <td>1</td>
                        <td>John Doe</td>
                        <td>2005-02-08</td>
                        <td>Male</td>
                        <td>BSCSSE</td>
                        <td>3rd Year</td>
                        <td>09123456789</td>
                        <td>johndoe@example.com</td>
                        <td>2025-7-01</td> 
                        <td>
                            <div class="buttonCont">
                                <button>Update</button>
                                <button>Delete</button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>