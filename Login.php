<?php
$conn = mysqli_connect("localhost", "root", "mysql", "datanya");

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM Register WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        if (password_verify($password, $row['password'])) {
            $_SESSION['fullname'] = $row['fullname'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['umur'] = $row['umur'];
            $_SESSION['gender'] = $row['gender'];
            $_SESSION['user_id'] = $row['id'];

            echo "<script>alert('Login berhasil! Selamat datang, " . $row['fullname'] . "'); window.location='home.php';</script>";
        } else {
            echo "<script>alert('Password salah!');</script>";
        }
    } else {
        echo "<script>alert('Email tidak ditemukan!');</script>";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - JobConnect</title>
    <style>
        body {
            background: linear-gradient(to right, #0077b6, #00b4d8);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background: rgba(255, 255, 255, 0.1);
            padding: 40px;
            border-radius: 10px;
            width: 350px;
            text-align: center;
        }

        h2 {
            margin-bottom: 20px;
        }

        input {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border: none;
            border-radius: 5px;
        }

        input[type="submit"] {
            background-color: white;
            color: #0077b6;
            font-weight: bold;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #caf0f8;
        }

        a {
            color: #fff;
        }
            .back-btn {
        position: absolute;
        top: 20px;
        left: 20px;
        text-decoration: none;
        background-color: white;
        color: #0077b6;
        padding: 8px 15px;
        border-radius: 5px;
        font-weight: bold;
        transition: 0.3s;
    }

    .back-btn:hover {
        background-color: #caf0f8;
    }

    </style>
</head>
<body>
    <a href="index.php" class="back-btn">← Kembali</a>
    <div class="container">
        <h2>Login ke Akun Anda</h2>
        <form method="POST" action="">
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Kata Sandi" required>
            <input type="submit" value="Login">
        </form>
        <p>Belum punya akun? <a href="signup.php">Daftar di sini</a></p>
    </div>
</body>
</html>
