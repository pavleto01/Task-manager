<?php
include('config/db_connect.php');
include ('view/header.php');	

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

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<style>
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

.button {
  background-color: dodgerblue;
  border: none;
  color: white;
  padding: 10px 25px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 14px;
  margin: 4px 2px;
  cursor: pointer;
}
</style>
	<link rel="stylesheet" href="css/main.css">
	<title>Task Managager</title>
</head>
<body>
	<br>	




	<div class = "center">
	<form method="post">
			<label >Търси задание</label>
			<input type="text" name="search">
			<input type="submit" name="submit" value = "ТЪРСИ">
			</form>	

			<?php

				if (isset($_POST["search"])) {
  	$str = $_POST["search"];
  	$sql ="SELECT case_agent.agent_id, cases.case_author, cases.id_case, cases.date_in, cases.case_title, cases.case_priority, cases.case_status FROM cases JOIN case_agent ON cases.id_case = case_agent.case_id  WHERE cases.case_title LIKE '%$str%' OR cases.case_author LIKE '%$str%' OR cases.case_status LIKE '%$str%' OR cases.case_priority LIKE '%$str%' ORDER BY cases.date_in DESC";
		$query=mysqli_query($conn,$sql)or die(mysqli_error($conn));
		while($row=mysqli_fetch_array($query)){
		$id_case=$row['id_case'];
	if($idagent == $row['agent_id'] ){
		?>
<table>
<thead>
			<tr style="height:50px">
				<th style="text-align:center;">Дата</th>
				<th style="text-align:center;">Номер на задание</th>
				<th style="text-align:center;">Автор на задание</th>
				<th style="text-align:center;">Заглавие на задание</th>
				<th style="text-align:center;">Приоритет</th>
				<th style="text-align:center;">Статус</th>
				<th style="text-align:center;">Детайли</th>
			</tr>
</thead>
<tbody>
			<tr>
				<td style="text-align:center; "><?php echo $row['date_in'] ?></td>
				<td style="text-align:center; "><?php echo $row['id_case'] ?></td>
				<td style="text-align:center; "><?php echo $row['case_author'] ?></td>
				<td style="text-align:center; "><?php echo $row['case_title'] ?></td>
				<td style="text-align:center; ">

					<?php

					if($row['case_priority'] == "LOW")
					{ ?>

						<p style="color:red;">НИСЪК</p>

					<?php } if($row['case_priority'] == "MEDIUM") { ?>

					 <p style="color:orange;">СРЕДЕН</p>

					<?php } if($row['case_priority'] == "HIGH"){ ?>

						<p style="color:green;">ВИСОК</p>

					<?php } ?>
					
				</td>
				<td style="text-align:center; ">

					<?php

					if($row['case_status'] == "OPENED")
					{ ?>

						<p style="color:green;">ОТВОРЕН</p>

					<?php } else { ?>

					 <p style="color:red;">ЗАТВОРЕН</p>
					<?php } ?>
					
				</td>
				<td style="text-align:center; ">
					
					<a  href="showdetails.php?id=<?php echo $row['id_case']; ?>">ПОКАЖИ</a>
				</td>
			</tr>			
			</tbody>	 
	</table>
	<?php } } }?>
		</div>

		<?php

				if (!isset($_POST["search"])) { ?>
	<table>
		<div class="alert alert-success">
			<h2 style="text-align:center; ">СПИСЪК ЗАДАНИЯ</h2>
		</div>
		<thead>
			<tr style="height:50px">
				<th style="text-align:center;">Дата</th>
				<th style="text-align:center;">Номер на задание</th>
				<th style="text-align:center;">Автор на задание</th>
				<th style="text-align:center;">Заглавие на задание</th>
				<th style="text-align:center;">Приоритет</th>
				<th style="text-align:center;">Статус</th>
				<th style="text-align:center;">Детайли</th>
			</tr>
		</thead>
		<tbody>

		<?php 
		$sql = "SELECT case_agent.agent_id, cases.case_author, cases.id_case, cases.date_in, cases.case_title, cases.case_priority, cases.case_status FROM cases JOIN case_agent ON cases.id_case = case_agent.case_id ORDER BY cases.date_in DESC ";
		$query=mysqli_query($conn,$sql)or die(mysqli_error());
		while($row=mysqli_fetch_array($query)){
		if($idagent == $row['agent_id'] ){
		?>
			<tr class="clickable "
		   onclick="window.location='showdetails.php?id=<?php echo $row['id_case']; ?>'">
				<td style="text-align:center; "><?php echo $row['date_in'] ?></td>
				<td style="text-align:center; "><?php echo $row['id_case'] ?></td>
				<td style="text-align:center; "><?php echo $row['case_author'] ?></td>
				<td style="text-align:center; "><?php echo $row['case_title'] ?></td>
				<td style="text-align:center; ">

					<?php

					if($row['case_priority'] == "LOW")
					{ ?>
						<p style="color:red;">НИСЪК</p>
					<?php } if($row['case_priority'] == "MEDIUM") { ?>
					 <p style="color:orange;">СРЕДЕН</p>
					<?php } if($row['case_priority'] == "HIGH"){ ?>
						<p style="color:green;">ВИСОК</p>
					<?php } ?>
					
				</td>
				<td style="text-align:center; ">

					<?php

					if($row['case_status'] == "OPENED")
					{ ?>

						<p style="color:green;">ОТВОРЕН</p>

					<?php } else { ?>

					 <p style="color:red;">ЗАТВОРЕН</p>
					<?php } ?>
					
				</td>
				<td style="text-align:center; "><a  href="showdetails.php?id=<?php echo $row['id_case']; ?>">ПОКАЖИ</a></td>			
		<?php  }  ?>
	
		</tr>				 
		</tbody>
		<?php } } ?>
	</table>

</body>
<br>
</html>