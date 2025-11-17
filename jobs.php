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
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Cari Pekerjaan - JobConnect</title>

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

.job-card {
    background-color: white;
    padding: 20px;
    border-radius: 10px;
    margin-bottom: 20px;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}

.job-card h3 {
    margin: 0 0 10px;
    color: #0077b6;
}

.job-card p {
    margin: 5px 0;
    font-size: 14px;
}

.job-card-button {
    display: inline-block;
    background-color: #0077b6;
    color: white;
    border: none;
    padding: 8px 15px;
    border-radius: 5px;
    cursor: pointer;
    text-decoration: none;
    margin-top: 10px;
}

.job-card-button:hover {
    background-color: #00b4d8;
}
</style>
</head>
<body>

<header>
    <h1>Cari Pekerjaan</h1>
    <a href="logout.php">Logout</a>
</header>

<div class="container">
    <div class="sidebar">
        <h3>Menu</h3>
        <a href="home.php">🏠 Dashboard</a>
        <a href="jobs.php">🔍 Cari Pekerjaan</a>
        <a href="addjob.php">➕ Tambah Pekerjaan</a>
    </div>

    <div class="main-content">
        <h2>Daftar Lowongan</h2>

        <?php
        $query = "SELECT * FROM jobs ORDER BY date_posted DESC";
        $result = mysqli_query($conn, $query);

        if(mysqli_num_rows($result) > 0) {
            while($job = mysqli_fetch_assoc($result)) {
                echo '<div class="job-card">';
                echo '<h3>'.htmlspecialchars($job['title']).'</h3>';
                echo '<p><strong>Lokasi:</strong> '.htmlspecialchars($job['location']).'</p>';
                echo '<p><strong>Deskripsi:</strong> '.htmlspecialchars(substr($job['description'],0,100)).'...</p>';
                echo '<p><strong>Diposting pada:</strong> '.date("d M Y", strtotime($job['date_posted'])).'</p>';
                echo '<a href="job_detail.php?id='.$job['id'].'" class="job-card-button">Lihat Detail</a>';
                echo '</div>';
            }
        } else {
            echo '<p>Tidak ada lowongan tersedia saat ini.</p>';
        }
        ?>
    </div>
</div>

</body>
</html>
