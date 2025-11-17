<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

$fullname = $_SESSION['fullname'];
$email = $_SESSION['email'];
$umur = $_SESSION['umur'];
$gender = $_SESSION['gender'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - JobConnect</title>
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

        header h1 {
            margin: 0;
            font-size: 24px;
        }

        header a {
            color: white;
            text-decoration: none;
            background-color:rgb(255, 0, 0);
            padding: 8px 16px;
            border-radius: 5px;
            font-weight: bold;
        }

        header a:hover {
            background-color: #00b4d8;
        }

        .container {
            display: flex;
            height: calc(100vh - 70px);
        }

        .sidebar {
            width: 250px;
            background-color: #023e8a;
            color: white;
            padding: 30px 20px;
        }

        .sidebar h3 {
            text-align: center;
            margin-bottom: 30px;
        }

        .sidebar a {
            display: block;
            color: white;
            text-decoration: none;
            padding: 10px 15px;
            margin: 8px 0;
            border-radius: 5px;
            transition: background 0.3s;
        }

        .sidebar a:hover {
            background-color: #0077b6;
        }

        .main-content {
            flex: 1;
            padding: 40px;
        }

        .profile-card {
            background-color: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            width: 400px;
        }

        .profile-card h2 {
            color: #0077b6;
            margin-top: 0;
        }

        .profile-info p {
            margin: 8px 0;
            font-size: 16px;
        }

        .actions {
            margin-top: 20px;
        }

        .actions button {
            background-color: #0077b6;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            margin-right: 10px;
        }

        .actions button:hover {
            background-color: #00b4d8;
        }
    </style>
</head>
<body>
    <header>
        <h1>JobConnect Dashboard</h1>
        <a href="logout.php">Logout</a>
    </header>

    <div class="container">
        <div class="sidebar">
            <h3>Menu</h3>
            <a href="home.php">🏠 Dashboard</a>
            <a href="jobs.php">🔍 Cari Pekerjaan</a>
        </div>

        <div class="main-content">
            <div class="profile-card">
                <h2>Profil Anda</h2>
                <div class="profile-info">
                    <p><strong>Nama:</strong> <?= htmlspecialchars($fullname) ?></p>
                    <p><strong>Email:</strong> <?= htmlspecialchars($email) ?></p>
                    <p><strong>Umur:</strong> <?= htmlspecialchars($umur) ?> tahun</p>
                    <p><strong>Gender:</strong> <?= htmlspecialchars($gender) ?></p>
                </div>

                <div class="actions">
                    <a href="editprof.php" style="text-decoration: none;">
                        <button type="button">Edit Profil</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
