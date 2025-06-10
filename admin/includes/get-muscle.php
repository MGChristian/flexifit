<?php
if ($_SERVER['REQUEST_METHOD'] == "GET") {
    header("Content-type: application/json");
    $muscleList = [];
    require_once "../../includes/config.php";
    $stmt = $conn->prepare("SELECT `ID`, `muscle_name`, `muscle_pic_url`, `date_created` FROM `muscle`");
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        $stmt->close();
    }
    if ($result->num_rows > 0) {
        while ($rows = $result->fetch_assoc()) {
            $id = $rows['ID'];
            $muscleList[] = array(
                "id" => $id,
                "muscleName" => $rows['muscle_name'],
                "dateCreated" => $rows['date_created'],
                "buttons" => "<div class='action-button-container'>" . view_button($id) . edit_button($id) . archive_button($id) . "</div>",
            );
        }
    } else {
        $muscleList[] = array(
            "id" => 'Empty List',
            "muscleName" => '',
            "dateCreated" => '',
            "buttons" => '',
        );
    }
    echo json_encode(["data" => $muscleList]);
}

function view_button($id)
{
    return "<a href='./edit-muscle.php?id={$id}'><button type='button' class='data-table-button view' data-target='view-instructor'> <i class='fa fa-eye' aria-hidden='true'></i> </button></a>";
}

function edit_button($id)
{
    return "<a href='./edit-muscle.php?id={$id}'><button type='button' class='data-table-button edit' data-target='edit-instructor'> <i class='fa fa-pencil-square-o' aria-hidden='true'></i> </button></a>";
}

function archive_button($id)
{
    return "<a href='./includes/delete-muscle.php?id={$id}'><button type='button' class='data-table-button archive' data-target='archive-instructor'> <i class='fa fa-archive' aria-hidden='true'></i> </button></a>";
}
