<?php
if ($_SERVER['REQUEST_METHOD'] == "GET") {
    header("Content-type: application/json");
    $categoryList = [];
    require_once "../../includes/config.php";
    $stmt = $conn->prepare("SELECT `ID`, `category_name`, `category_description`, `category_pic_url`, `dateCreated` FROM `category`");
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        $stmt->close();
    }
    if ($result->num_rows > 0) {
        while ($rows = $result->fetch_assoc()) {
            $id = $rows['ID'];
            $categoryList[] = array(
                "id" => $id,
                "categoryName" => $rows['category_name'],
                "categoryDescription" => $rows['category_description'],
                "imageUrl" => $rows['category_pic_url'],
                "dateCreated" => $rows['dateCreated'],
                "buttons" => "<div class='action-button-container'>" . view_button($id) . archive_button($id) . "</div>",
            );
        }
    } else {
        $categoryList[] = array(
            "id" => 'Empty List',
            "categoryName" => '',
            "categoryDescription" => '',
            "imageUrl" => '',
            "dateCreated" => '',
            "buttons" => '',
        );
    }
    echo json_encode(["data" => $categoryList]);
}

function view_button($id)
{
    return "<button type='button' class='view data-table-button view-btn' data-id='{$id}'> <i class='fa fa-eye' aria-hidden='true'></i> </button>";
}

function archive_button($id)
{
    return "<a href='./includes/delete-category.php?id={$id}'><button type='button' class='data-table-button archive'> <i class='fa fa-archive' aria-hidden='true'></i> </button></a>";
}
