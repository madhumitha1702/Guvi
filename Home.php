<?php 

session_start();
$USERID = $_SESSION["USERID"];

if($USERID == '')
{
    session_destroy();

    header('location:index.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="Home.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard</title>
</head>
<body>
  <div id="sidebar">
  
    <h2>GUVI</h2>
    <ul>
	
  <li><a href="http://localhost/edit/index.php" target="_blank">Home</a></li>
      <li><a href="http://localhost/edit/profile.php">Update</a></li>
	 <li><a href="http://localhost/edit/proff.php">Profile</a></li>
     <li><a href="http://localhost/edit/logout.php">Logout</a></li>
    </ul>
  </div>
  <div id="content">
    <h1>Dashboard</h1>
    
  </div>

</body>
</html>