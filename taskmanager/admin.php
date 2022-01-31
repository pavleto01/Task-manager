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
			
if(isset($_POST['update_btn'])){
		echo 'No checkbox!';
	}
			
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>ADMIN</title>
	<style>
table, th, td {
  border: 20px solid white;
  border-collapse: collapse;
}
table.center {
  margin-left: auto; 
  margin-right: auto;
}
</style>
</head>
<body>
<form action="editagents.php" method="post">
<table class="center">
		<div class="alert alert-success">
			<h2 style="text-align:center; ">List of agents</h2>
		</div>
		<thead>
			<tr>
				<th style="text-align:center; color:dodgerblue;">Agent number</th>
				<th style="text-align:center; color:dodgerblue;">Agent name</th>
				<th style="text-align:center; color:dodgerblue;">Agent username</th>
				<th style="text-align:center; color:dodgerblue;">Agent email</th>
				<th style="text-align:center; color:dodgerblue;">Agent permission</th>
				<th><button id = "update_btn" class="btn brand z-deth-0"  name="submit_mult" type="submit">
		Update Data
	</button></th>
			</tr>
		</thead>
		<tbody>
		<?php 
		$sql = "SELECT agents.id_agent, agents.agent_name, agents.agent_username, agents.agent_email, permission.permission FROM agents JOIN permission ON agents.perm = permission.id_perm";
		$query=mysqli_query($conn,$sql)or die(mysqli_error());
		while($row=mysqli_fetch_array($query)){
		$id_agent=$row['id_agent'];
		?>
			<tr>
				<td style="text-align:center; "><?php echo $row['id_agent'] ?></td>
				<td style="text-align:center; "><?php echo $row['agent_name'] ?></td>
				<td style="text-align:center; "><?php echo $row['agent_username'] ?></td>
				<td style="text-align:center; "><?php echo $row['agent_email'] ?></td>
				<td style="text-align:center; "><?php echo $row['permission'] ?></td>
				<td>
					<input name="selector[]" type="checkbox" value="<?php echo $id_agent; ?>">
				</td>
			</tr>
			
		<?php  } ?>		

		</tbody>
	</table>
	
	</form>
</body>
	<?php
		include ('view/footer.php');	
	?>
</html>