<?php

// Check whether user has the authority to access this page.
require_once "./includes/auth.php";
check_if_correct_role();

if (isset($_SESSION['error_adding_workout_details'])) {
    print_r($_SESSION['error_adding_workout_details']);
    unset($_SESSION['error_adding_workout_details']);
}

//Check if ID is set and its not empty, if it is, go back to workout page.
isset($_GET['id']) && !empty($_GET['id']) ? $workoutId = $_GET['id'] : header("location: ./table-workouts.php");

?>

<?php
require_once("./includes/class-workout.php");
$workout = new Workout($conn, $workoutId);
if (!$workout->is_id_valid()) {
    header("location: ./table-workouts.php");
    exit();
}
$workoutDetails = $workout->get_workout();
$workoutSets = $workout->get_unique_workout_sets();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <?php include "./components/css.php" ?>
    <link href="./css/edit-workout.css" rel="stylesheet">
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
                <div class="quick-link">
                    <p><a href="index.php"> HOME </a> > <a href="table-workouts.php">WORKOUTS</a> > <?= strtoupper(htmlspecialchars($workoutDetails['workoutName'])) ?></p>
                </div>
            </div>
            <div class="main-content">
                <div class="edit-content">
                    <div class="edit-content-title">
                        <h2>EDIT WORKOUT</h2>
                    </div>
                    <form class="edit-content-form" action="./includes/add-workout-details.php" method="POST" enctype="multipart/form-data">
                        <h4>Profile Picture</h4>
                        <div class="input-full">
                            <input type="file" accept="image/*" name="profilePicUrl" />
                        </div>
                        <hr>
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
                                        foreach ($exerciseList as $index => $exercise):
                                            $duration = explode(":", $exercise['duration']);
                                            $hours = $duration[0];
                                            $minutes = $duration[1];
                                            $seconds = $duration[2];
                                        ?>
                                            <div class="set-content-container">
                                                <div class="set-content">
                                                    <input type="number" class="hidden" disabled name="removeID[]" value="<?= $exercise['ID'] ?>" />
                                                    <input type="number" class="hidden" name="updatedSet[<?= $set['workoutSet'] ?>][exericse][<?= $index ?>][updateID]" value="<?= $exercise['ID'] ?>" />
                                                    <div class="set-exercise">
                                                        <div>
                                                            <label>Exercise</label>
                                                            <select name="updatedSet[<?= $set['workoutSet'] ?>][exericse][<?= $index ?>][exerciseID]">
                                                                <option value="<?= $exercise['exerciseID'] ?>" selected><?= $exercise['exerciseName'] ?></option>
                                                                <?php
                                                                $exerciseOptions = $workout->get_exercise_options($exercise['exerciseID']);
                                                                foreach ($exerciseOptions as $option):
                                                                ?>
                                                                    <option value="<?= $option['ID'] ?>"><?= $option['exerciseName'] ?></option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </div>
                                                        <div class="set-exercise-inputs-container">
                                                            <div class="set-exercise-input">
                                                                <label>Duration (HH:MM:SS)</label>
                                                                <div class="duration">
                                                                    <input type="number" min="0" max="23" value="<?= $hours ?>" name="updatedSet[<?= $set['workoutSet'] ?>][exericse][<?= $index ?>][hours]">
                                                                    <input type="number" min="0" max="59" value="<?= $minutes ?>" name="updatedSet[<?= $set['workoutSet'] ?>][exericse][<?= $index ?>][minutes]">
                                                                    <input type="number" min="0" max="59" value="<?= $seconds ?>" name="updatedSet[<?= $set['workoutSet'] ?>][exericse][<?= $index ?>][seconds]">
                                                                </div>
                                                            </div>
                                                            <div class="set-exercise-input">
                                                                <label>Reps</label>
                                                                <input type="number" value="<?= $exercise['reps'] ?>" name="updatedSet[<?= $set['workoutSet'] ?>][exericse][<?= $index ?>][reps]">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <i class="fa-times-circle-o fa removeExercise" aria-hidden="true"></i>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                    <div class="set-buttons">
                                        <p class="add-exercise">ADD EXERCISE</p>
                                        <p class="add-rest">ADD REST</p>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="workout-step-add">
                            <p>ADD SET</p>
                        </div>
                        <div class="edit-form-buttons">
                            <button type="submit" class="save">SAVE</button>
                            <a href="./table-workouts.php"><button type="button" class="back">GO BACK</button></a>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            // BUTTON FOR ADDING A NEW SET
            const addSetButton = document.querySelector(".workout-step-add");
            addSetButton.addEventListener("click", addSet);

            // FUNCTION FOR ADDING A NEW SET
            function addSet() {
                const setContainer = document.querySelector(".workout-steps");
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

            // BUTTON FOR ADDING A NEW EXERCISE
            const addExerciseButtons = document.querySelectorAll(".add-exercise");
            addExerciseButtons.forEach((addExerciseButton) => {
                addExerciseButton.addEventListener("click", () => addExercise(addExerciseButton));
            })

            // FUNCTION FOR HANDLING THE ADDING OF NEW EXERCISE
            async function addExercise(addExerciseButton) {
                const parent = addExerciseButton.closest(".sets");
                const setCount = parent.querySelector(".set-number").value;
                const exerciseContainer = parent.querySelector(".set-exercise-list");
                const exerciseCount = exerciseContainer.children.length;
                const newExercise = document.createElement("div");
                const exerciseOptions = await getExercises();
                newExercise.classList.add("set-content-container");
                newExercise.innerHTML = `
                <div class="set-content">
                    <input type="number" name="set[${setCount}][exericse][${exerciseCount + 1}][workoutSet]" value="${setCount}" class="hidden" />
                    <div class="set-exercise">
                        <div>
                            <label>Exercise</label>
                            <select name="set[${setCount}][exericse][${exerciseCount + 1}][exerciseID]">
                                <option selected disabled> Select an exercise </option>
                                ${exerciseOptions.join('')}
                            </select>
                        </div>
                        <div class="set-exercise-inputs-container">
                            <div class="set-exercise-input">
                                <label>Duration (HH:MM:SS)</label>
                                <div class="duration">
                                    <input type="number" placeholder="HH" min="0" max="23" name="set[${setCount}][exericse][${exerciseCount + 1}][hours]">
                                    <input type="number" placeholder="MM" min="0" max="59" name="set[${setCount}][exericse][${exerciseCount + 1}][minutes]">
                                    <input type="number" placeholder="SS" min="0" max="59" name="set[${setCount}][exericse][${exerciseCount + 1}][seconds]">
                                </div>
                            </div>
                            <div class="set-exercise-input">
                                <label>Reps</label>
                                <input type="number" name="set[${setCount}][exericse][${exerciseCount + 1}][reps]">
                            </div>
                        </div>
                    </div>
                </div>
                `;
                const removeButton = document.createElement("i");
                removeButton.classList.add("fa-times-circle-o");
                removeButton.classList.add("fa");
                removeButton.classList.add("removeExercise");
                removeButton.setAttribute("aria-hidden", "true");
                removeButton.addEventListener("click", () => removeNewExercise(newExercise));
                newExercise.append(removeButton);
                exerciseContainer.append(newExercise);
            }

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
                    return [];
                }
            }

            // BUTTON FOR REMOVING AN EXISTING EXERCISE
            const removeExerciseButton = document.querySelectorAll(".removeExercise");
            removeExerciseButton.forEach((remove) => {
                const inputContainer = remove.closest(".set-content-container");
                remove.addEventListener("click", () => removeExercise(inputContainer));
            })

            function removeExercise(inputContainer) {
                inputContainer.classList.add("hidden");
                const inputs = inputContainer.querySelectorAll("input");
                const selects = inputContainer.querySelectorAll("select");
                inputs.forEach((input) => {
                    input.disabled = !input.disabled;
                })
                selects.forEach((select) => {
                    select.disabled = !select.disabled;
                })
            }

            // BUTTON FOR REMOVING AN EXERCISES THAT HAS NOT BEEN ADDED TO THE DATABASE YET
            function removeNewExercise(inputContainer) {
                inputContainer.remove();
            }
        });
    </script>
    <script src="js/scripts.js"> </script>
</body>

</html>