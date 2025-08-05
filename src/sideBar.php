<aside id="sidebar" class="sidebar">
    <div class="navList">
        <a href="/public/index.php?page=home" class="navItem">
            <i class="fa-solid fa-house fa-lg"></i>
            <p>HOME</p>
        </a>

        <!-- ABOUT US -->
        <div class="navItem" onclick="toggleDropdown('profile', this)">
            <i class="fa-solid fa-user fa-lg"></i>
            <p>ABOUT US</p>
            <div class="arrowIcon">
                <i class="fa-solid fa-caret-right fa-lg dropdown"></i>
            </div>
        </div>
        <div id="profile" class="dropdown">
            <a href=#><p>Vision Mission</p></a>
            <a href=#><p>Our Why</p></a>
            <a href=#><p>FAQ</p></a>
        </div>

        <!-- PROGRAMS -->
        <div class="navItem" onclick="toggleDropdown('registration', this)">
            <i class="fa-solid fa-file-invoice fa-lg"></i>
            <p>PROGRAMS</p>
            <div class="arrowIcon">
                <i class="fa-solid fa-caret-right fa-lg dropdown"></i>
            </div>
        </div>
        <div id="registration" class="dropdown">
            <a href="/public/index.php?page=curriculum"><p>Under Graduate</p></a>
            <a href="/public/index.php?page=manage_section"><p>Senior Highscool</p></a>
        </div>

        <!-- ADMISSION -->
        <div class="navItem" onclick="toggleDropdown('payment', this)">
            <i class="fa-solid fa-credit-card fa-lg"></i>
            <p>ADMISSION</p>
            <div class="arrowIcon">
                <i class="fa-solid fa-caret-right fa-lg dropdown"></i>
            </div>
        </div>
        <div id="payment" class="dropdown">
            <a href="/public/index.php?page=erf"><p>Eligibility</p></a>
            <a href="/public/index.php?page=onlinepayment"><p>Requirement</p></a>
            <a href="/public/index.php?page=paymenthistory"><p>Forms</p></a>
        </div>
                
        <!-- NEWS -->
        <div class="navItem">
            <i class="fa-solid fa-circle-exclamation fa-lg"></i>
            <a href="/public/index.php?page=concerns"><p>NEWS</p>
        </div>

         <!-- INQUIRIES -->
        <div class="navLogout">
            <a href="/public/logout.php">
                <i class="fa-solid fa-right-from-bracket fa-lg"></i>
                <p>INQUIRIES</p>
            </a>
        </div>
    </div>
</aside>