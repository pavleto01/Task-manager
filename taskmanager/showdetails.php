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
	<title></title>
	<style>
hr.style-five {
    border: 0;
    height: 0; 
    box-shadow: 0 0 10px 1px black;
}

	</style>
</head>
<body>
<?php
if(isset($_GET['id'])){
	$id = mysqli_real_escape_string($conn, $_GET['id']);

	$sql = "SELECT cases.case_title, cases.case_description, cases.case_priority, cases.case_status, agents.agent_name, case_agent.agent_id FROM agents INNER JOIN case_agent ON agents.id_agent = case_agent.agent_id JOIN cases ON case_agent.case_id = cases.id_case WHERE cases.id_case = $id";
	$result = mysqli_query($conn, $sql);
	$query=mysqli_query($conn,$sql)or die(mysqli_error($conn));
		while($row=mysqli_fetch_array($query)){
		$id_case=$row['id_case'];
?>
<table class="centertable">
	<tr>
<th><h3>Case Title: <?php echo $row['case_title'] ?></h3></th>
</tr>

<tr><th>
<h4>Case Priority: <?php echo $row['case_priority'] ?></h4></th></tr>

<tr><th>
<h4>Case Status: <?php echo $row['case_status'] ?></h4></th></tr>

<tr><th>
<h4>Case Description: <?php echo $row['case_description'] ?></h4></th></tr>

<tr><th>
<h4>Case Agents:
<?php 
	
	$sql1 = "SELECT case_agent.agent_id, agents.agent_name FROM agents INNER JOIN case_agent ON agents.id_agent = case_agent.agent_id JOIN cases ON case_agent.case_id = cases.id_case WHERE cases.id_case = $id";
	$result = mysqli_query($conn, $sql1);
	$query=mysqli_query($conn,$sql)or die(mysqli_error($conn));
		while($row=mysqli_fetch_array($query)){
		$id_case=$row['id_case'];
		
 ?>

<br>
 <?php echo $row['agent_name'];  ?>
 <br>
<?php } ?>
</h4></th></tr>

<?php } } ?>
</table>
<?php
if(isset($_GET['id'])){
	$id = mysqli_real_escape_string($conn, $_GET['id']);

	$sql = "SELECT cases.case_title, cases.case_description, cases.case_priority, cases.case_status, agents.agent_name, case_agent.agent_id FROM agents INNER JOIN case_agent ON agents.id_agent = case_agent.agent_id JOIN cases ON case_agent.case_id = cases.id_case WHERE cases.id_case = $id";
	$result = mysqli_query($conn, $sql);
	$query=mysqli_query($conn,$sql)or die(mysqli_error($conn));
		while($row=mysqli_fetch_array($query)){
		$id_case=$row['id_case'];
if($perm == 1 || $idagent == $row['agent_id'] ){
$id_case = $_GET['id'];

$sql1 = "SELECT * from cases where id_case='$id_case'";

$query1= mysqli_query($conn,$sql1); // select query

$data = mysqli_fetch_array($query); // fetch data

    if(isset($_POST['update'])) // when click on Update button
{
    $case_description = $_POST['case_description'];
   
    $case_title = $_POST['case_title'];

    $sql2 = "UPDATE cases set case_description = CONCAT_WS('<br>', case_description, '$case_description'), case_title = '$case_title' where id_case = '$id_case'";
	
    
    if(mysqli_query($conn, $sql2))
    {
        mysqli_close($conn); // Close connection
        header("Refresh:0"); 
        exit;
    }
    else
    {
        echo mysqli_error($conn);
    }    	
}

if(isset($_POST['add']))
{
    $agent  = $_POST['agent'];

    $sql3 = "INSERT INTO case_agent (case_id,agent_id) VALUES ('$id_case', '$agent')";
	
    
    if(mysqli_query($conn, $sql3))
    {
        mysqli_close($conn); // Close connection
        header("Refresh:0"); 
        exit;
    }
    else
    {
        echo mysqli_error($conn);
    }    	
}

if(isset($_POST['delete'])) // when click on Update button
{
    $agent_id  = $_POST['agent_id'];

    $sql4 = "DELETE FROM case_agent WHERE agent_id = '$agent_id' AND case_id = '$id_case'";
	
    
    if(mysqli_query($conn, $sql4))
    {
        mysqli_close($conn); // Close connection
        header("Refresh:0"); 
        exit;
    }
    else
    {
        echo mysqli_error($conn);
    }    	
}

if(isset($_POST['updatest'])) // when click on Update button
{
    $case_status = $_POST['case_status'];

    $sql5 = "UPDATE cases set  case_status = '$case_status' where id_case = '$id_case'";
	
    
    if(mysqli_query($conn, $sql5))
    {
        mysqli_close($conn); // Close connection
        header("Refresh:0"); 
        exit;
    }
    else
    {
        echo mysqli_error($conn);
    }    	
}
?>
<hr style="style-five">

<table class="centertable">
<form method="POST">

<tr>
  					<th style=" color:dodgerblue;"> Case title:
  					<br>
  					<input type = "text" name = "case_title" value = "<?php echo $row['case_title']?>">
  					</th>
  					</tr>	

	<tr><th>
<div class="from-group">
	
	<h5>Update status
  	<select  name="case_status" class="form-control">
  	   	<option value="">--Select status--</option>				
      	<option value ="OPENED">Opened</option>
      	<option value ="CLOSED">Closed</option>
   	</select>
   	<input type="submit" name="updatest" value="Update">
   	</h5>
</div>
</th></tr>



<tr><th>
<div class="from-group">	
	<h5>Add agent to case:
  	<select name="agent" class="form-control">
   							<option value="">--Select agent--</option>
      						<?php

      							$query = "SELECT * FROM agents where id_agent != 1";
      							$result = mysqli_query($conn, $query);
      							while($row = mysqli_fetch_array($result)){
      						?>
      					<option value = <?php echo $row['id_agent'];?>> <?php echo $row['agent_name'] ?> </option>
      				<?php } ?>
   							</select>
   							<input type="submit" name="add" value="Add">
</div>
</th></tr>

<tr><th>
<div class="from-group">	
	<h5>Delete agent from case:
  	<select name="agent_id" class="form-control">
   							<option value="">--Select agent--</option>
      						<?php

      							$query = "SELECT case_agent.agent_id, agents.agent_name FROM agents INNER JOIN case_agent ON agents.id_agent = case_agent.agent_id JOIN cases ON case_agent.case_id = cases.id_case WHERE cases.id_case = $id";
      							$result = mysqli_query($conn, $query);
      							while($row = mysqli_fetch_array($result)){
      						?>
      					<option value = <?php echo $row['agent_id'];?>> <?php echo $row['agent_name'] ?> </option>
      				<?php } ?>
   							</select>
   							<input type="submit" name="delete" value="Delete">
</div>
</th></tr>




<tr>
	<th>
  <textarea rows="4" cols="50" name="case_description" ><?php echo date("Y/m/d H:i:s");echo " - "; echo $name; echo ": ";   ?></textarea> </th><tr>

  	<tr><th>
  <input type="submit" name="update" value="Update"></th></tr>


</form>
<?php } ?>
<?php 
} } ?>
</table>

</body>
	<?php
		include ('view/footer.php');	
	?>
</html>