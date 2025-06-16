<?php

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    require_once "./auth.php";

    // Exercise details
    $exerciseId = $_POST['exerciseID'];
    $exerciseName = $_POST['exerciseName'];
    $exerciseDescription = $_POST['exerciseDescription'];
    $status = $_POST['status'];

    // Equipements
    $equipmentList = isset($_POST['equipments']) ? $_POST['equipments'] : [];
    $removeEquipmentList = isset($_POST['removeEquipment']) ? $_POST['removeEquipment'] : [];

    // Categories
    $categories = isset($_POST['categories']) ? $_POST['categories'] : [];
    $removeCategories = isset($_POST['removeCategories']) ? $_POST['removeCategories'] : [];

    // muscleGroup
    $muscleGroup = isset($_POST['muscleGroup']) ? $_POST['muscleGroup'] : [];
    $removeMuscleGroup = isset($_POST['removeMuscleGroup']) ? $_POST['removeMuscleGroup'] : [];

    // EXERCISE STEPS
    $addExerciseSteps = isset($_POST['addExerciseStep']) ? $_POST['addExerciseStep'] : [];
    $removeExerciseSteps = isset($_POST['removeExerciseStep']) ? $_POST['removeExerciseStep'] : [];
    $updateExerciseSteps = isset($_POST['updateExerciseStep']) ? $_POST['updateExerciseStep'] : [];

    //Video
    $video = isset($_FILES['exerciseVideoUrl']) ? $_FILES['exerciseVideoUrl'] : [];
    $folder = "../../admin/images/exercises/videos/";

    //Profile
    $photo = isset($_FILES['profilePicUrl']) ? $_FILES['profilePicUrl'] : '';
    $pictureFolder = "../../admin/images/exercises/";

    // echo "<pre>";
    // echo print_r($_POST);
    // echo print_r($_FILES);
    // echo "</pre>";
    // exit();

    try {
        // Error handlers
        $errors = [];

        $conn->begin_transaction();

        $photoUrl = '';
        if (!empty($photo['name'])) {
            $photoUrl = handle_picture_file($pictureFolder, $photo);
            if (!empty($photoUrl)) {
                update_exercise_profile($conn, $photoUrl, $exerciseId);
            }
        }

        // Video
        $videoUrl = '';
        if (isset($video) && $video["size"] > 0) {  // Only handle if a file was actually uploaded
            $videoUrl = handle_video_file($folder, $video);
            if ($videoUrl === "none") {
                $errors["video_problem"] = "There was a problem with the video upload";
            } else {
                update_exercise_video($conn, $videoUrl, $exerciseId);
            }
        }

        // Equipments
        foreach ($equipmentList as $equipmentID) {
            add_equipments($conn, $equipmentID, $exerciseId);
        }

        if (!empty($removeEquipmentList)) {
            foreach ($removeEquipmentList as $removeEquipmentID => $exerciseID) {
                remove_equipments($conn, $exerciseID,  $removeEquipmentID);
            }
        }

        // Categories
        foreach ($categories as $categoryID) {
            add_categories($conn, $categoryID, $exerciseId);
        }


        // Check if existing steps were removed, if so, remove it in the database
        if (!empty($removeCategories)) {
            foreach ($removeCategories as $removeCategoryID => $exerciseID) {
                remove_categories($conn, $exerciseID,  $removeCategoryID);
            }
        }



        // Muscles
        foreach ($muscleGroup as $muscleID) {
            add_muscle_group($conn, $muscleID, $exerciseId);
        }

        // Check if existing steps were removed, if so, remove it in the database
        if (!empty($removeMuscleGroup)) {
            foreach ($removeMuscleGroup as $removeMuscleGroupID => $exerciseID) {
                remove_muscle_group($conn, $exerciseID,  $removeMuscleGroupID);
            }
        }



        // , $equipmentList, $categories, $muscleGroup, $exerciseSteps
        if (empty($exerciseId)) {
            $errors["empty_input"] = "Inputs cannot be empty!";
        }

        update_exercise_name($conn, $exerciseName, $exerciseId);
        update_exercise_description($conn, $exerciseDescription, $exerciseId);
        update_exercise_status($conn, $status, $exerciseId);


        //Check if new steps were added, if so, add it to the database
        if (!empty($addExerciseSteps)) {
            foreach ($addExerciseSteps as $addExerciseStep) {
                add_exercise_steps($conn, $addExerciseStep, $exerciseId);
            }
        }

        //Check if existing steps were updated, if so, update it in the database
        if (!empty($updateExerciseSteps)) {
            foreach ($updateExerciseSteps as $stepId => $updateExerciseStep) {
                update_exercise_steps($conn, $updateExerciseStep, $stepId);
            }
        }

        //Check if existing steps were removed, if so, remove it in the database
        if (!empty($removeExerciseSteps)) {
            foreach ($removeExerciseSteps as $stepId => $removeExerciseStep) {
                remove_exercise_steps($conn, $stepId);
            }
        }

        if ($errors) {
            $conn->rollback();
            $_SESSION['error_adding_exercise_details'] = $errors;
            header("Location: ../table-exercises.php");
            exit();
        } else {
            $conn->commit();
            header("Location: ../edit-exercise.php?id={$exerciseId}&status=success");
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

function update_exercise_name($conn, $exerciseName, $exerciseId)
{
    $stmt = $conn->prepare("UPDATE `exercise` SET `exerciseName` = ? WHERE ID = ?");
    $stmt->bind_param("si", $exerciseName, $exerciseId);
    $stmt->execute();
    $stmt->close();
}

function update_exercise_description($conn, $exerciseDescription, $exerciseId)
{
    $stmt = $conn->prepare("UPDATE `exercise` SET `description` = ? WHERE ID = ?");
    $stmt->bind_param("si", $exerciseDescription, $exerciseId);
    $stmt->execute();
    $stmt->close();
}

function update_exercise_status($conn, $status, $exerciseId)
{
    $stmt = $conn->prepare("UPDATE `exercise` SET `status` = ? WHERE ID = ?");
    $stmt->bind_param("si", $status, $exerciseId);
    $stmt->execute();
    $stmt->close();
}

function update_exercise_video($conn, $videoUrl, $exerciseId)
{
    $stmt = $conn->prepare("UPDATE `exercise` SET `exerciseVidUrl` = ? WHERE ID = ?");
    $stmt->bind_param("si", $videoUrl, $exerciseId);
    $stmt->execute();
    $stmt->close();
}

// MUSCLE GROUPS

function add_muscle_group($conn, $muscleID, $exerciseId)
{
    $stmt = $conn->prepare("INSERT INTO `exercise_muscle` (`exerciseID`, `muscleID`) VALUES (?, ?)");
    $stmt->bind_param("ii", $exerciseId, $muscleID);
    $stmt->execute();
    $stmt->close();
}

function remove_muscle_group($conn, $exerciseID, $removeMuscleGroupID)
{
    $stmt = $conn->prepare("DELETE FROM `exercise_muscle` WHERE `muscleID` = ? AND `exerciseID` = ?");
    $stmt->bind_param("ii", $removeMuscleGroupID, $exerciseID);
    $stmt->execute();
    $stmt->close();
}

// EQUIPMENTS

function add_equipments($conn, $equipmentID, $exerciseId)
{
    $stmt = $conn->prepare("INSERT INTO `exercise_equipment` (`exerciseID`, `equipmentID`) VALUES (?, ?)");
    $stmt->bind_param("ii", $exerciseId, $equipmentID);
    $stmt->execute();
    $stmt->close();
}

function remove_equipments($conn, $exerciseID, $removeEquipmentID)
{
    $stmt = $conn->prepare("DELETE FROM `exercise_equipment` WHERE `equipmentID` = ? AND `exerciseID` = ?");
    $stmt->bind_param("ii", $removeEquipmentID, $exerciseID);
    $stmt->execute();
    $stmt->close();
}


// CATEGORIES

function add_categories($conn, $categoryID, $exerciseId)
{
    $stmt = $conn->prepare("INSERT INTO `exercise_category` (`exerciseID`, `categoryID`) VALUES (?, ?)");
    $stmt->bind_param("ii", $exerciseId, $categoryID);
    $stmt->execute();
    $stmt->close();
}

function remove_categories($conn, $exerciseID,  $removeCategoryID)
{
    $stmt = $conn->prepare("DELETE FROM `exercise_category` WHERE `categoryID` = ? AND `exerciseID` = ?");
    $stmt->bind_param("ii", $removeCategoryID, $exerciseID);
    $stmt->execute();
    $stmt->close();
}

// STEPS FUNCTIONS

function add_exercise_steps($conn, $addExerciseStep, $exerciseId)
{
    $stmt = $conn->prepare("INSERT INTO `exercise_steps` (`exerciseID`, `step_instruction`) VALUES (?, ?)");
    $stmt->bind_param("is", $exerciseId, $addExerciseStep);
    $stmt->execute();
    $stmt->close();
}

function update_exercise_steps($conn, $updateExerciseStep, $stepId)
{
    $stmt = $conn->prepare("UPDATE `exercise_steps` SET `step_instruction` = ? WHERE ID = ?");
    $stmt->bind_param("si", $updateExerciseStep, $stepId);
    $stmt->execute();
    $stmt->close();
}

function remove_exercise_steps($conn, $stepId)
{
    $stmt = $conn->prepare("DELETE FROM `exercise_steps` WHERE `ID` = ?");
    $stmt->bind_param("i", $stepId);
    $stmt->execute();
    $stmt->close();
}

function handle_video_file($folder, $video)
{
    //check for errors
    $videoErrors = [];

    //image handler for inputs
    $video = $video;
    $video_name = $video['name'];
    $video_type = $video['type'];
    $video_tmp = $video['tmp_name'];
    $video_error = $video['error'];
    $video_size = $video['size'];

    // Explode file name and get the extension at the end
    $video_Ext = explode(".", $video_name);
    $video_ActualExt = strtolower(end($video_Ext));

    $allowedTypes = array("mp4");

    if (!in_array($video_ActualExt, $allowedTypes)) {
        $videoErrors[] = "Uploaded File is not Supported";
    }

    if ($video_error !== 0) {
        $videoErrors[] = "There was an error uploading your file";
    }

    // Check if video is greater than 2MB
    if ($video_size > 50000000) {
        $videoErrors[] = "Your file is too big!";
    }

    if (count($videoErrors) == 0) {
        $fileNameNew = uniqid("", true) . "." . $video_ActualExt;
        $fileDestination = $folder . $fileNameNew;
        move_uploaded_file($video_tmp, $fileDestination);
        return $fileNameNew;
    } else {
        return "none";
    }
}


//Updating exercise profile

function update_exercise_profile($conn, $photoUrl, $exerciseId)
{
    $stmt = $conn->prepare("UPDATE `exercise` SET `exercisePicUrl` = ? WHERE ID = ?");
    $stmt->bind_param("si", $photoUrl, $exerciseId);
    $stmt->execute();
    $stmt->close();
}

function handle_picture_file($pictureFolder, $picture)
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
        $fileDestination = $pictureFolder . $fileNameNew;
        move_uploaded_file($picture_tmp, $fileDestination);
        return $fileNameNew;
    } else {
        return "";
    }
}
