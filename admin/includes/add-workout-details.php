<?php

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    require_once "./auth.php";

    // header("content-type:application/json");
    // echo (json_encode($_POST));
    // exit();
    // Exercise details
    $workoutID = isset($_POST['workoutID']) ? $_POST['workoutID'] : '';
    $workoutName = isset($_POST['workoutName']) ? $_POST['workoutName'] : '';
    $workoutDescription = isset($_POST['workoutDescription']) ? $_POST['workoutDescription'] : '';
    $difficulty = isset($_POST['difficulty']) ? $_POST['difficulty'] : '';
    $status = isset($_POST['status']) ? $_POST['status'] : '';

    // Sets
    $sets = isset($_POST['set']) ? $_POST['set'] : [];
    $updatedSets = isset($_POST['updatedSet']) ? $_POST['updatedSet'] : [];

    // Remove exercise
    $removedExercisesID = isset($_POST['removeID']) ? $_POST['removeID'] : [];

    //Profile
    $photo = isset($_FILES['profilePicUrl']) ? $_FILES['profilePicUrl'] : '';
    $folder = "../images/workouts/";

    try {
        // Error handlers
        $errors = [];

        $conn->begin_transaction();

        $photoUrl = '';
        if (!empty($photo)) {
            $photoUrl = handle_picture_file($folder, $photo);
            if (!empty($photoUrl)) {
                update_workout_profile($conn, $photoUrl, $workoutID);
            }
        }




        // ADD EXERCISES
        foreach ($sets as $setNumber => $setContent) {
            foreach ($setContent as $setExerciseList => $setExerciseListContent) {
                foreach ($setExerciseListContent as $setExerciseNumber => $setExerciseContent) {
                    $exerciseID = $setExerciseContent['exerciseID'];
                    $reps = $setExerciseContent['reps'];
                    $setExerciseContent['seconds'] = strlen($setExerciseContent['seconds']) == 2 ? $setExerciseContent['seconds'] : "0" . $setExerciseContent['seconds'];
                    $setExerciseContent['minutes'] = strlen($setExerciseContent['minutes']) == 2 ? $setExerciseContent['minutes'] : "0" . $setExerciseContent['minutes'];
                    $setExerciseContent['hours'] = strlen($setExerciseContent['hours']) == 2 ? $setExerciseContent['hours'] : "0" . $setExerciseContent['hours'];
                    $duration = $setExerciseContent['hours'] . ':' . $setExerciseContent['minutes'] . ":" . $setExerciseContent['seconds'];
                    $workoutSet = $setExerciseContent['workoutSet'];
                    add_exercise($conn, $workoutID, $exerciseID, $reps, $duration, $workoutSet);
                }
            }
        }

        // REMOVE EXERCISES
        if (!empty($removedExercisesID)) {
            foreach ($removedExercisesID as $exerciseStepId) {
                remove_exercise($conn, $exerciseStepId);
            }
        }


        // UPDATE EXERCISES
        if (!empty($updatedSets)) {
            foreach ($updatedSets as $setNumber => $setContent) {
                foreach ($setContent as $setExerciseList => $setExerciseListContent) {
                    foreach ($setExerciseListContent as $setExerciseNumber => $setExerciseContent) {
                        $updatedID = $setExerciseContent['updateID'];
                        $exerciseID = $setExerciseContent['exerciseID'];
                        $setExerciseContent['seconds'] = strlen($setExerciseContent['seconds']) == 2 ? $setExerciseContent['seconds'] : "0" . $setExerciseContent['seconds'];
                        $setExerciseContent['minutes'] = strlen($setExerciseContent['minutes']) == 2 ? $setExerciseContent['minutes'] : "0" . $setExerciseContent['minutes'];
                        $setExerciseContent['hours'] = strlen($setExerciseContent['hours']) == 2 ? $setExerciseContent['hours'] : "0" . $setExerciseContent['hours'];
                        $duration = $setExerciseContent['hours'] . ':' . $setExerciseContent['minutes'] . ":" . $setExerciseContent['seconds'];
                        $reps = $setExerciseContent['reps'];
                        update_exercise($conn, $updatedID, $exerciseID, $reps, $duration);
                    }
                }
            }
        }

        // $equipmentList, $categories, $muscleGroup, $exerciseSteps
        if (is_input_empty($workoutID, $workoutName, $workoutDescription, $difficulty)) {
            $errors["empty_input"] = "Inputs cannot be empty!";
        }

        update_workout_name($conn, $workoutName, $workoutID);
        update_workout_description($conn, $workoutDescription, $workoutID);
        update_workout_difficulty($conn, $difficulty, $workoutID);
        update_workout_status($conn, $status, $workoutID);

        if ($errors) {
            $conn->rollback();
            $_SESSION['error_adding_workout_details'] = $errors;
            header("Location: ../table-workouts.php");
            exit();
        } else {
            $conn->commit();
            header("Location: ../edit-workout.php?id={$workoutID}&status=success");
            exit();
        }
    } catch (\Throwable $th) {
        $conn->rollback();
        exit("Query failed: " . $th->getMessage());
    }
} else {
    header("Location: ../");
    exit();
}

//Validate and check inputs
function is_input_empty($workoutID, $workoutName, $workoutDescription, $difficulty)
{
    if (
        empty($workoutID) ||
        empty($workoutName) ||
        empty($workoutDescription) ||
        empty($difficulty)
    ) {
        return true;
    } else {
        return false;
    }
}

// Workout Details
function update_workout_name($conn, $workoutName, $workoutID)
{
    $stmt = $conn->prepare("UPDATE `workout` SET `workoutName` = ? WHERE ID = ?");
    $stmt->bind_param("si", $workoutName, $workoutID);
    $stmt->execute();
    $stmt->close();
}

function update_workout_description($conn, $workoutDescription, $workoutID)
{
    $stmt = $conn->prepare("UPDATE `workout` SET `workoutDescription` = ? WHERE ID = ?");
    $stmt->bind_param("si", $workoutDescription, $workoutID);
    $stmt->execute();
    $stmt->close();
}

function update_workout_difficulty($conn, $difficulty, $workoutID)
{
    $stmt = $conn->prepare("UPDATE `workout` SET `difficulty` = ? WHERE ID = ?");
    $stmt->bind_param("si", $difficulty, $workoutID);
    $stmt->execute();
    $stmt->close();
}

function update_workout_status($conn, $status, $workoutID)
{
    $stmt = $conn->prepare("UPDATE `workout` SET `status` = ? WHERE ID = ?");
    $stmt->bind_param("si", $status, $workoutID);
    $stmt->execute();
    $stmt->close();
}

// Exercises

function add_exercise($conn, $workoutID, $exerciseID, $reps, $duration, $workoutSet)
{
    $stmt = $conn->prepare("INSERT INTO `workout_exercises`(`workoutID`, `exerciseID`, `reps`, `duration`, `workoutSet`) VALUES(?, ?, ?, ?, ?)");
    $stmt->bind_param("iiisi", $workoutID, $exerciseID, $reps, $duration, $workoutSet);
    $stmt->execute();
    $stmt->close();
}

function update_exercise($conn, $updateID, $exerciseID, $reps, $duration)
{
    $stmt = $conn->prepare("UPDATE `workout_exercises` SET `exerciseID` = ?, `reps` = ?, `duration` = ? WHERE ID = ?");
    $stmt->bind_param("iisi", $exerciseID, $reps, $duration, $updateID);
    $stmt->execute();
    $stmt->close();
}

function remove_exercise($conn, $exerciseStepId)
{
    $stmt = $conn->prepare("DELETE FROM `workout_exercises` WHERE `ID` = ?");
    $stmt->bind_param("i", $exerciseStepId);
    $stmt->execute();
    $stmt->close();
}

//Updating workout profile

function update_workout_profile($conn, $photoUrl, $workoutID)
{
    $stmt = $conn->prepare("UPDATE `workout` SET `workoutPicUrl` = ? WHERE ID = ?");
    $stmt->bind_param("si", $photoUrl, $workoutID);
    $stmt->execute();
    $stmt->close();
}

function handle_picture_file($folder, $picture)
{
    //check for errors
    $pictureErrors = [];

    //image handler for inputs
    $picture = $picture;
    $picture_name = $picture['name'];
    $picture_type = $picture['type'];
    $picture_tmp = $picture['tmp_name'];
    $picture_error = $picture['error'];
    $picture_size = $picture['size'];

    // Explode file name and get the extension at the end
    $picture_Ext = explode(".", $picture_name);
    $picture_ActualExt = strtolower(end($picture_Ext));

    $allowedTypes = array("jpg", "jpeg", "png");

    if (!in_array($picture_ActualExt, $allowedTypes)) {
        $pictureErrors[] = "Uploaded File is not Supported";
    }

    if ($picture_error !== 0) {
        $pictureErrors[] = "There was an error uploading your file";
    }

    // Check if picture is greater than 2MB
    if ($picture_size > 2000000) {
        $pictureErrors[] = "Your file is too big!";
    }

    if (count($pictureErrors) == 0) {
        $fileNameNew = uniqid("", true) . "." . $picture_ActualExt;
        $fileDestination = $folder . $fileNameNew;
        move_uploaded_file($picture_tmp, $fileDestination);
        return $fileNameNew;
    } else {
        return "";
    }
}
