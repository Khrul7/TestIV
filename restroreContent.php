<?php
$dbHost = "localhost";
$dbUser = "root";
$password = "";
$dbName = "newsletter";

$connection = new mysqli($dbHost, $dbUser, $password, $dbName);

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

if (isset($_GET["NewsID"])) {
    $NewsID = $_GET["NewsID"];

    // Update the 'archived' column to 0 to indicate restoration
    $sql = "UPDATE newsletter SET archived = 0 WHERE NewsID = ?";
    $stmt = $connection->prepare($sql);

    if (!$stmt) {
        die("Prepare failed: " . $connection->error);
    }

    $stmt->bind_param("s", $NewsID);

    if (!$stmt->execute()) {
        die("Execute failed: " . $stmt->error);
    }

    $stmt->close();
}

// Redirect back to the archived content page after restoration
header("Location: archivedContent.php");
exit;
?>