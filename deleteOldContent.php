<?php
$dbHost = "localhost";
$dbUser = "root";
$password = "";
$dbName = "newsletter";

// Create connection
$connection = new mysqli($dbHost, $dbUser, $password, $dbName);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Calculate the timestamp for 2 minutes ago
$twoMinutesAgo = time() - (2 * 60);

// Delete content older than 2 minutes
$sql = "DELETE FROM newsletter WHERE createAt < FROM_UNIXTIME(?)";
$stmt = $connection->prepare($sql);

if (!$stmt) {
    die("Prepare failed: " . $connection->error);
}

$stmt->bind_param("i", $twoMinutesAgo);

if (!$stmt->execute()) {
    die("Execute failed: " . $stmt->error);
}

$stmt->close();
$connection->close();
?>
