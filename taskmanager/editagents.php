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
  header("Location: login.php");
  exit;
}
?>

<!DOCTYPE html>
<html>


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
	<table class = "centertable">

					<form class="white">
		
		<tr>
			<th style=" color:dodgerblue;"> Username:
  					<br>
		<input name="id_agent[]" type="hidden" value="<?php echo  $row['id_agent'] ?>" />
			<input name="agent_username[]" type="text" style="font-weight:bold;" value="<?php echo $row['agent_username'] ?>" />
		</th>
	</tr>
		
		<tr>
  					<th style=" color:dodgerblue;"> Password:
  					<br>
		
			<input name="agent_password[]" type="text" style=" font-weight:bold;" value="<?php echo $row['agent_password'] ?>" />
		</th>
	</tr>
			
		<tr>
  					<th style=" color:dodgerblue;"> Name:
  					<br>
			<input name="agent_name[]" type="text" style=" font-weight:bold;" value="<?php echo $row['agent_name'] ?>" />
		</th>
	</tr>

		<tr>
  					<th style=" color:dodgerblue;"> Email:
  					<br>
			<input name="agent_email[]" type="text" style=" font-weight:bold;" value="<?php echo $row['agent_email'] ?>" />
		</th>
	</tr>

		<tr>
  					<th style=" color:dodgerblue;"> Permission:
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

			<tr><th><br><input type="submit" name="update" value="Update"></th></tr>

</table>

	<br />	
<?php 
}
}
?>

</form>

	<?php
		include ('view/footer.php');
	?>

</html>