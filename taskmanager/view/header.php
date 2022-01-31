<?php

error_reporting(0);
	session_start();
date_default_timezone_set("Europe/Sofia");
	if($_SERVER['QUERY_STRING'] == 'noname'){

		session_unset();

	}

	
	$username = $_SESSION['agent_username'];
	$email = $_SESSION['agent_email'];
	$idagent = $_SESSION['id_agent'];
	$name = $_SESSION['agent_name'];
  $perm = $_SESSION['perm'];

  

?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>



* {box-sizing: border-box;}

body { 
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
}

.header {
  overflow: hidden;
  background-color: #f1f1f1;
  padding: 5px 5px;
}

.header a {
  float: left;
  color: black;
  text-align: center;
  padding: 12px;
  text-decoration: none;
  font-size: 18px; 
  line-height: 25px;
  border-radius: 4px;
}

.header a.logo {
  font-size: 25px;
  font-weight: bold;
}

.header a:hover {
  background-color: #ddd;
  color: black;
}

.header a.active {
  background-color: dodgerblue;
  color: white;
}

.header-right {
  float: right;
}

.header-left {
  float: left;
}
.center {
border: 0px white;
text-align: center;
}
.centertable {
  margin-left: auto;
  margin-right: auto;
  width: 70%;
}

.centerfooter {
  margin-left: auto;
  margin-right: auto;
  width: 8em;
}
@media screen and (max-width: 500px) {
  .header a {
    float: none;
    display: block;
    text-align: left;
  }
  
  .header-right {
    float: none;
  }
}
</style>
</head>
<body>

<div class="header">
  <div class = "header-left">
  <a href="index.php">Task Manager</a>
</div>
  <div class="header-right">
    Hello <?php echo htmlspecialchars($name); ?>
    <a class="active" href="index.php">Home</a>
    <?php if($perm == 1) {?>
    <a href="admin.php">Admin</a>
    <a href="addagent.php">Add agent</a>
    <?php } ?>
    <a href="addcase.php">Add case</a>
    <a href="login.php">Login</a>
    <a href="logout.php">Logout</a>

  </div>
</div>


</body>
</html>
