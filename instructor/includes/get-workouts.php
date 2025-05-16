<?php
if ($_SERVER['REQUEST_METHOD'] == "GET") {
    header("Content-type: application/json");
    $instructorsList = [];
    require_once "../../includes/config.php";
    require_once "../../includes/config_session.inc.php";

    if (isset($_GET['id']) && !empty($_GET['id'])) {
        $instructorId = $_GET['id'];
    } else {
        $instructorId = null;
    }


    $stmt = $conn->prepare("SELECT `ID`, `workoutName`, `workoutDescription`, `difficulty`, `status`, `dateCreated` FROM `workout` WHERE `userID` = ?");
    $stmt->bind_param("i", $instructorId);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();

    if ($result->num_rows > 0) {
        while ($rows = $result->fetch_assoc()) {
            $id = $rows['ID'];
            $workoutName = $rows['workoutName'];
            $description = $rows['workoutDescription'];
            $difficulty = $rows['difficulty'];
            $status = $rows['status'] === 1 ? "active" : "inactive";
            $dateCreated = $rows['dateCreated'];
            $workoutList[] = array(
                "id" => $id,
                "workoutName" => $workoutName,
                "description" => $description,
                "difficulty" => $difficulty,
                "status" => $status,
                "dateCreated" => $dateCreated,
                "buttons" => "<div class='action-button-container'>" . view_button($id) . edit_button($id) . archive_button($id) . "</div>",
            );
        }
    } else {
        $workoutList[] = array(
            "id" => '',
            "workoutName" => '',
            "description" => '',
            "difficulty" => '',
            "status" => '',
            "dateCreated" => '',
            "buttons" => '',
        );
    }
    echo json_encode(["data" => $workoutList]);
}

function view_button($id)
{
    return "<a href='./edit-workout.php?id={$id}'><button type='button' class='data-table-button view' data-target='view-instructor'> <i class='fa fa-eye' aria-hidden='true'></i> </button></a>";
}

function edit_button($id)
{
    return "<a href='./edit-workout.php?id={$id}'><button type='button' class='data-table-button edit' data-target='edit-instructor'> <i class='fa fa-pencil-square-o' aria-hidden='true'></i> </button></a>";
}

function archive_button($id)
{
    return "<a href='./includes/archive-instructor.php?ID={$id}'><button type='button' class='data-table-button archive' data-target='archive-instructor'> <i class='fa fa-archive' aria-hidden='true'></i> </button></a>";
}
