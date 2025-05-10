<?php

// Check whether user has the authority to access this page.
require_once "./components/main.php";

if (isset($_SESSION['error_adding_workout_details'])) {
    print_r($_SESSION['error_adding_workout_details']);
    unset($_SESSION['error_adding_workout_details']);
}

//Check if ID is set and its not empty, if it is, go back to workout page.
isset($_GET['id']) && !empty($_GET['id']) ? $workoutId = $_GET['id'] : header("location: ./workouts.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <?php include "./components/css.php" ?>
    <link href="./css/workout-edit.css" rel="stylesheet">
</head>

<body>
    <!-- header -->
    <?php include "./components/navbar.php" ?>
    <!-- header -->
    <div class="grid-container">
        <!-- classes -->
        <?php
        require_once("./includes/edit-workout.php");
        $workout = new Workout($conn, $workoutId);
        if (!$workout->is_id_valid()) {
            header("location: ./workouts.php");
            exit();
        }
        $workoutDetails = $workout->get_workout();
        $workoutSets = $workout->get_unique_workout_sets();
        ?>
        <!-- side -->
        <?php include "./components/sidebar.php" ?>
        <!-- side -->

        <!-- main -->
        <main class="main-container">
            <div class="page-title">
                <div class="quick-link">
                    <p><a href="index.php"> HOME </a> > <a href="workouts.php">WORKOUTS</a> > <?= strtoupper(htmlspecialchars($workoutDetails['workoutName'])) ?></p>
                </div>
            </div>
            <div class="main-content">
                <div class="edit-content">
                    <div class="edit-content-title">
                        <h2>EDIT WORKOUT</h2>
                    </div>
                    <form class="edit-content-form" action="./includes/add-workout-details.php" method="POST" enctype="multipart/form-data">
                        <div class="input-full hidden">
                            <label>Workout ID</label>
                            <input name="workoutID" type="text" value="<?= $workoutId ?>" />
                        </div>
                        <div class="input-full">
                            <label>Workout Name</label>
                            <input name="workoutName" type="text" value="<?= htmlspecialchars($workoutDetails['workoutName']) ?>" />
                        </div>
                        <div class="input-full">
                            <label>Description</label>
                            <input name="workoutDescription" type="text" value="<?= htmlspecialchars($workoutDetails['workoutDescription']) ?>" />
                        </div>
                        <div class="input-full">
                            <label>Difficulty</label>
                            <select name="difficulty">
                                <option value="easy" <?= htmlspecialchars($workoutDetails['difficulty']) == 'easy' ? 'selected' : ''; ?>>Easy</option>
                                <option value="medium" <?= htmlspecialchars($workoutDetails['difficulty']) == 'medium' ? 'selected' : ''; ?>>Medium</option>
                                <option value="hard" <?= htmlspecialchars($workoutDetails['difficulty']) == 'hard' ? 'selected' : ''; ?>>Hard</option>
                            </select>
                        </div>
                        <div class="input-full">
                            <label>Status</label>
                            <select name="status">
                                <option value="0" <?= htmlspecialchars($workoutDetails['status']) == 0 ? 'selected' : ''; ?>>Inactive</option>
                                <option value="1" <?= htmlspecialchars($workoutDetails['status']) == 1 ? 'selected' : ''; ?>>Active</option>
                            </select>
                        </div>
                        <hr>
                        <h4>Exercises</h4>
                        <div class="workout-steps">
                            <?php echo empty($workoutSets) ? "<p id='no-steps'>There are no equipments yet</p>" : ''; ?>
                            <?php foreach ($workoutSets as $index => $set): ?>
                                <div class="sets">
                                    <input type="text" value="<?= $set['workoutSet'] ?>" disabled class="hidden set-number" />
                                    <div class="set-number">
                                        <h3>Set <?= $set['workoutSet'] ?></h3>
                                    </div>
                                    <div class="set-exercise-list">
                                        <?php
                                        $exerciseList = $workout->get_exercise_list($set['workoutSet']);
                                        foreach ($exerciseList as $exercise):
                                        ?>
                                            <div class="set-content">
                                                <input type="number" name="set[<?= $set['workoutSet'] ?>][exericse][1][set]" disabled value="1" class="hidden" />
                                                <div class="set-exercise">
                                                    <select disabled name="set[<?= $set['workoutSet'] ?>][exericse][1][exerciseID]">
                                                        <option value="<?= $exercise['exerciseID'] ?>" selected><?= $exercise['exerciseID'] ?></option>
                                                    </select>
                                                    <div class="set-exercise-inputs-container">
                                                        <div class="set-exercise-input">
                                                            <label>Duration</label>
                                                            <input disabled type="time" value="<?= $exercise['duration'] ?>" name="set[<?= $set['workoutSet'] ?>][exericse][1][time]">
                                                        </div>
                                                        <div class="set-exercise-input">
                                                            <label>Reps</label>
                                                            <input disabled type="number" value="<?= $exercise['reps'] ?>" name="set[<?= $set['workoutSet'] ?>][exericse][1][reps]">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                            <!-- <div class="sets">
                                <input type="text" value="1" class="hidden set-number" />
                                <div class="set-number">
                                    <h3>Set 1</h3>
                                </div>
                                <div class="set-exercise-list">
                                    <div class="set-content">
                                        <input type="number" name="set[1][exericse][1][workoutSet]" value="1" class="hidden" />
                                        <div class="set-exercise">
                                            <select name="set[1][exericse][1][exerciseID]">
                                                <option value="1" selected>Push Ups - Christian Gutierrez</option>
                                            </select>
                                            <div class="set-exercise-inputs-container">
                                                <div class="set-exercise-input">
                                                    <label>Duration</label>
                                                    <input type="time" name="set[1][exericse][1][time]">
                                                </div>
                                                <div class="set-exercise-input">
                                                    <label>Reps</label>
                                                    <input type="number" name="set[1][exericse][1][reps]">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="set-buttons">
                                    <p class="add-exercise">ADD EXERCISE</p>
                                    <p>ADD REST</p>
                                    <p>CLEAR SET</p>
                                    <p>REMOVE SET</p>
                                </div>
                            </div> -->
                        </div>
                        <div class="workout-step-add">
                            <p>ADD SET</p>
                        </div>
                        <div class="edit-form-buttons">
                            <button type="submit" class="save">SAVE</button>
                            <a href="./workouts.php"><button type="button" class="back">GO BACK</button></a>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const setContainer = document.querySelector(".workout-steps");
            const addSetButton = document.querySelector(".workout-step-add");
            addSetButton.addEventListener("click", addSet);

            // THIS IS USED TO GET THE LIST OF EXERCISES AVAILABLE
            async function getExercises() {
                const url = "./includes/get-exercises-list.php";
                try {
                    const response = await fetch(url);
                    if (!response.ok) {
                        throw new Error(`Response status: ${response.status}`);
                    }

                    const json = await response.json();
                    return json.map((exercise) => {
                        return (`<option value='${exercise.ID}'>${exercise.exerciseName}</option>`);
                    })
                } catch (error) {
                    console.error(error.message);
                }
            }


            function addSet() {
                const setCount = document.querySelectorAll(".sets").length;
                const setDiv = document.createElement("div");
                setDiv.classList.add("sets");
                setDiv.innerHTML = `
                    <input type="text" value="${setCount + 1}" class="hidden set-number" />
                    <div class="set-number">
                        <h3>Set ${setCount + 1}</h3>
                    </div>
                    <div class="set-exercise-list">
                    </div>
                `;
                const setButtonsContainer = document.createElement("div");
                setButtonsContainer.classList.add("set-buttons");
                const addExerciseButton = document.createElement("p")
                addExerciseButton.classList.add("add-exercise");
                addExerciseButton.innerHTML = "ADD EXERCISE";
                addExerciseButton.addEventListener("click", () => addExercise(addExerciseButton))
                setButtonsContainer.append(addExerciseButton);
                setDiv.append(setButtonsContainer);
                setContainer.append(setDiv);

            }

            const addExerciseButtons = document.querySelectorAll(".add-exercise");
            addExerciseButtons.forEach((addExerciseButton) => {
                addExerciseButton.addEventListener("click", () => addExercise(addExerciseButton));
            })

            async function addExercise(addExerciseButton) {
                const parent = addExerciseButton.closest(".sets");
                const setCount = parent.querySelector(".set-number").value;
                const exerciseContainer = parent.querySelector(".set-exercise-list");
                const exerciseCount = exerciseContainer.querySelectorAll(".set-content").length;
                const newExercise = document.createElement("div");
                const exerciseOptions = await getExercises();
                newExercise.classList.add("set-content");
                newExercise.innerHTML = `
                    <input type="number" name="set[${setCount}][exericse][${exerciseCount + 1}][workoutSet]" value="1" class="hidden" />
                    <div class="set-exercise">
                        <select name="set[${setCount}][exericse][${exerciseCount + 1}][exerciseID]">
                            <option selected disabled> Select an exercise </option>
                            ${exerciseOptions.join('')}
                        </select>
                        <div class="set-exercise-inputs-container">
                            <div class="set-exercise-input">
                                <label>Duration</label>
                                <input type="time" name="set[${setCount}][exericse][${exerciseCount + 1}][time]">
                            </div>
                            <div class="set-exercise-input">
                                <label>Reps</label>
                                <input type="number" name="set[${setCount}][exericse][${exerciseCount + 1}][reps]">
                            </div>
                        </div>
                    </div>
                `;
                exerciseContainer.append(newExercise);
            }
        });
    </script>
    <script src="js/scripts.js"> </script>
</body>

</html>