<?php
include('../includes/db.php');$message = "";

if(isset($_POST['pay'])){

    $order_id = $_POST['order_id'];
    $amount = $_POST['amount'];
    $method = $_POST['method'];

    $stmt = $conn->prepare("INSERT INTO payments (order_id, amount, payment_method, payment_status) VALUES (?, ?, ?, 'Completed')");
    $stmt->bind_param("ids", $order_id, $amount, $method);

    if($stmt->execute()){
        $message = "✅ Payment Successful!";
    } else {
        $message = "❌ Payment Failed!";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Make Payment</title>
</head>
<body>

<h2>Payment Page</h2>

<p style="color:green;"><?php echo $message; ?></p>

<form method="POST">

    Order ID:<br>
    <input type="number" name="order_id" required><br><br>

    Amount:<br>
    <input type="number" step="0.01" name="amount" required><br><br>

    Payment Method:<br>
    <select name="method">
        <option value="Card">Card</option>
        <option value="Cash">Cash</option>
    </select><br><br>

    <button type="submit" name="pay">Pay Now</button>

</form>

<br>
<a href="../admin/admin_dashboard.php">Back to Dashboard</a>

</body>
</html>