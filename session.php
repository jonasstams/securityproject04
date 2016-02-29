<?php
session_start();
$servername = "10.3.1.195";
$username = "jonasuf171";
$password = "7ximqa0v";
$dbname = "jonasuf171_SecurityProject";
$con = mysqli_connect($servername,$username,$password,$dbname);


$session_user =$_SESSION['username'];
$session_user_id = $_SESSION['user_id'];

if(!isset($session_user)){
mysqli_close($con); // Closing Connection
header('Location: index.php'); // Redirecting To Home Page
}
?>