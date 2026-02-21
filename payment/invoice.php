<?php
include("../includes/db.php");

if(!isset($_GET['id'])) {
    die("Invalid Invoice ID");
}

$id = $_GET['id'];

$sql = "SELECT * FROM payments WHERE payment_id = $id";
$result = $conn->query($sql);

if($result->num_rows == 0){
    die("Invoice not found.");
}

$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Invoice</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background:#f4f6f9; }
        .invoice-box {
            background:white;
            padding:40px;
            margin-top:50px;
            box-shadow:0 0 15px rgba(0,0,0,0.1);
        }
        .invoice-header {
            border-bottom:2px solid #ddd;
            margin-bottom:20px;
            padding-bottom:10px;
        }
        @media print {
            .no-print { display:none; }
            body { background:white; }
        }
    </style>
</head>
<body>

<div class="container">
    <div class="invoice-box">

        <div class="invoice-header text-center">
            <h2>GreenLife Organic Store</h2>
            <p>Payment Invoice</p>
        </div>

        <table class="table table-borderless">
            <tr>
                <th>Invoice No:</th>
                <td><?php echo $row['payment_id']; ?></td>
            </tr>
            <tr>
                <th>Order ID:</th>
                <td><?php echo $row['order_id']; ?></td>
            </tr>
            <tr>
                <th>Payment Method:</th>
                <td><?php echo ucfirst($row['payment_method']); ?></td>
            </tr>
            <tr>
                <th>Status:</th>
                <td><?php echo $row['payment_status']; ?></td>
            </tr>
            <tr>
                <th>Date:</th>
                <td><?php echo $row['payment_date']; ?></td>
            </tr>
            <tr class="fw-bold fs-5">
                <th>Total Amount:</th>
                <td>Rs. <?php echo number_format($row['amount'],2); ?></td>
            </tr>
        </table>

        <div class="text-end no-print">
            <button onclick="window.print()" class="btn btn-success">Print Invoice</button>
            <a href="view_payments.php" class="btn btn-primary">Back</a>
        </div>

    </div>
</div>

</body>
</html>