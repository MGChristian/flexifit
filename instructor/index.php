<?php


require_once "./includes/auth.php";
// require_once "./includes/get-index-data.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Instructor Dashboard</title>
	<?php include "./components/css.php" ?>
	<link rel="stylesheet" href="css/instructor-index.css" />
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
							<h2>1</h2>
							<p>TOTAL USERS</p>
						</div>
					</div>
					<div class="red card shadow">
						<div class="left-card"><i class="fa fa-users" aria-hidden="true"></i></div>
						<div class="right-card">
							<h2>1</h2>
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