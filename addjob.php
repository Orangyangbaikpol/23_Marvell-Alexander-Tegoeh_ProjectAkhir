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

// Use user_id from session
$user_id = $_SESSION['user_id'] ?? 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $requirements = $_POST['requirements'];
    $location = $_POST['location'];
    $salary = $_POST['salary'];

    mysqli_query($conn, "INSERT INTO jobs (employer_id, title, description, requirements, location, salary)
        VALUES ('$user_id', '$title', '$description', '$requirements', '$location', '$salary')");

    echo "<script>alert('Pekerjaan berhasil diposting!'); window.location='jobs.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Posting Pekerjaan</title>
<style>
body { margin:0; font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background:#f4f6f9; }
header { background:#0077b6; color:white; padding:15px 40px; display:flex; justify-content:space-between; align-items:center; }
header a { color:white; text-decoration:none; background:red; padding:8px 16px; border-radius:5px; font-weight:bold; }
header a:hover { background:#00b4d8; }
.container { display:flex; height:calc(100vh - 70px); }
.sidebar { width:250px; background:#023e8a; color:white; padding:30px 20px; }
.sidebar h3 { text-align:center; margin-bottom:30px; }
.sidebar a { display:block; color:white; text-decoration:none; padding:10px 15px; margin:8px 0; border-radius:5px; }
.sidebar a:hover { background:#0077b6; }
.main-content { flex:1; padding:40px; }
.job-form { background:white; padding:25px; border-radius:10px; width:500px; }
.job-form h2 { color:#0077b6; margin-top:0; }
.job-form input, .job-form textarea { width:100%; padding:10px; margin:8px 0; border:1px solid #ccc; border-radius:5px; }
.job-form button { background:#0077b6; color:white; padding:10px 20px; border:none; border-radius:5px; cursor:pointer; }
.job-form button:hover { background:#00b4d8; }
</style>
</head>
<body>

<header>
    <h1>JobConnect - Posting Pekerjaan</h1>
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
        <div class="job-form">
            <h2>Tambah Lowongan Kerja</h2>
            <form method="POST">
                <input type="text" name="title" placeholder="Judul Pekerjaan" required>
                <textarea name="description" placeholder="Deskripsi Pekerjaan (2-5 kalimat)" rows="4" required></textarea>
                <textarea name="requirements" placeholder="Persyaratan (pisahkan baris)" rows="4" required></textarea>
                <input type="text" name="location" placeholder="Lokasi" required>
                <input type="text" name="salary" placeholder="Gaji (opsional)">
                <button type="submit">Posting</button>
            </form>
        </div>
    </div>
</div>

</body>
</html>
