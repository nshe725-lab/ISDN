<?php
include("../includes/db.php");

<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include("../includes/db.php");

// Get revenue grouped by date
$sql = "SELECT DATE(payment_date) as pay_date, 
               SUM(amount) as total_revenue 
        FROM payments 
        WHERE payment_status = 'Completed'
        GROUP BY DATE(payment_date)
        ORDER BY pay_date ASC";

$result = $conn->query($sql);

$dates = [];
$revenues = [];

while($row = $result->fetch_assoc()){
    $dates[] = $row['pay_date'];
    $revenues[] = $row['total_revenue'];
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Revenue Chart</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow p-4">
        <h3 class="text-center mb-4">Revenue Report</h3>

        <canvas id="revenueChart"></canvas>

        <div class="text-end mt-4">
            <a href="admin_dashboard.php" class="btn btn-primary">Back to Dashboard</a>
        </div>
    </div>
</div>

<script>
const ctx = document.getElementById('revenueChart').getContext('2d');

new Chart(ctx, {
    type: 'bar',
    data: {
        labels: <?php echo json_encode($dates); ?>,
        datasets: [{
            label: 'Revenue (Rs)',
            data: <?php echo json_encode($revenues); ?>,
            backgroundColor: 'rgba(40, 167, 69, 0.7)'
        }]
    },
    options: {
        responsive: true,
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
</script>

</body>
</html>