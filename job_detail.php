<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

$conn = mysqli_connect("localhost", "root", "mysql", "datanya");
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

if(!isset($_GET['id'])) {
    header("Location: jobs.php");
    exit();
}

$job_id = intval($_GET['id']);

$query = "SELECT * FROM jobs WHERE id = $job_id";
$result = mysqli_query($conn, $query);

if(mysqli_num_rows($result) == 0) {
    echo "Job not found!";
    exit();
}

$job = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= htmlspecialchars($job['title']) ?> - JobConnect</title>
<style>
body {
    margin: 0;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #f4f6f9;
    color: #333;
}

header {
    background-color: #0077b6;
    color: white;
    padding: 15px 40px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

header a {
    color: white;
    text-decoration: none;
    background-color: red;
    padding: 8px 16px;
    border-radius: 5px;
    font-weight: bold;
}

.container {
    display: flex;
    min-height: calc(100vh - 70px);
}

.sidebar {
    width: 250px;
    background-color: #023e8a;
    color: white;
    padding: 30px 20px;
}

.sidebar a {
    display: block;
    color: white;
    text-decoration: none;
    padding: 10px 15px;
    margin: 8px 0;
    border-radius: 5px;
}

.sidebar a:hover {
    background-color: #0077b6;
}

.main-content {
    flex: 1;
    padding: 40px;
}

.job-detail-card {
    background-color: white;
    padding: 25px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}

.job-detail-card h2 {
    color: #0077b6;
    margin-top: 0;
}

.job-detail-card p {
    margin: 8px 0;
}

.back-btn {
    background-color: #0077b6;
    color: white;
    padding: 8px 15px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    text-decoration: none;
}

.back-btn:hover {
    background-color: #00b4d8;
}
</style>
</head>
<body>

<header>
    <h1>JobConnect</h1>
    <a href="logout.php">Logout</a>
</header>

<div class="container">
    <div class="sidebar">
        <h3>Menu</h3>
        <a href="home.php">🏠 Dashboard</a>
        <a href="add_job.php">➕ Tambah Pekerjaan</a>
        <a href="jobs.php">🔍 Cari Pekerjaan</a>
    </div>

    <div class="main-content">
        <div class="job-detail-card">
            <h2><?= htmlspecialchars($job['title']) ?></h2>
            <p><strong>Lokasi:</strong> <?= htmlspecialchars($job['location']) ?></p>
            <p><strong>Deskripsi:</strong> <?= nl2br(htmlspecialchars($job['description'])) ?></p>
            <p><strong>Persyaratan:</strong> <?= nl2br(htmlspecialchars($job['requirements'])) ?></p>
            <p><strong>Gaji:</strong> <?= htmlspecialchars($job['salary']) ?: '-' ?></p>
            <p><strong>Diposting pada:</strong> <?= date("d M Y", strtotime($job['date_posted'])) ?></p>
            <a href="jobs.php" class="back-btn">← Kembali</a>
        </div>
    </div>
</div>

</body>
</html>
