<?php
$stats = getAdminStats($pdo);
$chartData = getAppChartData($pdo);


$labels = [];
$counts = [];
foreach (array_reverse($chartData) as $row) {
    $labels[] = date('M d', strtotime($row['date']));
    $counts[] = $row['count'];
}
?>


<link rel="stylesheet" href="styles/overview.css">

<div class="stats-grid">
    <div class="stat-card blue">
        <div class="stat-info"><small>Total Users</small><h2><?php echo $stats['users']; ?></h2></div>
        <i class="fa-solid fa-users"></i>
    </div>
    <div class="stat-card purple">
        <div class="stat-info"><small>Total Jobs</small><h2><?php echo $stats['jobs']; ?></h2></div>
        <i class="fa-solid fa-briefcase"></i>
    </div>
    <div class="stat-card orange">
        <div class="stat-info"><small>Total Applications</small><h2><?php echo $stats['apps']; ?></h2></div>
        <i class="fa-solid fa-file-invoice"></i>
    </div>
    <div class="stat-card green">
        <div class="stat-info"><small>Successful Hires</small><h2><?php echo $stats['hires']; ?></h2></div>
        <i class="fa-solid fa-user-check"></i>
    </div>
</div>

<div class="overview-row" style="grid-template-columns: 1fr;">
    <div class="content-card">
        <h3>Application Activity (Last 7 Days)</h3>
        <div style="height: 300px; margin-top: 20px;">
            <canvas id="appChart"></canvas>
        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const ctx = document.getElementById('appChart').getContext('2d');
new Chart(ctx, {
    type: 'bar',
    data: {
        labels: <?php echo json_encode($labels); ?>,
        datasets: [{
            label: 'Applications',
            data: <?php echo json_encode($counts); ?>,
            backgroundColor: '#2563eb',
            borderRadius: 8,
            barThickness: 40
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: { legend: { display: false } },
        scales: {
            y: { beginAtZero: true, grid: { display: false } },
            x: { grid: { display: false } }
        }
    }
});
</script>