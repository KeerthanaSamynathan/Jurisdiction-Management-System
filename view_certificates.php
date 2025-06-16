<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['role'] !== 'student') {
    header("Location: index.php");
    exit;
}
include('connection.php');

$username = $_SESSION['username']; // Assuming the username is stored in the session

// Fetch certificates using username
$sql_certificates = "SELECT certificate_name, file_path 
                    FROM certificates 
                    WHERE username = '$username'";
$result_certificates = mysqli_query($conn, $sql_certificates);

// Check for errors in query execution
if (!$result_certificates) {
    die("Error: " . mysqli_error($conn));
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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Documents</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include "navbar.php"; ?>
    <video muted autoplay="autoplay" loop class="VideoBg">
        <source src="/backpic.mp4" type="video/mp4">
    </video>
    <div class="container mt-5">
        <h1 class="text-center">My Documents</h1>
        <table class="table table-striped mt-4">
            <thead>
                <tr>
                    <th>Document Name</th>
                    <th>View Document</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($result_certificates) > 0) {
                    while ($row = mysqli_fetch_assoc($result_certificates)) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['certificate_name']) . "</td>";
                        echo "<td><a href='" . htmlspecialchars($row['file_path']) . "' target='_blank'>View</a></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='2' class='text-center'>No certificates found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
