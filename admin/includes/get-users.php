<?php
if ($_SERVER['REQUEST_METHOD'] == "GET") {
    header("Content-type: application/json");
    $usersList = [];
    require_once "../../includes/config.php";
    $stmt = $conn->prepare("SELECT `ID`, `firstName`, `lastName`, `dateCreated`, `DOB`, `gender`, `email`, `contactNo` FROM `user` WHERE `role` = 'user' && `status` = 'active'");
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        $stmt->close();
    }
    if ($result->num_rows > 0) {
        while ($rows = $result->fetch_assoc()) {
            $id = $rows['ID'];
            $usersList[] = array(
                "id" => $rows['ID'],
                "userName" => $rows['firstName'] . " " . $rows['lastName'],
                "dateJoined" => $rows['dateCreated'],
                "birthdate" => $rows['DOB'],
                "gender" => $rows['gender'],
                "email" => $rows['email'],
                "contact" => $rows['contactNo'],
                "buttons" => "<div class='action-button-container'>" . edit_button($id) . archive_button($id) . "</div>",
            );
        }
    }
    echo json_encode(["data" => $usersList]);
}

function view_button($id)
{
    return "<a href='./edit-user.php?id={$id}'><button type='button' class='data-table-button view' data-target='view-user'> <i class='fa fa-eye' aria-hidden='true'></i> </button></a>";
}

function edit_button($id)
{
    return "<a href='./edit-user.php?id={$id}'><button type='button' class='data-table-button edit' data-target='edit-user'> <i class='fa fa-pencil-square-o' aria-hidden='true'></i> </button></a>";
}

function archive_button($id)
{
    return "<a href='./includes/archive-users.php?id={$id}'><button type='button' class='data-table-button archive' data-target='archive-user'> <i class='fa fa-archive' aria-hidden='true'></i> </button></a>";
}
