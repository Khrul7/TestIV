<?php
// Check if the "NewsID" parameter is set in the GET request
if (isset($_GET["NewsID"])) {
    // Get the value of "NewsID" from the GET request
    $NewsID = $_GET["NewsID"];

    // Database connection parameters
    $dbHost = "localhost";
    $dbUser = "root";
    $password = "";
    $dbName = "newsletter";

    // Create a new database connection
    $connection = new mysqli($dbHost, $dbUser, $password, $dbName);

    // Check if the connection was successful
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }

    // Prepare an UPDATE statement using a prepared statement to update a flag or status
    $sql = "UPDATE newsletter SET archived = 1 WHERE NewsID = ?";
    $stmt = $connection->prepare($sql);

    // Check if the statement was prepared successfully
    if (!$stmt) {
        die("Prepare failed: " . $connection->error);
    }

    // Bind the "NewsID" parameter to the prepared statement
    $stmt->bind_param("s", $NewsID);

    // Execute the prepared statement
    if (!$stmt->execute()) {
        die("Execute failed: " . $stmt->error);
    }

    // Close the prepared statement
    $stmt->close();

    // Close the database connection
    $connection->close();
}

// Redirect to the admin preferences page
header("Location: listContent.php");
exit;
