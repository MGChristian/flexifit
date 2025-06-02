<?php
require_once("./includes/auth.php");
// Check if id is set, if it is not go back to explore exercise page
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $workoutID = $_GET['id'];
} else {
    goBack();
}

function goBack()
{
    header("location: ./explore-workouts.php");
    exit();
}
?>


<!-- Get all exercise details -->
<?php
require_once "./includes/workout.php";
$workout = new Workout($conn, $workoutID);
if ($workout->check_id() === true) {
    $exerciseCount = $workout->get_exercise_count();
    if ($exerciseCount['exerciseCount'] == 0) {
        goBack();
    }
} else {
    goBack();
};
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
    <!-- SETS THE MAXIMUM WIDTH TO 1200px -->
    <div class="main-container">
        <input id="play-workout-id" class="hidden" type="number" value="<?= $_GET['id'] ?>" />
        <div class="play-content">
            <h1 id="timer"></h1>
            <div class="play-progress-bar-container">
                <div class="play-progress-bar"></div>
            </div>
            <div class="play-gif-container">
                <video id='video-tutorial' width='100%' loop autoplay muted>
                </video>
            </div>
            <div class="play-number">
                <input class="hidden" id='play-number-container' type="number" value="0">
                <input class="hidden" id='play-number-max-container' type="number" value="<?= $exerciseCount['exerciseCount'] ?>">
                <h1><span id="play-number-current">1</span>/<?= $exerciseCount['exerciseCount'] ?></h1>
            </div>
            <div class="play-navigator">
                <div class="play-prev navigation">PREV</div>
                <div class="play-status">PAUSE</div>
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
                    addVideoTutorial(data.exerciseVidUrl);
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
                if (countdownInterval) {
                    clearInterval(countdownInterval);
                }

                let progressBar = document.querySelector(".play-progress-bar");
                let totalSeconds = timeToSeconds(duration);
                let remainingSeconds = totalSeconds;
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

                    // Update progress bar (percentage)
                    const progressPercent = (remainingSeconds / totalSeconds) * 100;

                    if (progressPercent >= 75) {
                        progressBar.style.backgroundColor = "green";
                    } else if (progressPercent >= 50) {
                        progressBar.style.backgroundColor = "yellow";
                    } else if (progressPercent >= 25) {
                        progressBar.style.backgroundColor = "orange";
                    } else {
                        progressBar.style.backgroundColor = "red";
                    }

                    console.log(progressPercent);

                    progressBar.style.width = `${progressPercent}%`;

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

            function addVideoTutorial(src) {
                const videoElement = document.getElementById("video-tutorial");

                // First, completely reset the video element
                videoElement.pause();
                videoElement.innerHTML = ''; // Clear any existing sources

                // Create a new source element (use default if empty)
                const sourceElement = document.createElement('source');
                sourceElement.src = `./admin/images/exercises/videos/${src || '1.mp4'}`;
                sourceElement.type = 'video/mp4'; // Important for some browsers

                videoElement.appendChild(sourceElement);

                // Load and play the new video
                videoElement.load();

                // Try to autoplay (might be blocked by browser policies)
                videoElement.play().catch(e => {
                    console.log("Autoplay prevented:", e);
                    // You might want to show a play button here
                });
            }
        })
    </script>
    <?php require_once "./components/navbar_scripts.php" ?>
</body>

</html>