<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="teacher_homepage.php?tid=">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">Homepage</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#teacher" aria-expanded="false" aria-controls="teacher">
                <i class="icon-head menu-icon"></i>
                <span class="menu-title">Teacher Side</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="teacher">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="teacher.php?tid="> Teacher Dashboard</a></li>
                    <li class="nav-item"> <a class="nav-link" href="question.php?tid="> View / Create Quiz</a></li>
                    <li class="nav-item"> <a class="nav-link" href="account_teacher.php?tid="> Account Setting </a></li>
                    <li class="nav-item"> <a class="nav-link" href="logout.php"> Logout </a></li>
                </ul>
            </div>
        </li>
    </ul>
</nav>