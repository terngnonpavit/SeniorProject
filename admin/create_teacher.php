<?php
// Start the session
session_start();
if(!isset($_SESSION["login_status"]) || $_SESSION["login_status"] == False ){
    header('Location: http://localhost/seniorproject/login.php');
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <title>CPSU</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
      <!-- icon -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">


  </head>
  <body>
    <?php require('../navbar.php');?>

    <div class="container">
      <form action="create_teacher.php" method="post" enctype="multipart/form-data">
          <div class="form-group">
            <label for="teacher_code">รหัสอาจารย์</label>
            <input type="text" class="form-control" placeholder="กรุณากรอกรหัสอาจารย์" name="teacher_code">
          </div>
          <div class="form-group">
            <label for="title">คำนำหน้าชื่อ</label>
            <select class="form-control" name="title">
              <option value="อ.">อ.</option>
              <option value="อ.ดร.">อ.ดร.</option>
              <option value="ผศ.">ผศ.</option>
              <option value="ผศ.ดร.">ผศ.ดร.</option>
              <option value="รศ.">รศ.</option>
              <option value="รศ.ดร.">รศ.ดร.</option>
              <option value="ศ.">ศ.</option>
              <option value="ศ.ดร.">ศ.ดร.</option>
            </select>
          </div>
          <div class="form-group">
            <label for="name">ชื่อ-นามสกุล</label>
            <input type="text" class="form-control" placeholder="กรุณากรอกชื่อ-นามสกุล" name="name">
          </div>
          <div class="form-group">
            <label for="status">สถานะ</label>
            <select class="form-control" name="status">
                <option value="Active">Active</option>
                <option value="Inactive">Inactive</option>
            </select>
          </div>
          <div class="form-group">
            <label for="position">ตำแหน่ง</label>
            <select class="form-control" name="position">
                <option value="อาจารย์">อาจารย์</option>
                <option value="หัวหน้าภาควิชา">หัวหน้าภาควิชา</option>
            </select>
          </div>
          <button type="submit" class="btn btn-success">Done</button>
      </form>
    </div>

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

      if(isset($_POST['name']) && $_POST['name'] != '' &&
         isset($_POST['teacher_code']) && $_POST['teacher_code'] != '')
         {

          $title=$_POST['title'];
          $name=$_POST['name'];
          $teacher_code=$_POST['teacher_code'];
          $status=$_POST['status'];
          $position=$_POST['position'];

          $sql = "INSERT INTO `teacher` (`name`, `teacher_code`, `status`, `position`, `title`) VALUES ('$name', '$teacher_code', '$status', '$position', '$title')";

          if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
            echo "<script type='text/javascript'>window.location.href='http://localhost/seniorproject/admin/admin.php'</script>";
          } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
          }
        }
        $conn->close();
      ?>
  </body>
</html>
