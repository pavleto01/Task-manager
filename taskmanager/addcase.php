<?php
include('config/db_connect.php');
include ('view/header.php');
if(!isset($_SESSION['agent_username']))
{
  header("Location: login.php");
  exit;
}

$case_author = $case_title = $case_description = $case_priority = $case_status =  $case_id = $agent_id = '';

$errors = array('case_author'=>'','case_title'=>'','agentID'=>'','case_description'=>'','case_priority'=>'','case_status'=>'');

if(isset($_POST['submit'])){

	if(empty($_POST['case_title'])){
			$errors['case_title'] = "A case title is required <br/>";
		} else {
			$case_title = $_POST['case_title'];
		}

	if(empty($_POST['case_description'])){
			$errors['case_description'] = "A case description is required <br/>";
		} else {
			$case_description = $_POST['case_description'];
		}

		if(empty($_POST['case_priority'])){
			$errors['case_priority'] = "A case priority is required <br/>";
		} else {
			$case_priority = $_POST['case_priority'];
		}

		if(empty($_POST['case_status'])){
			$errors['case_status'] = "A case status is required <br/>";
		} else {
			$case_status = $_POST['case_status'];
		}

	
	if($_SERVER['QUERY_STRING'] == 'noname'){
		session_unset();
	}

	$id_agent = $_SESSION['id_agent'];
	$agent_name = $_SESSION['agent_name'];

	if(array_filter($errors)){
			//echo 'errors in the form';
		} if($perm == 1){

			$case_author = mysqli_real_escape_string($conn, $_POST['agent_name']);
			$case_title  = mysqli_real_escape_string($conn, $_POST['case_title']);
			$case_description  = mysqli_real_escape_string($conn, $_POST['case_description']);
			$case_priority  = mysqli_real_escape_string($conn, $_POST['case_priority']);
			$case_status  = mysqli_real_escape_string($conn, $_POST['case_status']);
			$agent_id  = mysqli_real_escape_string($conn, $_POST['id_agent']);

			$sql1 = "INSERT INTO cases(case_author, case_title, case_description, case_priority,case_status) VALUES ('$agent_name','$case_title', '$case_description','$case_priority','$case_status');";

			$sql2 = "SET @caseid = last_insert_id();";

			$sql3 = "INSERT INTO case_agent(case_id, agent_id) VALUES (@caseid, '$id_agent')";
					



			if(mysqli_query($conn, $sql1)){
				$id = mysqli_insert_id($conn);
				if(mysqli_query($conn, $sql2) & mysqli_query($conn, $sql3)){
			header('Location: showdetails.php?id='.$id);}
			} else {
				echo 'query error: '. mysqli_error($conn);
			}
		
		
 }


		if($perm != 1){

			$id_case = mysqli_real_escape_string($conn, $_POST['id_case']);
			$case_author = mysqli_real_escape_string($conn, $_POST['agent_name']);
			$case_title  = mysqli_real_escape_string($conn, $_POST['case_title']);
			$case_description  = mysqli_real_escape_string($conn, $_POST['case_description']);
			$case_priority  = mysqli_real_escape_string($conn, $_POST['case_priority']);
			$case_status  = mysqli_real_escape_string($conn, $_POST['case_status']);
			$agent_id  = mysqli_real_escape_string($conn, $_POST['id_agent']);

			$sql1 = "INSERT INTO cases(case_author, case_title, case_description, case_priority,case_status) VALUES ('$agent_name','$case_title', '$case_description','$case_priority','$case_status');";

			$sql2 = "SET @caseid = last_insert_id();";

			$sql3 = "INSERT INTO case_agent(case_id, agent_id) VALUES (@caseid, '$id_agent')";

			$sql4 = "INSERT INTO case_agent(case_id, agent_id) VALUES (@caseid, 1)";

			if(mysqli_query($conn, $sql1)){
				$id = mysqli_insert_id($conn);
				if(mysqli_query($conn, $sql2) & mysqli_query($conn, $sql3) & mysqli_query($conn, $sql4)){
			header('Location: showdetails.php?id='.$id);}
			} else {
				echo 'query error: '. mysqli_error($conn);
			}
		}
		}

?>


<!DOCTYPE html>
<html>

	<head>
		

		<section class = "container" grey-text>
			

				
					<table class="centertable">
						<div class="alert alert-success">
							<h2 style="text-align:center; ">Add case</h2>
						</div>
						<thead>
							<form class="white" action="<?php echo $_SERVER[ 'PHP_SELF'] ?>" method="POST">
					<tr>
  					<th style=" color:dodgerblue;"> Case title:
  					<br>
  					<input type = "text" name = "case_title" value = "<?php echo htmlspecialchars($case_title) ?>">
  					<div class = "red-text"> <?php echo $errors['case_title']; ?> </div>
  					</th>
  					</tr>
  					<tr>
  					<th style=" color:dodgerblue;"> Case description: 
  						<br>
  					<textarea name = "case_description" rows="5" cols="50" value = "<?php echo htmlspecialchars($case_description) ?>"></textarea>
  					<div class = "red-text"> <?php echo $errors['case_description']; ?> </div>
  					</th>
  					</tr>

						<tr>
  					<th style=" color:dodgerblue;"> Case Priority:
  					<br>
  					<div class="from-group">
  					<select name="case_priority" class="form-control">
      					<option value ="MEDIUM">MEDIUM</option>
      					<option value ="HIGH">HIGH</option>
      					<option value ="LOW">LOW</option>
      				
   							</select>
   						</div>
  					</th>
  					</tr>

  					


  					<tr>
  						<th>
						<div class="from-group">
  					<select hidden name="case_status" class="form-control">
      						
      					<option value ="OPENED">opened</option>
   							</select>
   						</div>
   					</th>
   				</tr>

  					<tr>
  						<th>
   					<div class="center">
  						<input type="submit" name="submit" value = "ADD" class = "btn brand z-deth-0">
					</div>
				</th>
				</tr>
					</form>
				</thead>
			</table>
				
		</section>

	<?php
		include ('view/footer.php');
	?>
</head>
</html>

