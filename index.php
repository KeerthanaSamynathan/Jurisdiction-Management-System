<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jurisdiction Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
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
</head>
<body>
    <video muted autoplay="autoplay" loop class="VideoBg">
        <source src="/backpic.mp4" type="video/mp4">
    </video>

    <?php include "navbar.php"; ?>

    <div class="container">
        <div id="kctlogo">
            <img src="uploads/1925305-middle-removebg-preview.png" alt="KCT Logo">
        </div>
        <h1>Welcome to the Intercase Jurisdiction Management System</h1>
        <div class="row justify-content-center mt-3">
            <p><b>"The primary objective of the Integrated Case & Jurisdiction Management System (ICJMS) is to streamline and simplify the administration of jurisdictional information and cases in a wide range of courts and legal organizations. The system handles jurisdiction-specific rules and regulations and acts as a comprehensive platform to make case registration, tracking, administration, and reporting easier. The goal of ICJMS is to improve the effectiveness, transparency, and accessibility of the legal case processing method for all parties concerned, including lawyers, judges, court employees, and members of the public."</b></p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
