<?php
if ($_SERVER['REQUEST_METHOD'] == "GET") {
    header("Content-type: application/json");
    $equipmentList = [];
    require_once "../../includes/config.php";
    $stmt = $conn->prepare("SELECT `ID`, `equipment_name`, `equipment_pic_url`, `equipment_description`, `dateCreated` FROM `equipment`");
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        $stmt->close();
    }
    if ($result->num_rows > 0) {
        while ($rows = $result->fetch_assoc()) {
            $id = $rows['ID'];
            $equipmentList[] = array(
                "id" => $id,
                "equipmentName" => $rows['equipment_name'],
                "equipmentDescription" => $rows['equipment_description'],
                "dateCreated" => $rows['dateCreated'],
                "imageUrl" => $rows['equipment_pic_url'],
                "buttons" => "<div class='action-button-container'>" . view_button($id) . archive_button($id) . "</div>",
            );
        }
    } else {
        $equipmentList[] = array(
            "id" => 'Empty List',
            "equipmentName" => '',
            "equipmentDescription" => '',
            "imageUrl" => '',
            "dateCreated" => '',
            "buttons" => '',
        );
    }
    echo json_encode(["data" => $equipmentList]);
}

function view_button($id)
{
    return "<button type='button' class='view data-table-button view-btn' data-id='{$id}'> <i class='fa fa-eye' aria-hidden='true'></i> </button>";
}

function archive_button($id)
{
    return "<a href='./includes/delete-equipment.php?id={$id}'><button type='button' class='data-table-button archive'> <i class='fa fa-archive' aria-hidden='true'></i> </button></a>";
}
