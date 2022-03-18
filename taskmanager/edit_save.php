<?php
include ('config/db_connect.php');

$id_agent = $_POST['id_agent'];
$agent_email = $_POST['agent_email'];
$agent_name = $_POST['agent_name'];
$agent_username = $_POST['agent_username'];
$agent_password = $_POST['agent_password'];
$perm = $_POST['perm'];
$N = count($id_agent);
for($i=0; $i < $N; $i++)
{
	$sql = "UPDATE agents SET agent_email='$agent_email[$i]', agent_name='$agent_name[$i]', agent_username='$agent_username[$i]', agent_password='$agent_password[$i]', perm='$perm[$i]' where id_agent='$id_agent[$i]'" or die(mysqli_error());
	$result = mysqli_query($conn, $sql);

}
?>
  		<script type="text/javascript">
    		window.location.href = "admin.php";
			</script>

