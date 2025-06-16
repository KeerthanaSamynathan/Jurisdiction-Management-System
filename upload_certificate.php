<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['role'] !== 'student') {
    header("Location: index.php");
    exit;
}
include('connection.php');


error_reporting(E_ALL);
ini_set('display_errors', 1);


$target_dir = "uploads/";
if (!is_dir($target_dir)) {
    mkdir($target_dir, 0755, true);
}

if (isset($_POST['submit'])) {
    $username = $_SESSION['username']; // Change to username
    if (!isset($username)) {
        echo "Session username not set.";
        exit;
    }

    $certificate_name = mysqli_real_escape_string($conn, $_POST['certificate_name']);
    $target_file = $target_dir . basename($_FILES["certificate"]["name"]);
    $uploadOk = 1;
    $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    
    if ($_FILES["certificate"]["size"] > 5000000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    
    $allowed_types = ["pdf", "jpg", "jpeg", "png"];
    if (!in_array($fileType, $allowed_types)) {
        echo "Sorry, only PDF, JPG, JPEG, and PNG files are allowed.";
        $uploadOk = 0;
    }

    
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        if (move_uploaded_file($_FILES["certificate"]["tmp_name"], $target_file)) {
            $sql = "INSERT INTO certificates (username, certificate_name, file_path) VALUES ('$username', '$certificate_name', '$target_file')"; // Change to username
            if (mysqli_query($conn, $sql)) {
                echo "The file " . htmlspecialchars(basename($_FILES["certificate"]["name"])) . " has been uploaded.";
            } else {
                echo "Sorry, there was an error saving your file information to the database: " . mysqli_error($conn);
            }
        } else {
            echo "Sorry, there was an error moving your file. Error: " . $_FILES['certificate']['error'];
        }
    }
}
?>
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
            background-color: rgba(255, 255, 255, 0.8); /* Semi-transparent background */
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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Certificate</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include "navbar.php"; ?>
    <video muted autoplay="autoplay" loop class="VideoBg">
        <source src="/backpic.mp4" type="video/mp4">
    </video>
    <div class="container mt-5">
        <h1 class="text-center">Upload Document</h1>
        <form action="upload_certificate.php" method="POST" enctype="multipart/form-data" class="mt-4">
            <div class="mb-3">
                <label for="certificate_name" class="form-label">Document Name</label>
                <input type="text" class="form-control" id="certificate_name" name="certificate_name" required>
            </div>
            <div class="mb-3">
                <label for="certificate" class="form-label">Select Document</label>
                <input type="file" class="form-control" id="certificate" name="certificate" required>
            </div>
            <button type="submit" class="btn btn-primary" name="submit"  style=" background-color: rgb(134, 81, 58); border:none">Upload</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
