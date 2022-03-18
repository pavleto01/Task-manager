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


$agent_name = $agent_email = $agent_username = $agent_password = $perm = '';

$errors = array('agent_name'=>'','agent_email'=>'','agent_username'=>'','agent_password'=>'','perm'=>'');

if(isset($_POST['submit'])){

	if(empty($_POST['agent_name'])){
			$errors['agent_name'] = "A name title is required <br/>";
		} else {
			$agent_name = $_POST['agent_name'];
		}

	if(empty($_POST['agent_email'])){
			$errors['agent_email'] = "An email title is required <br/>";
		} else {
			$agent_email = $_POST['agent_email'];
		}

	if(empty($_POST['agent_username'])){
			$errors['agent_username'] = "A username title is required <br/>";
		} else {
			$agent_username = $_POST['agent_username'];
		}

	if(empty($_POST['agent_password'])){
			$errors['agent_password'] = "A password title is required <br/>";
		} else {
			$agent_password = $_POST['agent_password'];
		}

	if(empty($_POST['perm'])){
			$errors['perm'] = "A perm title is required <br/>";
		} else {
			$perm = $_POST['perm'];
		}

	
	if($_SERVER['QUERY_STRING'] == 'noname'){
		session_unset();
	}

	
	if(array_filter($errors)){
			
		} else{

			$agent_name  = mysqli_real_escape_string($conn, $_POST['agent_name']);
			$agent_username  = mysqli_real_escape_string($conn, $_POST['agent_username']);
			$agent_email  = mysqli_real_escape_string($conn, $_POST['agent_email']);
			$agent_password  = mysqli_real_escape_string($conn, $_POST['agent_password']);
			$perm  = mysqli_real_escape_string($conn, $_POST['perm']);

			$sql = "INSERT INTO agents(agent_name, agent_email, agent_username,agent_password, perm) VALUES ('$agent_name', '$agent_email','$agent_username','$agent_password','$perm')";

			

			if(mysqli_query($conn, $sql)){
				//success
				  ?>
  	<script type="text/javascript">
   	 window.location.href = "index.php";
		</script>
<?php
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
			
					<table class="centertable2">
						<div class="alert alert-success">
							<h2 style="text-align:center; ">Добави работник</h2>
						</div>
						<thead>
							<form class="white" action="<?php echo $_SERVER[ 'PHP_SELF'] ?>" method="POST">
					<tr>
  					<th> Име и фамилия:
  					<br>
  					<input type = "text" name = "agent_name" value = "<?php echo htmlspecialchars($agent_name) ?>">
  					<div class = "red-text"> <?php echo $errors['agent_name']; ?> </div>
  					</th>
  					</tr>
  					<tr>
  					<th> Потребителско име: 
  						<br>
  					<input type = "text" name = "agent_username" rows="5" cols="50" value = "<?php echo htmlspecialchars($agent_username) ?>">
  					<div class = "red-text"> <?php echo $errors['agent_username']; ?> </div>
  					</th>
  					</tr>

  					<tr>
  					<th> Парола:
  					<br>
  					<input type = "password" name = "agent_password" value = "<?php echo htmlspecialchars($agent_password) ?>">
  					<div class = "red-text"> <?php echo $errors['agent_password']; ?> </div>
  					</th>
  					</tr>

  					<tr>
  					<th> Имейл:
  					<br>
  					<input type = "text" name = "agent_email" value = "<?php echo htmlspecialchars($agent_email) ?>">
  					<div class = "red-text"> <?php echo $errors['agent_email']; ?> </div>
  					</th>
  					</tr>

					
  					<tr>
  						<th> Достъп:
  							<br>
  							<div class="form-group">
					<br>
					<?php
    					$query = "SELECT * FROM permission";
    					$result = mysqli_query($conn, $query);
    					while($row = mysqli_fetch_array($result)){
  				  	?>
				
  				<input type="checkbox" name="perm" value="<?php echo $row['id_perm'];?>" > <?php echo $row['permission'] ?><br />
					<?php } ?>
  						</th>
  					</tr>

  					<tr>
  						<th>
   					<div class="center">
  						<input type="submit" name="submit" value = "ДОБАВИ" class = "btn brand z-deth-0">
					</div>
				</th>
				</tr>
					</form>
				</thead>
			</table>
				
		</section>

</head>
</html>

