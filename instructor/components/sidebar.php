<div class="sidebar">
    <div class="sidebar-title">
        <div class="sidebar-role">INSTRUCTOR PANEL</div>
    </div>
    <ul class="sidebar-list">
        <!-- NAVBAR TITLE -->
        <a href="./">
            <li class="sidebar-list-item <?= $current_page == 'index.php' ? 'active' : '' ?>">
                <div class="sidebar-list-title"><i class="fa fa-tachometer" aria-hidden="true"></i> Dashboard</div>
            </li>
        </a>

        <!-- CONTENT -->
        <li class="content-a sidebar-list-item">
            <div class="sidebar-list-title"><i class="fa fa-columns" aria-hidden="true"></i></i> Content</div>
            <div><i class="fa fa-angle-down" aria-hidden="true"></i></div>
        </li>

        <!-- CONTENT DROPDOWN -->
        <ul class="content-m mini-sidebar-list hidden <?= $current_page == 'exercises.php' ? 'active' : '' ?>">
            <a href="./exercises.php">
                <li class="mini-sidebar-list-item">Exercises</li>
            </a>
            <a href="./equipments.php">
                <li class="mini-sidebar-list-item">Equipments</li>
            </a>
            <a href="./workouts.php">
                <li class="mini-sidebar-list-item">Workouts</li>
            </a>
        </ul>

        <!-- RATINGS -->
        <a href="./ratings.php">
            <li class="sidebar-list-item <?= $current_page == 'ratings.php' ? 'active' : '' ?>">
                <div class="sidebar-list-title"><i class="fa fa-star" aria-hidden="true"></i> Ratings & Reviews</div>
            </li>
        </a>

        <!-- REPORTS -->
        <a href="./reports.php">
            <li class="sidebar-list-item <?= $current_page == 'reports.php' ? 'active' : '' ?>">
                <div class="sidebar-list-title"><i class="fa fa-area-chart" aria-hidden="true"></i> Reports</div>
            </li>
        </a>
    </ul>
</div>