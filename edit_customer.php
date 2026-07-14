<?php
include 'db_connection.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "UPDATE customers 
    SET 
    WHERE id = $id";
    if ($conn->query($sql)) {
        header("Location: index.php");
        exit();
    } else {
        echo "Customer Edit Unsuccessfull.";
    }

} else {
    header("Location: index.php");
    exit();
}
?>

luckshinif@csquarefintech.com
support@csqure.cloud