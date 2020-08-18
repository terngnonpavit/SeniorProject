<?php
  // Start the session
  session_start();
  if(!isset($_SESSION["login_status"]) || $_SESSION["login_status"] == False ){
      header('Location: http://localhost/seniorproject/login.php');
  }

  $id=$_GET['id'];
  $type=$_GET['type'];

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
  $sql = "delete from $type where id=$id";
  // echo $sql;

  if ($conn->query($sql) === TRUE) {
    echo "Delete Record successfully";
    header('Location: http://localhost/seniorproject/admin/admin.php');
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
  $conn->close();
?>
