<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$username=$_POST['username'] ;
$password=$_POST['password'] ;
echo $username;
echo $password;

$sql = 'select * from user where username="'.$username.'" and password="'.$password.'"';
echo $sql;

$result = $conn->query($sql);
if($result->num_rows > 0){
  echo 'you are logged in';
  // Set session variables
  $_SESSION["username"] = $username;
  $_SESSION["login_status"] = True;
  header('Location: admin/admin.php');  
}
else{
  echo 'login unsuccessful';
}
?>
