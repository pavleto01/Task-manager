<?php
include('config/db_connect.php');
include ('view/header.php');	

if(!isset($_SESSION['agent_username']))
{
  header("Location: login.php");
  exit;
}
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
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
	<link rel="stylesheet" href="css/main.css">
	<title>Task Managager</title>
</head>
<body>
	<br>	




	<div class = "center">
	<form method="post">
			<label >Search Case</label>
			<input type="text" name="search">
			<input type="submit" name="submit">
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
<table class="centertable">
		
		<thead>
			<tr>
				<th style="text-align:center; color:dodgerblue;">Case date</th>
				<th style="text-align:center; color:dodgerblue;">Case number</th>
				<th style="text-align:center; color:dodgerblue;">Case author</th>
				<th style="text-align:center; color:dodgerblue;">Case Title</th>
				<th style="text-align:center; color:dodgerblue;">Case Priority</th>
				<th style="text-align:center; color:dodgerblue;">Case Status</th>
				<th style="text-align:center; color:dodgerblue;">Show details</th>
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

						<p style="color:red;">LOW</p>

					<?php } if($row['case_priority'] == "MEDIUM") { ?>

					 <p style="color:orange;">MEDIUM</p>

					<?php } if($row['case_priority'] == "HIGH"){ ?>

						<p style="color:green;">HIGH</p>

					<?php } ?>
					
				</td>
				<td style="text-align:center; ">

					<?php

					if($row['case_status'] == "OPENED")
					{ ?>

						<p style="color:green;">OPENED</p>

					<?php } else { ?>

					 <p style="color:red;">CLOSED</p>
					<?php } ?>
					
				</td>
				<td style="text-align:center; "><a href="showdetails.php?id=<?php echo $row['id_case']; ?>">Show</a></td>
			</tr>				 
		</tbody>
	</table>
	<?php } } }?>
		</div>

		<?php

				if (!isset($_POST["search"])) { ?>
	<table class="centertable">
		<div class="alert alert-success">
			<h2 style="text-align:center; ">List of cases</h2>
		</div>
		<thead>
			<tr>
				<th style="text-align:center; color:dodgerblue;">Case date</th>
				<th style="text-align:center; color:dodgerblue;">Case number</th>
				<th style="text-align:center; color:dodgerblue;">Case author</th>
				<th style="text-align:center; color:dodgerblue;">Case Title</th>
				<th style="text-align:center; color:dodgerblue;">Case Priority</th>
				<th style="text-align:center; color:dodgerblue;">Case Status</th>
				<th style="text-align:center; color:dodgerblue;">Show details</th>
			</tr>
		</thead>
		<tbody>

		<?php 
		$sql = "SELECT case_agent.agent_id, cases.case_author, cases.id_case, cases.date_in, cases.case_title, cases.case_priority, cases.case_status FROM cases JOIN case_agent ON cases.id_case = case_agent.case_id ORDER BY cases.date_in DESC ";
		$query=mysqli_query($conn,$sql)or die(mysqli_error());
		while($row=mysqli_fetch_array($query)){
		if($idagent == $row['agent_id'] ){
		?>
			<tr>
				<td style="text-align:center; "><?php echo $row['date_in'] ?></td>
				<td style="text-align:center; "><?php echo $row['id_case'] ?></td>
				<td style="text-align:center; "><?php echo $row['case_author'] ?></td>
				<td style="text-align:center; "><?php echo $row['case_title'] ?></td>
				<td style="text-align:center; ">

					<?php

					if($row['case_priority'] == "LOW")
					{ ?>
						<p style="color:red;">LOW</p>
					<?php } if($row['case_priority'] == "MEDIUM") { ?>
					 <p style="color:orange;">MEDIUM</p>
					<?php } if($row['case_priority'] == "HIGH"){ ?>
						<p style="color:green;">HIGH</p>
					<?php } ?>
					
				</td>
				<td style="text-align:center; ">

					<?php

					if($row['case_status'] == "OPENED")
					{ ?>

						<p style="color:green;">OPENED</p>

					<?php } else { ?>

					 <p style="color:red;">CLOSED</p>
					<?php } ?>
					
				</td>
				<td style="text-align:center; "><a href="showdetails.php?id=<?php echo $row['id_case']; ?>">Show</a></td>			
		<?php  }  ?>
	
		</tr>				 
		</tbody>
		<?php } } ?>
	</table>


</body>
<br>
	<?php
		include ('view/footer.php');	
	?>
</html>