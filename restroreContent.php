<?php
if (isset($_GET["NewsID"])) {
    $NewsID = $_GET["NewsID"];

    // Create a new database connection
    $connection = new mysqli($dbHost, $dbUser, $password, $dbName);

    // Check if the connection was successful
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }

    // Update the 'archived' column to 0 to indicate restoration
    $sql = "UPDATE newsletter SET archived = 0 WHERE NewsID = ?";
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

// Redirect back to the archived content page after restoration
header("Location: archivedContent.php");
exit;
?>
