<?php

// Check whether user has the authority to access this page.
require_once "./includes/auth.php";

if (isset($_SESSION['error_adding_exercise_details'])) {
    print_r($_SESSION['error_adding_exercise_details']);
    unset($_SESSION['error_adding_exercise_details']);
}

//Check if ID is set and its not empty, if it is, go back to exercise page.
isset($_GET['id']) && !empty($_GET['id']) ? $exerciseId = $_GET['id'] : header("location: ./exercises.php");

?>

<?php
require_once("./includes/edit-exercise.php");
$exercise = new Exercise($conn, $exerciseId);
if (!$exercise->is_id_valid()) {
    header("location: ./exercises.php");
    exit();
}
$exerciseDetails = $exercise->get_exercise();
$muscleList = $exercise->get_muscles();
$exerciseMuscleList = $exercise->get_exercise_muscles();
$exerciseEquipmentList = $exercise->get_exercise_equipments();
$equipmentList = $exercise->get_equipments();
$exerciseCategoryList = $exercise->get_exercise_categories();
$categoryList = $exercise->get_categories();
$stepsList = $exercise->get_exercise_steps();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <?php include "./components/css.php" ?>
    <link href="../admin/css/edit-exercise.css" rel="stylesheet">
</head>

<body>
    <!-- header -->
    <?php include "../admin/components/navbar.php" ?>
    <!-- header -->
    <div class="grid-container">

        <!-- side -->
        <?php include "./components/sidebar.php" ?>
        <!-- side -->

        <!-- main -->
        <main class="main-container">
            <div class="page-title">
                <div class="quick-link">
                    <p><a href="index.php"> HOME </a> > <a href="exercises.php">EXERCISES</a> > <?= strtoupper(htmlspecialchars($exerciseDetails['exerciseName'])) ?></p>
                </div>
            </div>
            <div class="main-content">
                <div class="edit-content">
                    <div class="edit-content-title">
                        <h2>EDIT EXERCISE</h2>
                    </div>
                    <form class="edit-content-form" action="./includes/add-exercise-details.php" method="POST" enctype="multipart/form-data">
                        <div class="input-full hidden">
                            <label>Exercise ID</label>
                            <input name="exerciseID" type="text" value="<?= $exerciseId ?>" />
                        </div>
                        <div class="input-full">
                            <label>Exercise Name</label>
                            <input name="exerciseName" type="text" value="<?= htmlspecialchars($exerciseDetails['exerciseName']) ?>" />
                        </div>
                        <div class="input-full">
                            <label>Description</label>
                            <input name="exerciseDescription" type="text" value="<?= htmlspecialchars($exerciseDetails['description']) ?>" />
                        </div>
                        <div class="input-full">
                            <label>Status</label>
                            <select name="status">
                                <option value="0" <?= htmlspecialchars($exerciseDetails['status']) == 0 ? 'selected' : ''; ?>>Inactive</option>
                                <option value="1" <?= htmlspecialchars($exerciseDetails['status']) == 1 ? 'selected' : ''; ?>>Active</option>
                            </select>
                        </div>
                        <hr>
                        <div class="input-multiple-item-container">
                            <label>Equipments</label>
                            <div class="checkbox-container">
                                <?php echo empty($equipmentList) ? "<p id='no-steps'>There are no equipments yet</p>" : ''; ?>
                                <?php foreach ($equipmentList as $equipment): ?>
                                    <?php $equipmentID = $equipment['ID'] ?>
                                    <div class="checkbox-item <?= in_array($equipment['ID'], array_column($exerciseEquipmentList, "ID")) ? 'selected' : ''; ?>">
                                        <input type="checkbox" <?= in_array($equipment['ID'], array_column($exerciseEquipmentList, "ID")) ? "class='hidden itemSelected' name='removeEquipment[$equipmentID]' value='{$exerciseId}' checked disabled" : "class='hidden' value='{$equipmentID}' name='equipments[]'"; ?> />
                                        <label class="unselectable"><?= $equipment['equipment_name'] ?></label>
                                        <i class="fa fa-times-circle-o hidden" aria-hidden="true"></i>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <div class="input-multiple-item-container">
                            <label>Categories</label>
                            <div class="checkbox-container">
                                <?php echo empty($categoryList) ? "<p id='no-steps'>There are no categories yet</p>" : ''; ?>
                                <?php foreach ($categoryList as $category): ?>
                                    <?php $categoryID = $category['ID'] ?>
                                    <div class="checkbox-item <?= in_array($category['ID'], array_column($exerciseCategoryList, "ID")) ? 'selected' : ''; ?>">
                                        <input type="checkbox" <?= in_array($category['ID'], array_column($exerciseCategoryList, "ID")) ? "class='hidden itemSelected' name='removeCategories[$categoryID]' value='{$exerciseId}' checked disabled" : "class='hidden' value='{$categoryID}' name='categories[]'"; ?> />
                                        <label class="unselectable"><?= $category['category_name'] ?></label>
                                        <i class="fa fa-times-circle-o hidden" aria-hidden="true"></i>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <div class="input-multiple-item-container">
                            <label>Muscle Targets</label>
                            <div class="checkbox-container">
                                <?php echo empty($muscleList) ? "<p id='no-steps'>There are no muscles yet</p>" : ''; ?>
                                <?php foreach ($muscleList as $muscle): ?>
                                    <?php $muscleID = $muscle['ID'] ?>
                                    <div class="checkbox-item <?= in_array($muscle['ID'], array_column($exerciseMuscleList, "ID")) ? 'selected' : ''; ?>">
                                        <input type="checkbox" <?= in_array($muscle['ID'], array_column($exerciseMuscleList, "ID")) ? "class='hidden itemSelected' name='removeMuscleGroup[$muscleID]' value='{$exerciseId}' checked disabled" : "class='hidden' value='{$muscleID}' name='muscleGroup[]'"; ?> />
                                        <label class="unselectable"><?= $muscle['muscle_name'] ?></label>
                                        <i class="fa fa-times-circle-o hidden" aria-hidden="true"></i>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <hr>
                        <h4>Video Tutorial</h4>
                        <div class="exercise-steps">
                            <div class="input-full">
                                <input type="file" accept=".mp4" name="exerciseVideoUrl" />
                            </div>
                        </div>
                        <hr>
                        <h4>Steps</h4>
                        <div class="exercise-steps">
                            <?php echo empty($stepsList) ? "<p id='no-steps'>There are no steps yet for this exercise</p>" : ''; ?>
                            <?php foreach ($stepsList as $step): ?>
                                <div class="input-full">
                                    <label>Step</label>
                                    <div>
                                        <!-- THIS ID IS USED FOR REMOVING STEPS -->
                                        <input class="hidden" value="<?= $step['ID'] ?>">
                                        <textarea name="updateExerciseStep[<?= $step['ID'] ?>]"><?= $step['step_instruction'] ?></textarea>
                                        <i class="fa-times-circle-o fa" aria-hidden="true" id="removeStep"></i>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="exercise-step-add">
                            <i class="fa fa-plus" aria-hidden="true"></i>
                        </div>
                        <div class="edit-form-buttons">
                            <button type="submit" class="save">SAVE</button>
                            <a href="./exercises.php"><button type="button" class="back">GO BACK</button></a>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            // Equipments, Categories, Muscles
            const contentOpener = document.querySelector("dropdown-opener");
            const checkboxItems = document.querySelectorAll(".checkbox-item");
            checkboxItems.forEach((item) => {
                const checkbox = item.querySelector("input[type='checkbox']");
                const close = item.querySelector("i");

                // Check if the checkbox is already checked (meaning it is already in the database) if so, mark it as checked and remove the hidden for the close button so that it can be removed
                if (checkbox.checked) {
                    item.classList.add("checked");
                    close.classList.remove("hidden");
                }
                item.addEventListener("click", () => {
                    if (checkbox) {
                        // Check if the item is already in the database if so, add a disable feature so that its removal is controlled
                        if (item.querySelector(".itemSelected")) {
                            const input = item.querySelector(".itemSelected");
                            input.disabled = !input.disabled;
                            input.checked = !input.checked;
                        }
                        checkbox.checked = !checkbox.checked; // Toggle the state
                        item.classList.toggle("selected");
                        close.classList.toggle("hidden");
                    }
                });
            })

            // Steps
            const addExercise = document.querySelector(".exercise-step-add");
            const exerciseStepsContainer = document.querySelector(".exercise-steps");
            const noSteps = document.getElementById("no-steps");
            addExercise.addEventListener("click", () => {
                noSteps ? noSteps.remove() : '';
                // exercise step div
                const exerciseStepDiv = document.createElement("div");
                exerciseStepDiv.classList.add("input-full");

                // exercise label
                const exerciseStepLabel = document.createElement("label");
                exerciseStepLabel.textContent = "Step";
                exerciseStepDiv.append(exerciseStepLabel);

                const div = document.createElement("div");
                exerciseStepDiv.append(div);

                // exercise input
                const exerciseStepInput = document.createElement("textarea");
                exerciseStepInput.setAttribute("name", "addExerciseStep[]");
                div.append(exerciseStepInput);

                // exercise step remove
                const exerciseRemoveButton = document.createElement("i");
                exerciseRemoveButton.classList.add("fa-times-circle-o")
                exerciseRemoveButton.classList.add("fa")
                exerciseRemoveButton.setAttribute("aria-hidden", "true");
                exerciseRemoveButton.addEventListener("click", () => {
                    exerciseStepDiv.remove();
                })
                div.append(exerciseRemoveButton);

                // append to container
                exerciseStepsContainer.append(exerciseStepDiv);
            });

            const exerciseSteps = exerciseStepsContainer.querySelectorAll(".input-full");
            exerciseSteps.forEach((item) => {
                const removeStep = item.querySelector("#removeStep");
                removeStep.addEventListener("click", () => {
                    item.classList.add("hidden");
                    const stepId = item.querySelector("input").value;
                    item.querySelector("textarea").setAttribute("name", `removeExerciseStep[${stepId}]`);
                })
            });
        });
    </script>
    <script src="js/scripts.js"> </script>
</body>

</html>