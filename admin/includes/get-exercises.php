<?php
if ($_SERVER['REQUEST_METHOD'] == "GET") {
    header("Content-type: application/json");
    $instructorsList = [];
    require_once "../../includes/config.php";
    $stmt = $conn->prepare("SELECT `ID`, `exerciseName`, `description`, `status`, `dateCreated` FROM `exercise`");
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        $stmt->close();
    }
    if ($result->num_rows > 0) {
        while ($rows = $result->fetch_assoc()) {
            $id = $rows['ID'];
            $exerciseName = $rows['exerciseName'];
            $description = $rows['description'];
            $status = $rows['status'] === 1 ? "active" : "inactive";
            $dateCreated = $rows['dateCreated'];
            $exerciseList[] = array(
                "id" => $id,
                "exerciseName" => $exerciseName,
                "description" => $description,
                "status" => $status,
                "dateCreated" => $dateCreated,
                "buttons" => "<div class='action-button-container'>" . edit_button($id) . "</div>",
            );
        }
    } else {
        $exerciseList[] = array(
            "id" => 'Empty Exercises',
            "exerciseName" => '',
            "description" => '',
            "status" => '',
            "dateCreated" => '',
            "buttons" => "",
        );
    }
    echo json_encode(["data" => $exerciseList]);
}

function view_button($id)
{
    return "<a href='./edit-exercise.php?id={$id}'><button type='button' class='data-table-button view' data-target='view-instructor'> <i class='fa fa-eye' aria-hidden='true'></i> </button></a>";
}

function edit_button($id)
{
    return "<a href='./edit-exercise.php?id={$id}'><button type='button' class='data-table-button edit' data-target='edit-instructor'> <i class='fa fa-pencil-square-o' aria-hidden='true'></i> </button></a>";
}

function archive_button($id)
{
    return "<a href='./includes/archive-instructor.php?ID={$id}'><button type='button' class='data-table-button archive' data-target='archive-instructor'> <i class='fa fa-archive' aria-hidden='true'></i> </button></a>";
}
