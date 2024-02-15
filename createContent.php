<?php
$dbHost = "localhost";
$dbUser = "root";
$password = "";
$dbName = "newsletter";

// Create connection
$connection = new mysqli($dbHost, $dbUser, $password, $dbName);

$Content = "";
$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $Content = $_POST["Content"];

    do {
        if (empty($Content)) {
            $errorMessage = "All the fields are required";
            break;
        }

        // Add new preference to the database with the creation timestamp
        $sql = "INSERT INTO newsletter (Content) VALUES ('$Content')";
        $result = $connection->query($sql);

        if (!$result) {
            $errorMessage = "Invalid query: " . $connection->error;
            break;
        }

        $Content = "";

        $successMessage = "Preference added correctly";

        header("location: adminMain.php");
        exit;

    } while (false);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CARS.CO</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
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
<script>
        // After 2 minutes, redirect to deleteContent.php to delete the content
        setTimeout(function(){
            window.location.href = "deleteOldContent.php?NewsID=<?php echo $connection->insert_id; ?>";
        }, 120000); // 120000 milliseconds = 2 minutes
    </script>
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
    <div class="container my-5">
        <h2>New newsletter</h2>

        <?php
        if (!empty($errorMessage)){
            echo "
            <div class='alert alert-warning alert-dismissiblefade show' role='alert'>
            <strong>$errorMessage</strong>
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
            ";
        }
        ?>

        <form method="post">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Content</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="Content" value="<?php echo $Content; ?>">
                </div>
            </div>
            
           


            <?php
            if (!empty ($successMessage)){
                echo "
                <div class='row mb-3'>
                    <div class='offset-sm-3 col-sm-6'>
                        <div class='alert alert-success alert-dismissible fade show' role='alert'>
                            <strong>$successMessage</strong>
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                            </div>
                        </div>
                    </div>
                </div>
                    ";
            }
            ?>
            <div class="row mb-3">
                <div class="offset-sm-3 col-sm d-grid">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="adminMain.php" role="button">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</body>
</html>