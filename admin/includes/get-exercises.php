<?php
if ($_SERVER['REQUEST_METHOD'] == "GET") {
    header("Content-type: application/json");
    $instructorsList = [];
    require_once "../../userpage/includes/config_session.inc.php";
    require_once "../../userpage/includes/config.php";
    $stmt = $conn->prepare("SELECT `ID`, `exerciseName`, `description`, `dateCreated` FROM `exercise`");
    $buttonsView = "<button type='button' class='data-table-button view' data-target='view-instructor'> <i class='fa fa-eye' aria-hidden='true'></i> </button>";
    $buttonsEdit = "<button type='button' class='data-table-button edit' data-target='edit-instructor'> <i class='fa fa-pencil-square-o' aria-hidden='true'></i> </button>";
    $buttonsArchive = "<button type='button' class='data-table-button archive' data-target='archive-instructor'> <i class='fa fa-archive' aria-hidden='true'></i> </button>";
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        $stmt->close();
    }
    if ($result->num_rows > 0) {
        while ($rows = $result->fetch_assoc()) {
            $exerciseList[] = array(
                "id" => $rows['ID'],
                "exerciseName" => $rows['exerciseName'],
                "description" => $rows['description'],
                "dateCreated" => $rows['dateCreated'],
                "buttons" => "<div class='action-button-container'>" . $buttonsView . $buttonsEdit . $buttonsArchive . "</div>",
            );
        }
    } else {
        $exerciseList[] = array(
            "status" => "empty",
        );
    }
    echo json_encode(["data" => $exerciseList]);
}

function check_authorization() {}
