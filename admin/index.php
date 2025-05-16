<?php

require_once "./components/main.php";
require_once "./includes/get-index-data.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <?php include "./components/css.php" ?>
    <link rel="stylesheet" href="css/admin-index.css">
</head>

<body>
    <!-- header -->
    <?php include "./components/navbar.php" ?>
    <!-- header -->
    <div class="grid-container">
        <!-- side -->
        <?php include "./components/sidebar.php" ?>
        <!-- side -->

        <!-- main -->
        <main class="main-container">
            <div class="page-title">
                <h1>DASHBOARD</h1>
            </div>
            <div class="card-section">
                <p class="section-title">STATISTICS</p>
                <hr>
                <!-- cards -->
                <div class="cards">
                    <div class="yellow card shadow">
                        <div class="left-card"><i class="fa fa-user" aria-hidden="true"></i></div>
                        <div class="right-card">
                            <h2><?= htmlspecialchars(get_total_users($conn)) ?></h2>
                            <p>TOTAL USERS</p>
                        </div>
                    </div>
                    <div class="red card shadow">
                        <div class="left-card"><i class="fa fa-users" aria-hidden="true"></i></div>
                        <div class="right-card">
                            <h2><?= htmlspecialchars(get_total_instructors($conn)) ?></h2>
                            <p>TOTAL INSTRUCTORS</p>
                        </div>
                    </div>
                    <div class="green card shadow">
                        <div class="left-card"><i class="fa fa-star" aria-hidden="true"></i></div>
                        <div class="right-card">
                            <h2>32</h2>
                            <p>RATINGS & REVIEWS</p>
                        </div>
                    </div>
                </div>
                <!-- cards -->
            </div>


            <div class="analytics">
                <p class="section-title">ANALYTICS</p>
                <hr>

                <!-- FILTERS -->
                <div class="filter-dates">
                    <button type="button" class="filter-button">All Time</button>
                    <button type="button" class="filter-button">This Year</button>
                    <button type="button" class="filter-button">This Month</button>
                    <button type="button" class="filter-button">This Week</button>
                    <span id="customDate">
                        <button type="button" class="filter-button filterOpen" data-target="filter-date">Custom</button>
                        <div class="filters shadow hidden" id="filter-date">
                            <form>
                                <div class="filter">
                                    <label for="instructor-filter">Date Start</label>
                                    <input type="date">
                                </div>
                                <div class="filter">
                                    <label for="instructor-filter">Date End</label>
                                    <input type="date">
                                </div>
                                <button type="submit">APPLY</button>
                            </form>
                        </div>
                    </span>
                </div>
                <!-- END OF FILTERS -->

                <!-- <div class="analytics-content">
                    CHARTS
                    <div class="analytics-left shadow">
                        <p class="analytics-title">POPULAR INSTRUCTORS</p>
                        <div class="chart-container">
                            <canvas id="myChart"></canvas>
                        </div>
                    </div>

                    <div class="analytics-right shadow">
                        <p class="analytics-title">USER ANALYTICS</p>
                        <div class="chart-container">
                            <canvas id="revenueChart"></canvas>
                        </div>
                    </div>
                    END OF CHARTS
                </div> -->

            </div>
            <div class="card-section">
                <p class="section-title">USERS AND REVIEWS</p>
                <hr>
                <div class="cards">
                    <div class="yellow card shadow">
                        <div class="left-card"><box-icon name='calendar-alt' type='solid' size="lg"></box-icon></div>
                        <div class="right-card">
                            <h2>32</h2>
                            <p>TOTAL EXERCISES</p>
                        </div>
                    </div>
                    <div class="green card shadow">
                        <div class="left-card"><box-icon name='calendar-alt' type='solid' size="lg"></box-icon></div>
                        <div class="right-card">
                            <h2>32</h2>
                            <p>TOTAL WORKOUTS</p>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="js/index.js"> </script>
    <script src="js/scripts.js"> </script>
</body>

</html>