<?php
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

    $id=$_GET['id'];
    $status=$_GET['status'];
    $sql = "UPDATE teacher SET `status`='$status' WHERE `teacher`.`id` = $id;";

    if ($conn->query($sql) === TRUE) {
    // echo "New record created successfully";
    // header('Location: http://localhost/seniorproject/admin/scholarship_menu.php');
    echo "<script type='text/javascript'>window.location.href='http://localhost/seniorproject/admin/admin.php'</script>";
    } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
    }
?>
