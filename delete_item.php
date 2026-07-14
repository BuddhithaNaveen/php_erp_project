<?php
include 'db_connection.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "DELETE FROM items WHERE id = $id";
    if ($conn->query($sql)) {
        header("Location: ./items.php");
        exit();
    } else {
        echo "Error deleting Item.";
    }

} else {
    header("Location: ./items.php");
    exit();
}
?>