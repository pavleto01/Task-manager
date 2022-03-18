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
	<title></title>
	<style>
* {
  box-sizing: border-box;
}
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
.row {
  margin-left:-5px;
  margin-right:-5px;
}
  
.column {
  float: left;
  width: 50%;
  padding: 10px;
}

.row::after {
  
  clear: both;
  display: table;
}

.table{
margin-left: auto;
margin-right: auto;
width: 70%;
border-collapse: collapse;
}



.table3{
margin-left: auto;
margin-right: auto;
width: 70%;
border-collapse: collapse;
}


 th, td {
border-style:solid;
border-color: #96D4D4;
}

</style>
</head>
<body>
<br>

<table class="table">
        <thead>
            <tr style="height:50px">
                <th style="text-align:center;background-color: #D6EEEE">ДАТА</th>
                <th style="text-align:center;background-color: #D6EEEE">АВТОР НА ЗАДАНИЕ</th>
                <th style="text-align:center;background-color: #D6EEEE">ЗАГЛАВИЕ НА ЗАДАНИЕ</th>
                <th style="text-align:center;background-color: #D6EEEE">ПРИОРИТЕТ</th>
                <th style="text-align:center;background-color: #D6EEEE">СТАТУС</th>
                

            </tr>
        </thead>
        <tbody>

    <?php
        if(isset($_GET['id'])){
        $id = mysqli_real_escape_string($conn, $_GET['id']);
        $sql = "SELECT cases.case_author, cases.id_case, cases.date_in, cases.case_title, cases.case_priority, cases.case_status FROM cases WHERE cases.id_case = $id";
        $query=mysqli_query($conn,$sql)or die(mysqli_error());
        while($row=mysqli_fetch_array($query)){
        ?>
            <tr>
                <td style="text-align:center; "><?php echo $row['date_in'] ?></td>
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
                    <?php } ?></td>       
        <?php  }  }?>
    
        
        </tr>  
                    
        </tbody>
    </table>

<?php
if(isset($_GET['id'])){
	$id = mysqli_real_escape_string($conn, $_GET['id']);
	$sql = "SELECT cases.case_title, cases.case_description, cases.case_priority, cases.case_status, agents.agent_name, case_agent.agent_id FROM agents JOIN case_agent ON agents.id_agent = case_agent.agent_id JOIN cases ON case_agent.case_id = cases.id_case WHERE cases.id_case = $id";
    $result = mysqli_query($conn, $sql);
	$query=mysqli_query($conn,$sql)or die(mysqli_error($conn));
		while($row=mysqli_fetch_array($result)){
		
if($perm == 1 || $idagent == $row['agent_id'] ){
$id_case = $_GET['id'];

$sql1 = "SELECT * from cases where id_case='$id_case'";

$query1= mysqli_query($conn,$sql1);

$data = mysqli_fetch_array($query); 

    if(isset($_POST['update'])) 
{
    $case_description = $_POST['case_description'];
   
    $case_title = $_POST['case_title'];

    $sql2 = "UPDATE cases set case_description = CONCAT_WS('<br>', case_description, '$case_description'), case_title = '$case_title' where id_case = '$id_case'";
	
    
    if(mysqli_query($conn, $sql2))
    {
        mysqli_close($conn); 
        
        echo("<meta http-equiv='refresh' content='0'>");
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
        mysqli_close($conn); 
        echo("<meta http-equiv='refresh' content='0'>");
        exit;
    }
    else
    {
        echo mysqli_error($conn);
    }    	
}

if(isset($_POST['delete'])) 
{
    $agent_id  = $_POST['agent_id'];

    $sql4 = "DELETE FROM case_agent WHERE agent_id = '$agent_id' AND case_id = '$id_case'";
	
    
    if(mysqli_query($conn, $sql4))
    {
        mysqli_close($conn);
        echo("<meta http-equiv='refresh' content='0'>"); 
        exit;
    }
    else
    {
        echo mysqli_error($conn);
    }    	
}

if(isset($_POST['updatest'])) 
{
    $case_status = $_POST['case_status'];

    $sql5 = "UPDATE cases set  case_status = '$case_status' where id_case = '$id_case'";
	
    
    if(mysqli_query($conn, $sql5))
    {
        mysqli_close($conn); 
        echo("<meta http-equiv='refresh' content='0'>"); 
        exit;
    }
    else
    {
        echo mysqli_error($conn);
    }    	
}

?>

<table class="table3">
<form method="POST">

<tr>
  	<th> 
    <h4>Заглавие на задание:
  	<br>
  	<input type = "text" name = "case_title" value = "<?php echo $row['case_title']?>">
     </h4>
  	</th>
<th colspan="2">
<div class="from-group">	
	<h4>Обнови статус: <br>
  	<select  name="case_status" class="form-control">
  	   	<option value="">--Избери статус--</option>				
      	<option value ="OPENED">Отворен</option>
      	<option value ="CLOSED">Затворен</option>
   	</select>
   	<input type="submit" name="updatest" value="ОБНОВИ">
   	</h4>
</div>
</th></tr> 



<tr><th>
<div class="from-group">	
	<h4>Добави работник към заданието: <br>
  	<select name="agent" class="form-control">
   							<option value="">--Избари работник--</option>
      						<?php

      							$query = "SELECT * FROM agents where id_agent != 1";
      							$result = mysqli_query($conn, $query);
      							while($row = mysqli_fetch_array($result)){
      						?>
      					<option value = <?php echo $row['id_agent'];?>> <?php echo $row['agent_name'] ?> </option>
      				<?php } ?>

   							</select>
                        </h4>
   							<input type="submit" name="add" value="ДОБАВИ">
</div>
</th>

<th>
<div class="from-group">	
	<h4>Премахни работник от заданието: <br>
  	<select name="agent_id" class="form-control">
   							<option value="">--Избери работник--</option>
      						<?php

      							$query = "SELECT case_agent.agent_id, agents.agent_name FROM agents INNER JOIN case_agent ON agents.id_agent = case_agent.agent_id JOIN cases ON case_agent.case_id = cases.id_case WHERE cases.id_case = $id";
      							$result = mysqli_query($conn, $query);
      							while($row = mysqli_fetch_array($result)){
      						?>
      					<option value = <?php echo $row['agent_id'];?>> <?php echo $row['agent_name'] ?> </option>
      				<?php } ?>
   							</select>
                        </h4>
   							<input type="submit" name="delete" value="ПРЕМАХНИ">
</div>
</th>

<th>
    <h4>Работници по заданието:</h4>
            <?php 
            if(isset($_GET['id'])){
            $id = mysqli_real_escape_string($conn, $_GET['id']);

            $sql = "SELECT cases.case_title, cases.case_description, cases.case_priority, cases.case_status, agents.agent_name, case_agent.agent_id FROM agents INNER JOIN case_agent ON agents.id_agent = case_agent.agent_id JOIN cases ON case_agent.case_id = cases.id_case WHERE cases.id_case = $id AND case_agent.agent_id !=1";
            $result = mysqli_query($conn, $sql);
             $query=mysqli_query($conn,$sql)or die(mysqli_error($conn));
                while($row=mysqli_fetch_array($result)){ ?>
                <br><?php 
            echo $row['agent_name'];} } ?><br><br>
        
</th>

</tr>

<tr>
	<th>
        <h3>Описание: <br>
  <textarea rows="7" cols="35" name="case_description" ><?php echo date("Y/m/d H:i:s");echo " - "; echo $name; echo ": ";?></textarea>
<br><input class="button" type="submit" name="update" value="ОБНОВИ"><br></th>

<th colspan="2">
    
    <?php
            $query = "SELECT cases.case_description FROM cases WHERE cases.id_case = $id";
            $result = mysqli_query($conn, $query);
            while($row = mysqli_fetch_array($result)){
            echo $row['case_description'];}
    ?>

</th>
<tr>
</form>
</table>
<br>
<div class="center">
    <form action="index.php">
        <input class="button" type="submit" name="return" value="НАЗАД">
    </form>
</div>
<br><br><br>
<?php } } } ?>
</body>
	
</html>