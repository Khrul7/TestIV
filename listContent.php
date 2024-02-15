<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>newsletter</title>
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
  </style>
</head>
<body>

<!-- Top navigation -->
<div class="topnav">
    <!-- Centered link -->
    <div class="topnav-centered">
        <a href="adminMain.php" class="active">Admin Main</a> <!-- Changed class to active -->
    </div>
  
    <!-- Right-aligned links -->
    <div class="topnav-right">
        <a href="createContent.php">Content</a>
        <a href="login.php">Logout</a>
    </div>
</div>

  <div class = "container my-5">
    <h2>List of Preferences</h2><br>
    <a class="btn btn-primary" href="createContent.php" role="button">New Content</a>
    <a class="btn btn-primary" href="archivedContent.php" role="button">archived Content</a>
    <br><br>
    <table class="table">
      <thead>
        <tr>
          <th>Content</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $dbHost = "localhost";	// Database host, server
        $dbUser = "root";		// Database user
        $password = "";			// Database password
        $dbName = "newsletter";		// Database name

        //Create connection
        $connection = new mysqli($dbHost, $dbUser, $password, $dbName);

        //Check connection
        if ($connection->connect_error){
            die("Connection failed: ". $connection->connect_error);
        }

        //read all the row from database table
        $sql = "SELECT * FROM newsletter";
        $result = $connection->query($sql);

        if (!$result) {
            die("Invalid query: ".$connection->error);
        }

        //read data of each row
        while($row = $result->fetch_assoc()) {
            // Check if the 'archived' value is 1
            if ($row['archived'] == 1) {
                // If archived, skip this row
                continue;
            }
        
            echo "
          <tr>
              <td>$row[Content]</td>
              <td>
                <a class='btn btn-primary btn-sm' href='updateContent.php?NewsID=$row[NewsID]'> Edit </a>
                <a class='btn btn-primary btn-sm' href='deleteContent.php?NewsID=$row[NewsID]'> Delete </a>

              </td>
              </tr>
        ";

        }

        ?>
        
      </tbody>
    </table>
  </div>
  <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Are you sure you want to delete this content?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <a id="deleteLink" class="btn btn-danger">Delete</a>
      </div>
    </div>
  </div>
</div>
</body>
</html>