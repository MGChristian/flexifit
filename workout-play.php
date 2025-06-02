<?php
require_once("./includes/auth.php");
// Check if id is set, if it is not go back to explore exercise page
isset($_GET['id']) && !empty($_GET['id']) ? $workoutID = $_GET['id'] : header("location: ./explore-exercises.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Explore Classes</title>
    <?php require_once "./components/global_css.php" ?>
    <link rel="stylesheet" href="./css/workout-play.css">
</head>

<body>
    <!-- Navigation Header -->
    <?php require_once "./components/navbar.php"; ?>

    <!-- Get all exercise details -->
    <?php
    require_once "./includes/workout.php";
    $workout = new Workout($conn, $workoutID);
    if ($workout->check_id() === true) {
        $exerciseCount = $workout->get_exercise_count();
    } else {
        header("location: ./explore-exercises.php");
        exit();
    };
    ?>
    <!-- SETS THE MAXIMUM WIDTH TO 1200px -->
    <div class="main-container">
        <input id="play-workout-id" class="hidden" type="number" value="<?= $_GET['id'] ?>" />
        <div class="play-content">
            <h1 id="timer"></h1>
            <div class="play-progress-bar-container">
                <div class="play-progress-bar"></div>
            </div>
            <div class="play-gif-container">
                <img src="https://picsum.photos/1200/600" />
            </div>
            <div class="play-number">
                <input class="hidden" id='play-number-container' type="number" value="0">
                <input class="hidden" id='play-number-max-container' type="number" value="<?= $exerciseCount['exerciseCount'] ?>">
                <h1><span id="play-number-current">1</span>/<?= $exerciseCount['exerciseCount'] ?></h1>
            </div>
            <div class="play-navigator">
                <div class="play-prev navigation">PREV</div>
                <div class="play-status">PLAY</div>
                <div class="play-next navigation">NEXT</div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            //GET INITIAL WORKOUT ID AND NAVIGATION NUMBER
            let workoutID = document.getElementById("play-workout-id");
            let navigationNumber = document.getElementById("play-number-container");
            let navigationNumberCurrent = document.getElementById("play-number-current");
            let count = document.getElementById("play-number-max-container").value;

            fetchExerciseDetails(workoutID.value, navigationNumber.value);

            //INITIALIZE BUTTONS
            const playPrev = document.querySelector(".play-prev");
            const playNext = document.querySelector(".play-next");
            const playStatus = document.querySelector(".play-status");

            function playNextFunction() {
                let navNumber = Number(navigationNumber.value) + 1;
                navigationNumber.value = navNumber;
                fetchExerciseDetails(workoutID.value, navigationNumber.value);
                navigationNumberCurrent.innerHTML = navNumber + 1;
            }

            function playPrevFunction() {
                let navNumber = Number(navigationNumber.value) - 1;
                navigationNumber.value = navNumber;
                fetchExerciseDetails(workoutID.value, navigationNumber.value);
                navigationNumberCurrent.innerHTML = navNumber + 1;
            }

            playNext.addEventListener("click", () => {
                if (navigationNumber.value < count - 1) {
                    let status = confirm("Are you sure you want to move on to the next exercise?");
                    if (status == 1) {
                        playNextFunction();
                    }
                }


            })

            playPrev.addEventListener("click", () => {
                if (navigationNumber.value > 0) {
                    let status = confirm("Are you sure you want to go back from the last exercise?");
                    if (status == 1) {
                        playPrevFunction();
                    }
                }
            })

            async function fetchExerciseDetails(workoutID, navigationNumber) {
                try {
                    let url = `./includes/workout-play.inc.php/?id=${workoutID}&navNumber=${navigationNumber}`;
                    let response = await fetch(url);
                    if (!response.ok) throw new Error('Request failed!');
                    const data = await response.json();
                    startCountdown(data.duration);
                    console.log(data);
                    return data;
                } catch (error) {
                    console.error('Error:', error);
                }
            }

            //INITIALIZE COUNTDOWN
            let countdownInterval;
            let isPaused = false;

            function startCountdown(duration) {
                // Clear any existing timer
                if (countdownInterval) clearInterval(countdownInterval);

                let remainingSeconds = timeToSeconds(duration);
                const timerContainer = document.getElementById("timer");

                // Update immediately
                timerContainer.innerHTML = secondsToTime(remainingSeconds);

                // Start countdown
                countdownInterval = setInterval(() => {
                    if (!isPaused) {
                        remainingSeconds--;
                    }

                    // Update display
                    timerContainer.innerHTML = secondsToTime(remainingSeconds);

                    // Stop when reaching 0
                    if (remainingSeconds <= 0) {
                        clearInterval(countdownInterval);
                        if (navigationNumber.value < count - 1) {
                            playNextFunction();
                        }
                    }
                }, 1000);

                playStatus.addEventListener("click", togglePause)
            }

            function togglePause() {
                isPaused = !isPaused;

                // Update button text & style
                if (isPaused) {
                    playStatus.textContent = "RESUME";
                    playStatus.style.backgroundColor = "#ff9800"; // Orange when paused
                } else {
                    playStatus.textContent = "PAUSE";
                    playStatus.style.backgroundColor = "#4CAF50"; // Green when playing
                }
            }

            //Convert HH:MM:SS format to seconds
            function timeToSeconds(timeStr) {
                const [hours, minutes, seconds] = timeStr.split(':').map(Number);
                return hours * 3600 + minutes * 60 + seconds;
            }

            //Convert seconds format back to HH:MM:SS
            function secondsToTime(seconds) {
                const hrs = Math.floor(seconds / 3600).toString().padStart(2, '0');
                const mins = Math.floor((seconds % 3600) / 60).toString().padStart(2, '0');
                const secs = Math.floor(seconds % 60).toString().padStart(2, '0');
                return `${hrs}:${mins}:${secs}`;
            }
        })
    </script>
    <?php require_once "./components/navbar_scripts.php" ?>
</body>

</html>