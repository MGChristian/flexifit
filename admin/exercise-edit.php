<?php

require_once "./components/main.php";

if (isset($_SESSION['error_login'])) {
    print_r($_SESSION['error_login']);
    unset($_SESSION['error_login']);
}

isset($_GET['id']) && !empty($_GET['id']) ? $exerciseId = $_GET['id'] : header("location: ./exercises.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <?php include "./components/css.php" ?>
    <link href="./css/exercise-edit.css" rel="stylesheet">
</head>

<body>
    <?php include "./modals/exercises-modal.php" ?>
    <div class="grid-container">
        <!-- header -->
        <?php include "./components/navbar.php" ?>
        <!-- header -->
        <!-- classes -->
        <?php
        require_once("./includes/exercise-edit.php");
        $exercise = new Exercise($conn, $exerciseId);
        if (!$exercise->is_id_valid()) {
            header("location: ./exercises.php");
            exit();
        }
        $exerciseDetails = $exercise->get_exercise();
        $muscleList = $exercise->get_exercise_muscles();
        $exerciseEquipmentList = $exercise->get_exercise_equipments();
        $equipmentList = $exercise->get_equipments();
        $exerciseCategoryList = $exercise->get_exercise_categories();
        $categoryList = $exercise->get_categories();
        $stepsList = $exercise->get_exercise_steps();
        ?>
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
                            <input name="exerciseName" type="text" value="<?= htmlspecialchars($exerciseDetails['description']) ?>" />
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
                                    <div class="checkbox-item">
                                        <input type="checkbox" name="equipments[]" value="Dumbbells" class="hidden" <?= in_array($equipment['ID'], $exerciseEquipmentList) ? 'selected' : ''; ?> />
                                        <label class="unselectable"><?= $equipment['equipment_name'] ?></label>
                                        <i class="fa fa-times-circle-o hidden" aria-hidden="true"></i>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <div class="input-multiple-item-container">
                            <label>Categories</label>
                            <div class="checkbox-container">
                                <?php for ($i = 0; $i < 8; $i++): ?>
                                    <div class="checkbox-item">
                                        <input type="checkbox" name="equipments[]" value="Dumbbells" class="hidden" />
                                        <label class="unselectable">Dumbells</label>
                                        <i class="fa fa-times-circle-o hidden" aria-hidden="true"></i>
                                    </div>
                                <?php endfor; ?>
                            </div>
                        </div>
                        <div class="input-multiple-item-container">
                            <label>Muscle Targets</label>
                            <div class="checkbox-container">
                                <?php for ($i = 0; $i < 10; $i++): ?>
                                    <div class="checkbox-item">
                                        <input type="checkbox" name="equipments[]" value="Dumbbells" class="hidden" />
                                        <label class="unselectable">Dumbells</label>
                                        <i class="fa fa-times-circle-o hidden" aria-hidden="true"></i>
                                    </div>
                                <?php endfor; ?>
                            </div>
                        </div>
                        <hr>
                        <h4>Steps</h4>
                        <div class="exercise-steps">
                            <?php echo empty($stepsList) ? "<p id='no-steps'>There are no steps yet for this exercise</p>" : ''; ?>
                            <?php foreach ($stepsList as $step): ?>

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
                if (checkbox.checked) {
                    item.classList.add("selected");
                    close.classList.remove("hidden");
                }
                item.addEventListener("click", () => {
                    if (checkbox) {
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
                exerciseStepInput.setAttribute("name", "exerciseStep[]");
                div.append(exerciseStepInput);

                // exercise step remove
                const exerciseRemoveButton = document.createElement("i");
                exerciseRemoveButton.classList.add("fa-times-circle-o")
                exerciseRemoveButton.classList.add("fa")
                exerciseRemoveButton.setAttribute("aria-hidden", "true");
                exerciseRemoveButton.addEventListener("click", () => {
                    exerciseStepDiv.classList.add("hidden");
                    exerciseStepInput.setAttribute("name", "deletedStep[]");
                })
                div.append(exerciseRemoveButton);

                // append to container
                exerciseStepsContainer.append(exerciseStepDiv);
            });

            const exerciseSteps = exerciseStepsContainer.querySelectorAll(".input-full");
            exerciseSteps.forEach((item) => {
                const removeStep = item.querySelector("#removeStep");
                removeStep.addEventListener("click", () => {
                    item.remove();
                })
            });
        });
    </script>
    <script src="js/scripts.js"> </script>
</body>

</html>