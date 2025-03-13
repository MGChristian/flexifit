<?php

require_once "../userpage/includes/config_session.inc.php";

check_if_correct_role();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="css/colors.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/admin-mc.css">
    <?php include "./components/css.php" ?>
</head>

<body>
    <div class="grid-container">
        <!-- header -->
        <?php include "./components/header.php" ?>
        </header>
        <!-- header -->

        <!-- side -->
        <?php include "./components/sidebar.php" ?>
        <!-- side -->

        <!-- main -->
        <main class="main-container">
            <div class="page-title">
                <h1>DASHBOARD</h1>
            </div>
            <div class="bookings-statistics">
                <p class="section-title">STATISTICS</p>
                <hr>

                <!-- cards -->
                <div class="cards">
                    <div class="upcoming statistics-item shadow">
                        <div class="left-card"><box-icon name='calendar-alt' type='solid' size="lg"></box-icon></div>
                        <div class="right-card">
                            <h2>32</h2>
                            <p>TOTAL USERS</p>
                        </div>
                    </div>
                    <div class="refunds statistics-item shadow">
                        <div class="left-card"><box-icon type='solid' name='dollar-circle' size="lg"></box-icon></div>
                        <div class="right-card">
                            <h2>32</h2>
                            <p>TOTAL INSTRUCTORS</p>
                        </div>
                    </div>
                    <div class="total statistics-item shadow">
                        <div class="left-card"><box-icon name='calendar-alt' type='solid' size="lg"></box-icon></div>
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
                <div class="analytics-content">
                    <div class="analytics-left shadow">
                        <p class="analytics-title">POPULAR CLASSES</p>
                        <div class="popular-class-table">
                            <canvas id="myChart"></canvas>
                        </div>
                    </div>

                    <div class="analytics-right">
                        <div class="revenue shadow">
                            <div class="title-with-filter">
                                <p class="analytics-title">BOOKING STATISTICS <button type="button" class="filterOpen" data-target="filter-revenue"><i class="fa fa-filter" aria-hidden="true"></i></button></p>
                                <div class="filters shadow hidden" id="filter-revenue">
                                    <form>
                                        <div class="filter">
                                            <label for="instructor-filter">Instructor</label>
                                            <select>
                                                <option>Instructor 1</option>
                                                <option>Instructor 2</option>
                                                <option>Instructor 3</option>
                                            </select>
                                        </div>
                                        <div class="filter">
                                            <label for="instructor-filter">Class Name</label>
                                            <select>
                                                <option>Class 1</option>
                                                <option>Class 2</option>
                                                <option>Class 3</option>
                                            </select>
                                        </div>
                                        <button type="submit">APPLY</button>
                                    </form>
                                </div>
                            </div>
                            <div class="total-revenue">
                                <h2>₱13,000</h2>
                            </div>
                            <div class="total-revenue">
                                <canvas id="revenueChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="users-reviews">
                <p class="section-title">USERS AND REVIEWS</p>
                <hr>
                <div class="cards">
                    <div class="total-user statistics-item shadow">
                        <div class="left-card"><box-icon name='calendar-alt' type='solid' size="lg"></box-icon></div>
                        <div class="right-card">
                            <h2>32</h2>
                            <p>TOTAL EXERCISES</p>
                        </div>
                    </div>
                    <div class="total-reviews statistics-item shadow">
                        <div class="left-card"><box-icon name='calendar-alt' type='solid' size="lg"></box-icon></div>
                        <div class="right-card">
                            <h2>32</h2>
                            <p>TOTAL WORKOUTS</p>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <!-- side -->
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const filters = document.querySelectorAll(".filterOpen");

            filters.forEach((filter) => {
                filter.addEventListener("click", () => {
                    const dataTarget = filter.getAttribute("data-target");
                    const modalTarget = document.querySelector(`#${dataTarget}`);
                    modalTarget.classList.toggle("hidden");
                });

            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <script src="js/index.js"> </script>
    <script src="js/scripts.js"> </script>
</body>

</html>

<?php

function check_if_correct_role()
{
    if (isset($_SESSION['id']) && isset($_SESSION['role'])) {
        $user_role = $_SESSION['role'];
        switch ($user_role) {
            case "user":
                header("location: ../userpage/");
                exit();
                break;
            case "instructor":
                header("location:  ../instructors/");
                exit();
                break;
            case "admin":
                break;
        }
    } else {
        header("location: ../userpage/");
        exit();
    }
}

?>