<?php
$dbHost = "localhost";
$dbUser = "root";
$password = "";
$dbName = "newsletter";

$connection = new mysqli($dbHost, $dbUser, $password, $dbName);

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

$twoMinutesAgo = date('Y-m-d H:i:s', strtotime('-2 minutes'));

// Update this query to mark as archived instead of deleting
$sql = "UPDATE newsletter SET archived = TRUE WHERE created_at < '$twoMinutesAgo' AND archived = FALSE";

if ($connection->query($sql) === TRUE) {
    echo "Content older than 2 minutes has been archived.";
} else {
    echo "Error: " . $sql . "<br>" . $connection->error;
}

$connection->close();
?>
