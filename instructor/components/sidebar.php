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
        <ul class="content-m mini-sidebar-list hidden <?= $current_page == 'table-exercises.php' ? 'active' : '' ?>">
            <a href="./table-exercises.php">
                <li class="mini-sidebar-list-item">Exercises</li>
            </a>
            <a href="./table-workouts.php">
                <li class="mini-sidebar-list-item">Workouts</li>
            </a>
        </ul>
    </ul>
</div>