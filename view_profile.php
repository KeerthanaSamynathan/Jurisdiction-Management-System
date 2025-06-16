<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['role'] !== 'student') {
    header("Location: index.php");
    exit;
}

include('connection.php');

$username = $_SESSION['username'];
$sql = $conn->prepare("SELECT name, email, age, phoneno FROM users WHERE username = ?");
$sql->bind_param("s", $username);
$sql->execute();
$result = $sql->get_result();
$user = $result->fetch_assoc();

if (!$user) {
    die("User not found.");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<style>
        body {
            font-family: Arial, sans-serif;
            color: #333;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            position: relative;
            overflow: hidden; /* Ensure the content fits within the screen */
        }
        .VideoBg {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: -1; /* Ensure the video stays behind other elements */
        }
        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.4); /* Semi-transparent background */
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            align-items: center;
            position: relative;
            z-index: 1; /* Ensure the container stays above the video */
        }
        #kctlogo {
            margin-bottom: 30px;
        }
        #kctlogo img {
            max-width: 200px;
            height: auto;
            display: block;
            margin: 0 auto; 
        }
        h1 {
            text-align: center;
            font-size: 28px;
            color: black;
            margin-bottom: 20px;
        }
        p {
            font-size: 16px;
            line-height: 1.6;
            margin-bottom: 15px;
            text-align: center;
        }
    </style>
<body>
    <?php include "navbar.php"; ?>
    <video muted autoplay="autoplay" loop class="VideoBg">
        <source src="/backpic.mp4" type="video/mp4">
    </video>
    <br><br><br>
    <br>
    <br><br><br><br>
    <div class="container mt-5" style="background-color: rgba(255, 255, 255, 0.8); justify-content:center; display:flex; ">
        <h1 class="text-center">Profile</h1>
        <p><strong>Email:</strong> <?= htmlspecialchars($user['email'] ?? 'Not specified') ?></p>
        <p><strong>Phone Number:</strong> <?= htmlspecialchars($user['phoneno'] ?? 'Not specified') ?></p>
        <p><strong>Age:</strong> <?= htmlspecialchars($user['age'] ?? 'Not specified') ?></p>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
