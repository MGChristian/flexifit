<?php
if ($_SERVER['REQUEST_METHOD'] == "GET") {
    header("Content-type: application/json");
    $instructorsList = [];
    require_once "../../includes/config_session.inc.php";
    require_once "../../includes/config.php";
    $stmt = $conn->prepare("SELECT `ID`, `firstName`, `lastName`, `dateCreated`, `DOB`, `gender`, `email`, `contactNo` FROM `user` WHERE `role` = 'instructor' && `status` = 'active'");
    $buttonsEdit = "<button type='button' class='data-table-button edit' data-target='edit-instructor'> <i class='fa fa-pencil-square-o' aria-hidden='true'></i> </button>";
    $buttonsArchive;
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        $stmt->close();
    }
    if ($result->num_rows > 0) {
        while ($rows = $result->fetch_assoc()) {
            $id = $rows['ID'];
            $instructorsList[] = array(
                "id" => $id,
                "instructorName" => $rows['firstName'] . " " . $rows['lastName'],
                "dateJoined" => $rows['dateCreated'],
                "birthdate" => $rows['DOB'],
                "gender" => $rows['gender'],
                "email" => $rows['email'],
                "contact" => $rows['contactNo'],
                "buttons" => "<div class='action-button-container'>" . view_button($id) . edit_button($id) . archive_button($id) . "</div>",
            );
        }
    }
    echo json_encode(["data" => $instructorsList]);
}

function view_button($id)
{
    return "<a href='{$id}'><button type='button' class='data-table-button view' data-target='view-instructor'> <i class='fa fa-eye' aria-hidden='true'></i> </button></a>";
}

function edit_button($id)
{
    return "<a href='{$id}'><button type='button' class='data-table-button edit' data-target='edit-instructor'> <i class='fa fa-pencil-square-o' aria-hidden='true'></i> </button></a>";
}

function archive_button($id)
{
    return "<a href='./includes/archive-instructor.php?ID={$id}'><button type='button' class='data-table-button archive' data-target='archive-instructor'> <i class='fa fa-archive' aria-hidden='true'></i> </button></a>";
}
