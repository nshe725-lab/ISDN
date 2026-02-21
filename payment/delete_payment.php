<?php
include("../includes/db.php");

if(isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM payments WHERE payment_id = $id";

    if($conn->query($sql) === TRUE) {
        header("Location: view_payments.php");
    } else {
        echo "Error deleting record.";
    }
}
?>