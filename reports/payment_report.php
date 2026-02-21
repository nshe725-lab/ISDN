<?php
include('../includes/db.php');

// Total Payments
$totalPaymentsQuery = "SELECT COUNT(*) AS total FROM payments";
$totalPaymentsResult = $conn->query($totalPaymentsQuery);
$totalPayments = $totalPaymentsResult->fetch_assoc()['total'];

// Total Revenue
$totalRevenueQuery = "SELECT SUM(amount) AS revenue FROM payments";
$totalRevenueResult = $conn->query($totalRevenueQuery);
$totalRevenue = $totalRevenueResult->fetch_assoc()['revenue'];

// Latest Payment
$latestQuery = "SELECT MAX(payment_date) AS latest FROM payments";
$latestResult = $conn->query($latestQuery);
$latestDate = $latestResult->fetch_assoc()['latest'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Payment Report</title>
    <style>
        body { font-family: Arial; text-align:center; }
        .card {
            width: 300px;
            margin: 20px auto;
            padding: 20px;
            border-radius: 10px;
            background-color: #f2f2f2;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }
        h2 { margin-bottom: 30px; }
    </style>
</head>
<body>

<h2>Payment Report</h2>

<div class="card">
    <h3>Total Payments</h3>
    <p><?php echo $totalPayments; ?></p>
</div>

<div class="card">
    <h3>Total Revenue</h3>
    <p>Rs. <?php echo number_format($totalRevenue,2); ?></p>
</div>

<div class="card">
    <h3>Latest Payment Date</h3>
    <p><?php echo $latestDate; ?></p>
</div>

<br>
<a href="../admin/admin_dashboard.php">Back to Dashboard</a>

</body>
</html>