<?php
$dbHost = "localhost";	// Database host, server
$dbUser = "root";		// Database user
$password = "";			// Database password
$dbName = "newsletter";		// Database name

//Create connection
$connection = new mysqli($dbHost, $dbUser, $password, $dbName);

$NewsID = "";
$Content = "";


$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // GET method: Show the data of the preference

    // Check if "carID" parameter is set in the URL
    if (!isset($_GET["NewsID"])) {
        // If not set, redirect to admin preferences page
        header("location: adminMain.php");
        exit;
    }

    // Get the carID value from the URL
    $NewsID = $_GET["NewsID"];

    // Prepare and execute the SQL query to retrieve preference data based on carModel
    $sql = "SELECT * FROM newsletter WHERE NewsID = ?";
    $stmt = $connection->prepare($sql);
    
    // Check if the statement was prepared successfully
    if (!$stmt) {
        $errorMessage = "Prepare failed: " . $connection->error;
    } else {
        // Bind the parameter and execute the statement
        $stmt->bind_param("s", $NewsID);
        $stmt->execute();

        // Get the result
        $result = $stmt->get_result();

        // Fetch the row
        $row = $result->fetch_assoc();

        // Check if the row exists
        if (!$row) {
            // If the row doesn't exist, redirect to admin preferences page
            header("location: adminMain.php");
            exit;
        }

        // Assign values from the database to variables
        $Content = $row["Content"];
        
    }

    // Close the statement
    $stmt->close();
}

else{
    //POST method: Update the data of the data of the preference

    $NewsID = $_POST["NewsID"];
    $Content = $_POST["Content"];
    

    do {
        if (empty($Content) ) {
            $errorMessage = "All the fields are required";
            break;
        }
    
        // edit preference in the database
        $sql = "UPDATE newsletter 
                SET Content = ? 
                WHERE NewsID = ?";
    
        $stmt = $connection->prepare($sql);
    
        if (!$stmt) {
            $errorMessage = "Prepare failed: " . $connection->error;
            break;
        }
    
        // Bind parameters and execute the statement
        $stmt->bind_param("ss", $Content, $NewsID);
        $stmt->execute();
    
        // Check if the update was successful
        if ($stmt->affected_rows > 0) {
            $successMessage = "Preference updated correctly";
            header("location: listContent.php");
            exit;
        } else {
            $errorMessage = "No rows were updated";
        }
    
        // Close the statement
        $stmt->close();
    } while (false); 
     
}
?>

<!DOCTYPE html>
<html lang="en">
<title>newsletter</title>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container my-5">
        <h2>View Newsletter</h2>

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
            <input type="hidden" name="NewsID" value="<?php echo $NewsID; ?>">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Content</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="Content" value="<?php echo $Content; ?>"readonly>
                </div>
            </div>

            


            
        
        </form>
    </div>
</body>
</html>