<?php
ob_start();
session_start();
?>
<?php
$server="localhost";
$user="inkmaste_sammy";
$password="mt/00288/014";
$database="inkmaste_school";
$con = mysqli_connect($sever, $user, $password,$database) or die("Connection Failed");
if ($_POST['submit']){
	$name=mysql_escape_string($_POST['name']);
	$id=mysql_escape_string($_POST['id']);

$query = "select * from admin where id = '".$id."' AND name='".$name."'";
$res = mysqli_query($con,$query);
if(mysqli_num_rows($res) > 0){
	//if($data = mysqli_fetch_array($res,MYSQLI_ASSOC)){
		//$_SESSION['user'] = $data['name'];
		//$_SESSION['id'] = $data['id'];
		
		header("location: admhome.php");
	}else{
		echo " you are note admin.<a href='elsignup.php'>signing up?</a>";
	}
}
	
//}

	
?>