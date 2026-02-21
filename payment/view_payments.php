<?php
include('../includes/db.php');

// Fetch all payments
$sql = "SELECT * FROM payments ORDER BY payment_date DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Payments</title>
    <style>
        body {
            font-family: Arial;
        }
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        h2 {
            text-align: center;
        }
        .back-btn {
            display: inline-block;
            margin-top: 20px;
        }
    </style>
</head>
<body>

<h2>All Payments</h2>

<table>
    <th>Action</th>
    <tr>
        <th>Payment ID</th>
        <th>Order ID</th>
        <th>Amount</th>
        <th>Method</th>
        <th>Status</th>
        <th>Date</th>
    </tr>

  <?php
if ($result->num_rows > 0) {
while($row = $result->fetch_assoc()) {
    echo "<tr>
            <td>".$row['payment_id']."</td>
            <td>".$row['order_id']."</td>
            <td>".$row['amount']."</td>
            <td>".$row['payment_method']."</td>
            <td>".$row['payment_status']."</td>
            <td>".$row['payment_date']."</td>
            <td>
                
               <td>
                    <a href='invoice.php?id=".$row['payment_id']."' target='_blank'>Invoice</a> |
                    <a href='delete_payment.php?id=".$row['payment_id']."' 
                    onclick=\"return confirm('Are you sure?')\">
                    Delete
    </a>
</td>
            </td>
          </tr>";
}

    
} else {
    echo "<tr><td colspan='7'>No Payments Found</td></tr>";
}
?>

</table>

<br>
<a class="back-btn" href="../admin/admin_dashboard.php">Back to Dashboard</a>

</body>
</html>