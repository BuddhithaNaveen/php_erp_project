<?php
include 'db_connection.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "DELETE FROM customers WHERE id = $id";
    if ($conn->query($sql)) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error deleting customer.";
    }

} else {
    header("Location: index.php");
    exit();
}
?>