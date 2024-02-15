<?php
session_start();

include("database.php");

$act = (isset($_POST['act'])) ? trim($_POST['act']) : '';
$error = "";

if ($act == "login") {
    $username = (isset($_POST['username'])) ? trim($_POST['username']) : '';
    $password = (isset($_POST['password'])) ? trim($_POST['password']) : '';

    $SQL_login = "SELECT * FROM `admin` WHERE `username` = '$username' AND `password` = '$password'";

    $result = mysqli_query($con, $SQL_login);
    $valid = mysqli_num_rows($result);

    if ($valid > 0) {
        $_SESSION["password"] = $password;
        $_SESSION["username"] = $username;
        header("Location: admimain.php");
        exit;
    } else {
        $error = "Invalid credentials";
    }
}
?>

<!DOCTYPE html>
<html>
<title>newspaper</title>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
        }

        .topnav {
            position: relative;
            overflow: hidden;
            background-color: #333;
        }

        .topnav a {
            float: left;
            color: #f2f2f2;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
            font-size: 17px;
        }

        .topnav a:hover {
            background-color: #ddd;
            color: black;
        }

        .topnav a.active {
            background-color: #FFD700; /* Changed to gold */
            color: black;
        }

        .topnav-centered a {
            float: none;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .topnav-right {
            float: right;
        }

        /* Responsive navigation menu (for mobile devices) */
        @media screen and (max-width: 600px) {
            .topnav a, .topnav-right {
                float: none;
                display: block;
            }

            .topnav-centered a {
                position: relative;
                top: 0;
                left: 0;
                transform: none;
            }
        }

        .dot {
            height: 25px;
            width: 25px;
            background-color: #FFD700;
            border-radius: 50%;
            display: inline-block;
        }

         .container {
            text-align: center; /* Center aligns the content horizontally */
            margin-top: 50px; /* Adjust margin as needed */
        }

        .card-container {
            display: flex; /* Use flexbox to align cards side by side */
            justify-content: center; /* Center the cards horizontally */
        }

        .card {
            box-shadow: 4px 4px 8px 4px rgba(0,0,0,0.1); /* Adjust shadow properties */
            transition: 0.3s;
            width: calc(50% - 60px); /* Adjust card width */
            border-radius: 5px; /* Increased border radius for a nicer look */
            margin: 10px; /* Add some margin for spacing between the cards */
            overflow: hidden; /* Ensure content does not overflow */
        }

        .card img {
            width: 50%; /* Ensure the image fills the entire card */
            border-radius: 10px 10px 0 0; /* Adjust border radius for the top corners */
        }

        .card-content {
            padding: 5px; /* Add padding to the card content */
            text-align: center; /* Center align the content */
        }

      
    </style>
</head>
<body>

<!-- Top navigation -->
<div class="topnav">
    <!-- Centered link -->
    <div class="topnav-centered">
        <a href="adminMain.php" class="active"> Admin Main</a> <!-- Changed class to active -->
    </div>
  
    <!-- Right-aligned links -->
    <div class="topnav-right">
        <a href="createContent.php">Content</a>
        <a href="login.php">Logout</a>
    </div>
</div>

<div style="text-align:center">
    <br><br><br><br>
    <span class="dot"></span>
    <span class="dot"></span>
    <span class="dot"></span>
    <span class="dot"></span>
</div>

<div class="container">
    <h2>Welcome, Admin</h2>
    <div class="card-container">
        <div class="card">
            <img src="newspaper.jpeg" alt="newspaper">
            <div class="container card-content">
    <a href="createContent.php" style="text-decoration: none; color: inherit;">
        <h4><b>Create Content</b></h4>
    </a>
</div>
        </div>
        <div class="card">
            <img src="newspaper.jpeg" alt="newspaper">
            <div class="container card-content">
    <a href="listContent.php" style="text-decoration: none; color: inherit;">
        <h4><b>List Content</b></h4>
    </a>
</div>
        </div>
        
    </div>
</div>

</body>
</html>
