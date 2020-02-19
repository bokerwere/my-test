<?php
ob_start();
session_start();

$server="localhost";
$user="root";
$password="";
$database="school";

$con = mysqli_connect('localhost','root','','school')  or die("Connection Failed"); 
if ($_POST['submit']){
	$name=mysql_escape_string($_POST['name']);
	$id=mysql_escape_string($_POST['id']);

$query = "select * from student where id = '".$id."' AND name='".$name."'";
$res = mysqli_query($con,$query);
if(mysqli_num_rows($res) > 0){
	//if($data = mysqli_fetch_array($res,MYSQLI_ASSOC)){
		//$_SESSION['user'] = $data['name'];
		//$_SESSION['id'] = $data['id'];
		
		header("location: ewelcome");
	}else{
		echo "The name that you've entered doesn't match any account.<a href='elsignup.php'>Register?</a>";
	} 
}
	
//}

	
?>
<!Doctype html>
<html>
<head>
<title>elearningsignup</title>
<link rel="stylesheet" type="text/css" href="css/w3.css">
<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
<style>
	.form{
		height:inherit;
		width:400px;
		padding:20px;
		color:#fff;
		background-color:slategrey;
		margin: 45px auto;
		border: hidden;
		border-radius:5px;
	}
	.form input[type="text"], .input{
		width:185px;
		border: hidden;
		
		border-radius: 5px;
		background-color:#aaa;
		padding:5px;
		margin:5px;
		display:block;
	}
	.form input[type="submit"]{
		height:35px;
		width:60px;
		float:right;
		background-color:#0000ff;
		color:#ffffff;
		border:hidden;
		border-radius:5px;
		
	}
	#log input{
		padding:1px;
		width: 100px;
	}
	body{
		background: url('images/livingroom.jpg');
	}
</style>
</head>

<body>

<?php
$server="localhost";// the name of the server.
$user="root";//the specified name of the user from the form.
$password="";// since the user may need to specify his or her own password.
$database="school";// the database in use.

$con=mysqli_connect($server,$user,$password,$database) or die (mysqli_error($con));


if ($_POST['submit']){
	$name=mysqli_escape_string($con,$_POST['name']);
	$gender=mysqli_escape_string($con,$_POST['gender']);
	$id=mysqli_escape_string($con,$_POST['id']);
	$school=mysqli_escape_string($con,$_POST['school']);
	$county=mysqli_escape_string($con,$_POST['county']);
	$class=mysqli_escape_string($con,$_POST['class']);
	$stream=mysqli_escape_string($con,$_POST['stream']);
	$contact=mysqli_escape_string($con,$_POST['contact']);
	
	$qry1="INSERT INTO `student`(`name`,`gender`,`id`,`school`, `county`,`class`,`stream`,`contact`)
	VALUES('".$name."','".$gender."','".$id."','".$school."','".$county."','".$class."','".$stream."','".$contact."')";
	
	mysqli_query ($con,$qry1);
	if(mysqli_affected_rows($con) > 0 ){
		$lastid = mysqli_insert_id($con);
		$sql = "SELECT * FROM student where st_id='".$lastid."'";
		$res = mysqli_query($con,$sql);
		if(mysqli_num_rows($res) > 0){
			if($data = mysqli_fetch_array($res,MYSQLI_ASSOC)){
				$_SESSION['user'] = $data['name'];
				$_SESSION['id'] = $data['id'];
				header("location: ewelcome.php");
			}
		}else{
			printf("Error %s",mysqli_error($con));
		}
	}else{
		echo 'Error registering.try again';
		
	}
	
}




?>
<div class='container-fluid' style="position:relative;left:320px;z-index:20;">

	<div class="row" style="position:relative;left:300px;">
		<div class="col-md-12" style="background:#aaa;">
			<div class="col-md-4">
				<form action="elogin.php" method="post" id="log">
					<div  class="row">
  					<div class="form-group col-md-4">
						
    					<input type="text" class="form-control" id="email" name="name" placeholder="student name">
  					</div>
					<div class="form-group col-md-4">
					    
					    <input type="password" class="form-control" id="pwd" name="id" placeholder="student pass">
					</div>
					<div class="form-group col-md-4">
					    
					    <input type="submit" class="form-control" id="login" name="submit" Value="studentLogin" >
					</div>
				</div>
				</form>
			</div>
		</div>
	</div>
</div>
<div class="form1" style="position:relative; top:-49px">
	<div class='container-fluid'>
	<div class="row">
		<div class="col-md-12" style="background:#aaa;">
			<div class="col-md-4">
				<form action="adminLogin.php" method="post" id="log">
					<div  class="row">
  					<div class="form-group col-md-4">
						
    					<input type="text" class="form-control" id="email" name="name" placeholder="admin name">
  					</div>
					<div class="form-group col-md-4">
					    
					    <input type="password" class="form-control" id="pwd" name="id" placeholder="admin pass">
					</div>
					<div class="form-group col-md-4">
					    
					    <input type="submit" class="form-control" id="login" name="submit" value="Adm Login">
					</div>
				</div>
				</form>
			</div>
		</div>
	</div>
</div>
</div>

<div class="form">
<form name="login" method= "POST" action="<?php echo $_SERVER['PHP_SELF'];?>"><br><br>

	<p><font size="15">Creat New account by signing up.</font></P>

NAME:<input type="text" name="name" required="require" placeholder="first name and surname" title= "Please input your username"/>
<input type="radio" name="gender" value="F" required="require" >Female
<input type="radio" name="gender" value="M" required="require">Male<br>
<input type="text" name="id" require="require" placeholder=" enter reg no" title="please provide the correct password"/><br>
<input type="text" name="school" required="require"  placeholder="school name" title="Please input your username"/>
COUNTY:

<?php
echo '<select class="input" name="county" style="color:#000;">';
$arr = array('KISUMU','NAIROBI','MOMBASA','KILIFI','TURKANA','TRANS NZOIA','KISII','HOMABAY','WAJIR','MANDERA','NYERI','BARINGO','NAKURU','SIAYA','KAKAMEGA','VIHIGA','BUNGOMA','KITALE','MARSABIT','FALA');
foreach($arr as $key=>$county){
echo '<option value="'.$county.'">';
echo $county;
echo '</option>';
}
echo '</select>';
?>
<br>
CLASS:<input type="text" name="class" required="require"  placeholder=" enter class you belong" title= "Please input your username"/>
STREAM:<input type="text" name="stream" required="require" placeholder=" enter stream you belong" title= "Please input your username"/><br><br>
CONTACT:<input type="text" name="contact" required="require"placeholder=" enter phone number" title= "Please input your username"/><br><br>
<input type="submit" name= "submit" value="SIGN UP" title="Click to login"/><br>


</form>
</div>

</div>

</body>
</html>

