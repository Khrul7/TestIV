<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Archived Content</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
  <style>
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
            background-color: #FFD700;
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
  </style>
</head>
<body>

<!-- Top navigation -->
<div class="topnav">
    <!-- Centered link -->
    <div class="topnav-centered">
        <a href="adminMain.php">Admin Main</a>
        <a href="archivedContent.php" class="active">Archived Content</a>
    </div>
  
    <!-- Right-aligned links -->
    <div class="topnav-right">
        <a href="createContent.php">Content</a>
        <a href="login.php">Logout</a>
    </div>
</div>

  <div class="container my-5">
    <h2>Archived Content</h2><br>
    <a class="btn btn-primary" href="createContent.php" role="button">New Content</a>
    <br><br>
    <table class="table">
      <thead>
        <tr>
          <th>Content</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $dbHost = "localhost";
        $dbUser = "root";
        $password = "";
        $dbName = "newsletter";

        // Create connection
        $connection = new mysqli($dbHost, $dbUser, $password, $dbName);

        // Check connection
        if ($connection->connect_error) {
            die("Connection failed: ". $connection->connect_error);
        }

        // Read archived data from the database
        $sql = "SELECT * FROM newsletter WHERE archived = 1";
        $result = $connection->query($sql);

        if (!$result) {
            die("Invalid query: ".$connection->error);
        }

        // Display archived content
        while ($row = $result->fetch_assoc()) {
            echo "
            <tr>
                <td>$row[Content]</td>
                <td>
                    <a class='btn btn-primary btn-sm' href='updateContent.php?NewsID=$row[NewsID]'> Edit </a>
                    <a class='btn btn-primary btn-sm' href='listContent.php?NewsID=$row[NewsID]'> Restore </a>
                </td>
            </tr>";
        }
        ?>
      </tbody>
    </table>
  </div>

</body>
</html>
