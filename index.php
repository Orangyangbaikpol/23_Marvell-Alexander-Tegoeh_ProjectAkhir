<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JobConnect - Find Your Dream Job</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(to right, #0077b6, #00b4d8);
            color: white;
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 50px;
        }

        header h1 {
            font-size: 28px;
        }

        nav a {
            color: white;
            text-decoration: none;
            margin: 0 15px;
            font-weight: bold;
        }

        nav a:hover {
            text-decoration: underline;
        }

        .hero {
            text-align: center;
            margin-top: 100px;
        }

        .hero h2 {
            font-size: 48px;
            margin-bottom: 20px;
        }

        .hero p {
            font-size: 20px;
            margin-bottom: 40px;
        }

        .hero a {
            background: white;
            color: #0077b6;
            padding: 15px 30px;
            border-radius: 5px;
            font-weight: bold;
            text-decoration: none;
            transition: 0.3s;
        }

        .hero a:hover {
            background: #caf0f8;
        }
    </style>
</head>
<body>

    <header>
        <h1>JobConnect</h1>
        <nav>
            <a href="login.php">Login</a>
            <a href="signup.php">Sign Up</a>
        </nav>
    </header>

    <section class="hero">
        <h2>Find Your Dream Job</h2>
        <p>Connecting talent with opportunities. Start your journey today.</p>
        <a href="signup.php">Get Started</a>
    </section>

</body>
</html>
