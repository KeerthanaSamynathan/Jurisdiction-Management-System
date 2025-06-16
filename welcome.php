<?php
session_start();
if(!isset($_SESSION['loggedin'])){
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
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
    <div class="container mt-5">
        <h1 class="text-center">Welcome <?= $_SESSION['username'] ?></h1>
        <?php if ($_SESSION['role'] === 'student'): ?>
            
            <div class="row mt-4">
                <div class="col-md-4">
                    <div class="card" style="background-color: transparent; border:none;">
                        <div class="card-body text-center">
                            <a href="view_profile.php" class="btn btn-primary" style=" background-color: rgb(134, 81, 58); border:none">View Profile</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card" style="background-color: transparent; border:none;">
                        <div class="card-body text-center">
                            <a href="upload_certificate.php" class="btn btn-primary"  style=" background-color: rgb(134, 81, 58); border:none">Upload Document</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card" style="background-color: transparent; border:none;">
                        <div class="card-body text-center">
                            <a href="appointments.php" class="btn btn-primary"  style=" background-color: rgb(134, 81, 58); border:none">Appointments</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
