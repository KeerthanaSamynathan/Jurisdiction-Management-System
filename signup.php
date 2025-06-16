<?php
if (session_status() === PHP_SESSION_NONE) { session_start(); }
if(isset($_SESSION['loggedin'])){ header("Location: welcome.php"); exit; }
include("connection.php");

if(isset($_POST['submit'])){
    $username = mysqli_real_escape_string($conn, $_POST['user']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['pass']);
    $cpassword = mysqli_real_escape_string($conn, $_POST['cpass']);
    $phoneno = mysqli_real_escape_string($conn, $_POST['phoneno']);
    $age = mysqli_real_escape_string($conn, $_POST['age']);
    $role = isset($_POST['source']) && ($_POST['source'] === 'student_login.php' || $_POST['source'] === 'student_login') ? 'student' : 'student';

    // Email validation
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_message = "Invalid email address";
    }
    // Phone number validation
    elseif (!preg_match('/^[0-9]{10}$/', $phoneno)) {
        $error_message = "Invalid phone number";
    }
    // Age validation
    elseif ($age < 0 || $age > 120) {
        $error_message = "Invalid age";
    }
    // Password validation
    elseif (!preg_match('/^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/', $password)) {
        $error_message = "Password must be at least 8 characters long and include at least one uppercase letter, one number, and one special character";
    }
    else {
        $sql = "SELECT * FROM users WHERE username='$username'";
        $result = mysqli_query($conn, $sql);
        $count_user = mysqli_num_rows($result);

        $sql = "SELECT * FROM users WHERE email='$email'";
        $result = mysqli_query($conn, $sql);
        $count_email = mysqli_num_rows($result);

        if($count_user == 0 && $count_email == 0){
            if($password == $cpassword){
                $hash = password_hash($password, PASSWORD_DEFAULT);
                $sql = "INSERT INTO users(username, email, password, phoneno, age, role) VALUES('$username', '$email', '$hash', '$phoneno', '$age', '$role')";
                $result = mysqli_query($conn, $sql);
                if($result){
                    if ($role == 'student') { header("Location: signupuser.php"); }
                    else if ($role == 'staff') { header("Location: signuplawyer.php"); }
                    exit;
                }
            } else {
                $error_message = "Passwords do not match";
            }
        } else {
            $error_message = "Username or Email already exists!";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <style>
        body { 
            overflow: hidden; 
            background: black; 
            font-family: Arial, sans-serif;
            color: #333;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            position: relative;
            overflow: hidden;
        }
        .VideoBg { 
            position: fixed; 
            right: 0; 
            bottom: 0; 
            min-width: 100%; 
            min-height: 100%; 
            width: auto; 
            height: auto; 
            z-index: -1; 
        }
        .container1 { 
            max-width: 800px; 
            margin: 50px auto; 
            padding: 20px; 
            background-color: rgba(255, 255, 255, 0.4); 
            border-radius: 10px; 
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); 
            display: flex; 
            flex-direction: column; 
            align-items: center; 
            position: relative; 
            z-index: 1; 
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
    <div class="row justify-content-center mt-5">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h1 class="text-center">Sign Up Form</h1>
                    <form action="signup.php" method="POST" class="mt-4">
                        <input type="hidden" name="source" value="<?php echo isset($_POST['source']) ? $_POST['source'] : ''; ?>">
                        <div class="mb-3">
                            <label for="user" class="form-label">Enter Username:</label>
                            <input type="text" class="form-control" id="user" name="user" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Enter Email:</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="phoneno" class="form-label">Enter Phone Number:</label>
                            <input type="text" class="form-control" id="phoneno" name="phoneno" required>
                        </div>
                        <div class="mb-3">
                            <label for="age" class="form-label">Enter Age:</label>
                            <input type="number" class="form-control" id="age" name="age" required>
                        </div>
                        <div class="mb-3">
                            <label for="pass" class="form-label">Create Password:</label>
                            <input type="password" class="form-control" id="pass" name="pass" required>
                        </div>
                        <div class="mb-3">
                            <label for="cpass" class="form-label">Retype Password:</label>
                            <input type="password" class="form-control" id="cpass" name="cpass" required>
                        </div>
                        <?php if(isset($error_message)): ?>
                            <div class="alert alert-danger" role="alert"><?= $error_message ?></div>
                        <?php endif; ?>
                        <button type="submit" class="btn btn-primary" name="submit" style="background-color: rgb(134, 81, 58); border:none">Sign Up</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
