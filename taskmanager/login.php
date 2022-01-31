<?php

	include ('config/db_connect.php');
include ('view/header.php');


	$agent_username = $agent_password  = '';
	$errors = array('agent_username'=>'', 'agent_password'=>'');

	if(isset($_POST['submit'])){



		//check username
		if(empty($_POST['agent_username'])){
			$errors['agent_username'] = "A username is required <br/>";
		} else {
			$agent_username = $_POST['agent_username'];
		}

		//check password
		if(empty($_POST['agent_password'])){
			$errors['agent_password'] = "A password is required <br/>";
		} else {
			$agent_password = $_POST['agent_password'];
		}

		if(array_filter($errors)){
			//echo 'errors in the form';
		} else{

			//$agent_username = mysqli_real_escape_string($conn, $_POST['agent_username']);
			//$agent_password = mysqli_real_escape_string($conn, $_POST['agent_password']);

			$query = "SELECT * FROM agents WHERE agent_username = '$agent_username' && agent_password = '$agent_password' ";
			echo $query;
			$result = mysqli_query($conn, $query);

			if($row = mysqli_fetch_array($result)){
				//success
				session_start();
				$_SESSION['agent_username'] = $_POST['agent_username'];
				$_SESSION['agent_email'] = $row['agent_email'];
				$_SESSION['agent_name'] = $row['agent_name'];
				$_SESSION['id_agent'] = $row['id_agent'];
				$_SESSION['perm'] = $row['perm'];
				header('Location: index.php');
			} else {
				header('Location: login.php');
		}
	}
		}

?>


<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login page</title>

</head>
<body>
	<section class = "container" grey-text>
	<table class = "centertable">
		<div class="alert alert-success">
							<h2 style="text-align:center; ">LOG IN</h2>
		<thead>
			<div class="container">
    				<div class="col-md-6">
        				<form class="white" action="<?php echo $_SERVER[ 'PHP_SELF'] ?>" method="POST">
        					<tr>
  					<th style=" color:dodgerblue;"> Username:
  					<br>
  					<input type = "text" name = "agent_username" value = "<?php echo htmlspecialchars($agent_username) ?>">
  					<div class = "red-text"> <?php echo $errors['agent_username']; ?> </div>
  				</th>
  			</tr>

  					<tr>
  					<th style=" color:dodgerblue;"> Password:
  					<br>
  					
  					<input type = "password" name = "agent_password" value = "<?php echo htmlspecialchars($agent_password) ?>">
  					<div class = "red-text"> <?php echo $errors['agent_password']; ?> </div>
  					</th>
  				</tr>

  				<tr><th>
  					<div class="center">
  						<input type="submit" name="submit" value = "LOG IN" class = "btn brand z-deth-0">
					</div>
				</th></tr>
				</form>
    				</div>
    			</div>
    		</thead>
    	</table>
	</section>
</body>
<?php
		include ('view/footer.php');	
	?>
</html>