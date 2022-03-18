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
table{
   margin-left: auto;
  margin-right: auto;
  width: 70%;
  border-collapse: collapse;
}
th{
 	background-color: #D6EEEE;
}
 th, td {
 	border-style:solid;
  border-color: #96D4D4;
}
</style>
</head>
<body>
<form action="editagents.php" method="post">
<table>
		<div class="alert alert-success">
			<h2 style="text-align:center; ">Списък работници</h2>
		</div>
		<thead>
			<tr style="height:50px">
				<th style="text-align:center;">Номер на работник</th>
				<th style="text-align:center;">Име и фамилия</th>
				<th style="text-align:center;">Потребителско име</th>
				<th style="text-align:center;">Имейл</th>
				<th style="text-align:center;">Достъп</th>
				<th><button id = "update_btn" class="btn brand z-deth-0"  name="submit_mult" type="submit">
		Обнови данни
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
			<tr style="height:30px">
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
</html>