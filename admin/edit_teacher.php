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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
      <!-- icon -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

  </head>
  <body>
    <?php require('../navbar.php');?>

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
      $sql = "SELECT * FROM `teacher` WHERE `id`=$id";
      $result = $conn->query($sql);
      $row = $result->fetch_assoc();
      $name=$row['name'];
      $teacher_code=$row['teacher_code'];
      $status=$row['status'];
      $position=$row['position'];
      $title=$row['title'];


      $conn->close();
    ?>

        <div class="container">
          <form action='<?php echo "http://localhost/seniorproject/admin/edit_teacher.php/?id=$id"?>' method="post" enctype="multipart/form-data">
            <div class="form-group">
              <label for="teacher_code">รหัสอาจารย์</label>
              <input type="text" class="form-control" placeholder="กรุณากรอกรหัสอาจารย์" name="teacher_code" value="<?php echo $teacher_code; ?>">
            </div>
            <div class="form-group">
              <label for="title">คำนำหน้าชื่อ</label>
              <select class="form-control" name="title">
                  <option value="อ." <?php if($title=="อ.") echo 'selected';?>>อ.</option>
                  <option value="อ.ดร." <?php if($title=="อ.ดร.") echo 'selected';?>>อ.ดร.</option>
                  <option value="ผศ." <?php if($title=="ผศ.") echo 'selected';?>>ผศ.</option>
                  <option value="ผศ.ดร." <?php if($title=="ผศ.ดร.") echo 'selected';?>>ผศ.ดร.</option>
                  <option value="รศ." <?php if($title=="รศ.") echo 'selected';?>>รศ.</option>
                  <option value="รศ.ดร." <?php if($title=="รศ.ดร.") echo 'selected';?>>รศ.ดร.</option>
                  <option value="ศ." <?php if($title=="ศ.") echo 'selected';?>>ศ.</option>
                  <option value="ศ.ดร." <?php if($title=="ศ.ดร.") echo 'selected';?>>ศ.ดร.</option>
              </select>
            </div>
            <div class="form-group">
              <label for="name">ชื่อ-นามสกุล</label>
              <input type="text" class="form-control" placeholder="กรุณากรอกชื่อ-นามสกุล" name="name" value="<?php echo $name; ?>">
            </div>
            <div class="form-group">
              <label for="status">สถานะ</label>
              <select class="form-control" name="status">
                  <option value="Active" <?php if($status=="Active") echo 'selected'?>>Active</option>
                  <option value="Inactive"  <?php if($status=="Inactive") echo 'selected'?>>Inactive</option>
              </select>
            </div>
            <div class="form-group">
              <label for="position">ตำแหน่ง</label>
              <select class="form-control" name="position">
                  <option value="หัวหน้าภาควิชา"  <?php if($position=="หัวหน้าภาควิชา") echo 'selected'?>>หัวหน้าภาควิชา</option>
                  <option value="อาจารย์"  <?php if($position=="อาจารย์") echo 'selected'?>>อาจารย์</option>
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

          $id=$_GET['id'];

          $name=$_POST['name'];
          $teacher_code=$_POST['teacher_code'];
          $status=$_POST['status'];
          $position=$_POST['position'];
          $title=$_POST['title'];

          $sql = "UPDATE `teacher` SET `name`='$name', `teacher_code`='$teacher_code', `status`='$status', `position`='$position', `title`='$title'  WHERE `teacher`.`id` = $id;";

          if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
            // header('Location: http://localhost/seniorproject/admin/scholarship_menu.php');
            echo "<script type='text/javascript'>window.location.href='http://localhost/seniorproject/admin/admin.php'</script>";
          } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
          }
        }
        $conn->close();
      ?>

  </body>
</html>
