<?php

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    require_once "../includes/config.php";
    require_once "../includes/config_session.inc.php";

    // Id of the user creating the exercise
    $collection_creator = isset($_SESSION['id']) ? $_SESSION['id'] : '';
    $collection_name = $_POST['collectionName'];
    $collection_description = $_POST['collectionDescription'];

    try {
        // Error handlers
        $errors = [];

        if (is_input_empty($collection_creator, $collection_name, $collection_description)) {
            $errors["empty_input"] = "Please fill in all the fields!";
        }

        if ($errors) {
            $_SESSION['error_login'] = $errors;
            header("Location: ../user-my-collection.php");
            exit();
        } else {
            create_collection($conn, $collection_creator, $collection_name, $collection_description);
            header("Location: ../user-my-collection.php?status=success");
            exit();
        }
    } catch (\Throwable $th) {
        exit("Query failed: " . $th->getMessage());
    }
} else {
    header("Location: ../");
    exit();
}

//Validate and check inputs
function is_input_empty($collection_creator, $collection_name, $collection_description)
{
    if (
        empty($collection_creator) ||
        empty($collection_name) ||
        empty($collection_description)
    ) {
        return true;
    } else {
        return false;
    }
}

function create_collection($conn, $collection_creator, $collection_name, $collection_description)
{
    $conn->begin_transaction();
    try {
        $stmt = $conn->prepare("INSERT INTO `collection` (`userID`, `collectionName`, `description`) VALUES (?, ?, ?)");
        $stmt->bind_param("iss", $collection_creator, $collection_name, $collection_description);
        if (!$stmt->execute()) {
            exit("SQL Error: " . $stmt->error);
        }
        $conn->commit();
        $stmt->close();
    } catch (\Throwable $th) {
        exit("Query failed: " . $th->getMessage());
    }
}
