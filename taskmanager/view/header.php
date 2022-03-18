<?php

  error_reporting(E_ALL ^ E_WARNING);
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
<meta charset="utf-8">
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
  border:2px dodgerblue solid;
  border-collapse: collapse;
}

.centertable2 {
  margin-left: auto;
  margin-right: auto;
  width: 30%;
 
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
    <?php echo htmlspecialchars($name); ?>
    <a class="active" href="index.php">Начало</a>
    <?php if($perm == 1) {?>
    <a href="admin.php">Админ</a>
    <a href="addagent.php">Добави нов работник</a>
    <?php } ?>
    <a href="addcase.php">Добави ново задание</a>
    <?php 

    if(!isset($_SESSION['agent_username']))
  {
     ?>
    <a href="login.php">ВХОД</a>
  <?php } else { ?>
    <a href="logout.php">ИЗХОД</a>
  <?php } ?>

  </div>
</div>


</body>
</html>
