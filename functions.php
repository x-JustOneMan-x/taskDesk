<?php 
if(isset($_POST['action'])) {
    switch ($_POST['action']) {
        case 'changePosition':
            changePosition($_POST['id'], $_POST['x'], $_POST['y']);
            break;
        case 'removeTask':
            removeTask($_POST['id']);
            break;
        case 'addTask':
            addTask();
            break;
        case 'editTask':
            editTask();
    }
}

function changePosition($id, $posX, $posY) {
    include_once 'inc/dbconfig.php';

    $query = "UPDATE `task_items` SET `positionX` = '$posX', `positionY` = '$posY' WHERE `id` = '$id'";
    if($conn->query($query)) $res = 'done';
    else $res = "error: " . $conn->error;
    $conn->close();
    return $res;
}

function addTask() {
    include_once 'inc/dbconfig.php';

    $title = $_POST["title"];
    $text = $_POST["text"];
    $color = $_POST["color"];
    $posX = 20;
    $posY = 20;
    $query = "INSERT INTO `task_items` VALUES (NULL, '$title', '$text', '$color', $posX, $posY)";
    $conn->query($query);
    echo $conn->insert_id;
    $conn->close();
}

function removeTask($id) {
    include_once 'inc/dbconfig.php';

    $query = "DELETE FROM `task_items` WHERE `id` = '$id'";
    if($conn->query($query)) $res = 'done';
    else $res = "error";
    $conn->close();
    return $res;
}

function editTask() {
    include_once 'inc/dbconfig.php';

    $title = $_POST["title"];
    $text = $_POST["text"];
    $id = $_POST["id"];

    $query = "UPDATE `task_items` SET `title` = $title, `text` = $text WHERE `id` = $id";

    if($conn->query($query)) $res = 'done';
    else $res = "error: " . $conn->error;
    $conn->close();
    echo $res;
}