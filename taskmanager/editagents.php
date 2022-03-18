<?php 
	
include('config/db_connect.php');
include ('view/header.php');

if($perm != 1)
{
	echo ("<script LANGUAGE='JavaScript'>
    window.alert('You do not have permission! Contact administrator!');
    window.location.href='index.php';
    </script>");
}


if(!isset($_SESSION['agent_username']))
{
  ?>
  		<script type="text/javascript">
    		window.location.href = "login.php";
			</script>
<?php 
  exit;
}
?>

<!DOCTYPE html>
<html>
<style>
	.button {
  background-color: dodgerblue;
  border: none;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;
}
</style>
<body>

<br>

<form class="form-horizontal" action="edit_save.php" method="post">    
<?php
$id=$_POST['selector'];
$N = count($id);
for($i=0; $i < $N; $i++)
{
	$sql = "SELECT * FROM agents where id_agent='$id[$i]'";
$result = mysqli_query($conn, $sql);
while($row = mysqli_fetch_array($result))
{ ?>
	<section class = "container" grey-text>
	<table class = "centertable2">

					<form class="white">
		
		<tr>
			<th style=" color:dodgerblue;"> Потребителско име:
  					<br>
		<input name="id_agent[]" type="hidden" value="<?php echo  $row['id_agent'] ?>" />
			<input name="agent_username[]" type="text" style="font-weight:bold;" value="<?php echo $row['agent_username'] ?>" />
		</th>
	</tr>
		
		<tr>
  					<th style=" color:dodgerblue;"> Парола:
  					<br>
		
			<input name="agent_password[]" type="text" style=" font-weight:bold;" value="<?php echo $row['agent_password'] ?>" />
		</th>
	</tr>
			
		<tr>
  					<th style=" color:dodgerblue;"> Име и фамилия:
  					<br>
			<input name="agent_name[]" type="text" style=" font-weight:bold;" value="<?php echo $row['agent_name'] ?>" />
		</th>
	</tr>

		<tr>
  					<th style=" color:dodgerblue;"> Имейл:
  					<br>
			<input name="agent_email[]" type="text" style=" font-weight:bold;" value="<?php echo $row['agent_email'] ?>" />
		</th>
	</tr>

		<tr>
  					<th style=" color:dodgerblue;"> Достъп:
  					<br>
			<select name="perm[]" class="form-control">
      						<?php

      							$query = "SELECT * FROM permission";
      							$result = mysqli_query($conn, $query);
      							while($row = mysqli_fetch_array($result)){
      						?>
      					<option value = <?php echo $row['id_perm'];?>> <?php echo $row['permission'] ?> </option>
      				<?php } ?>
   							</select>
		</th>
	</tr>

			<tr><th><br><input type="submit" class="button" name="update" value="ОБНОВИ"></th></tr>
</table>

	<br />	
<?php 
}
}
?>

</form>
	<br>
<div class="center">
    <form action="admin.php">
        <input class="button" type="submit" name="return" value="НАЗАД">
    </form>
</div>
<br><br><br>
</body>
</html>