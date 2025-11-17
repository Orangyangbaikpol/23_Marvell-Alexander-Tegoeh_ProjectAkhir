<?php
$conn = mysqli_connect("localhost", "root", "mysql", "datanya");

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $umur = $_POST['umur'];
    $gender = $_POST['gender'];


    $sql = "INSERT INTO Register (fullname, email, password, umur, gender)
            VALUES ('$fullname', '$email', '$password', '$umur','$gender')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Pendaftaran berhasil! Silakan login.'); window.location='login.php';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun - JobConnect</title>
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
        <h2>Buat Akun Baru</h2>
        <form method="POST" action="">
            <input type="text" name="fullname" placeholder="Nama Lengkap" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Kata Sandi" required>
            <input type="number" name="umur" placeholder="Umur" required>
            <select name="gender" required style="width:100%;padding:10px;margin:8px 0;border:none;border-radius:5px;">
                <option value="" disabled selected>Pilih Gender</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Rather not say">Rather not say</option>
            </select>
            <input type="submit" value="Daftar">
        </form>
        <p>Sudah punya akun? <a href="login.php">Login di sini</a></p>
    </div>
</body>
</html>
