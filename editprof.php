<?php
session_start();
$conn = mysqli_connect("localhost", "root", "mysql", "datanya");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

$email = $_SESSION['email'];

// Get user info
$query = "SELECT * FROM Register WHERE email = '$email'";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);

if (isset($_POST['update'])) {
    $fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
    $umur = mysqli_real_escape_string($conn, $_POST['umur']);

    // Update the user data in the database
    $update_query = "UPDATE Register SET fullname='$fullname', umur='$umur' WHERE email='$email'";

    if (mysqli_query($conn, $update_query)) {
        // Update session variables so homepage shows new info immediately
        $_SESSION['fullname'] = $fullname;
        $_SESSION['umur'] = $umur;

        header("Location: home.php?updated=1");
        exit();
    } else {
        echo "Error updating profile: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profil - JobConnect</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f6f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        form {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            width: 400px;
        }

        h2 {
            text-align: center;
            color: #0077b6;
        }

        label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            margin-top: 20px;
            width: 100%;
            background-color: #0077b6;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #00b4d8;
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
    <a href="home.php" class="back-btn">← Kembali</a>
    <form method="POST">
        <h2>Edit Profil</h2>

        <label>Nama Lengkap:</label>
        <input type="text" name="fullname" value="<?= htmlspecialchars($user['fullname']) ?>" required>

        <label>Umur:</label>
        <input type="number" name="umur" value="<?= htmlspecialchars($user['umur']) ?>" required>

        <!-- <label>Password:</label>
        <input type= -->

        <button type="submit" name="update">Simpan Perubahan</button>
    </form>
</body>
</html>
