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
      $active="Active";
      $sql = "SELECT * FROM `teacher` WHERE `status`='$active'";
      $result = $conn->query($sql);
      if ($result->num_rows > 0) {
        $teacher_name=[];
        while($row = $result->fetch_assoc())  {
          array_push($teacher_name,$row['name']);
        }
      }

      $conn->close();
    ?>

    <div class="container">
      <br>
      <div>
        <form action="create_journals.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
              <label for="titleTH"><strong>ชื่อผลงาน(ไทย)</strong></label>
              <input type="text" class="form-control" placeholder="ระบุชื่อผลงาน(ไทย)" name="titleTH">
            </div>
            <div class="form-group">
              <label for="titleEN"><strong>ชื่อผลงาน(อังกฤษ)</strong></label>
              <input type="text" class="form-control" placeholder="ระบุชื่อผลงาน(อังกฤษ)" name="titleEN">
            </div>
          <div class='row'>
            <div class="form-group col-md-6">
              <label for="author"><strong>ผู้เขียน</strong></label>
              <select class="form-control" name="author">
                  <?php
                    foreach ($teacher_name as $name) {
                      echo "<option value='$name'>$name</option>";
                    }
                  ?>
              </select>
            </div>
            <div class="form-group col-md-6">
              <label for="journal_name"><strong>ชื่อวารสาร</strong></label>
              <input type="text" class="form-control" placeholder="ระบุชื่อวารสาร" name="journal_name">
            </div>
          </div>
          <div class='row'>
            <div class="form-group col-md-4">
              <label for="volume"><strong>ปีที่</strong></label>
              <input type="text" class="form-control" placeholder="ระบุปีที่" name="volume">
            </div>
            <div class="form-group col-md-4">
              <label for="number"><strong>ฉบับที่</strong></label>
              <input type="text" class="form-control" placeholder="ระบุฉบับที่" name="number">
            </div>
            <div class="form-group col-md-4">
              <label for="page"><strong>เลขหน้า</strong></label>
              <input type="text" class="form-control" placeholder="ระบุเลขหน้า" name="page">
            </div>
          </div>
          <div class="row">
            <div class="form-group col-md-6">
              <label for="date"><strong>วัน/เดือน/ปี ที่ตีพิมพ์</strong></label>
              <input type="text" class="form-control" placeholder="ระบุวัน/เดือน/ปี ที่ตีพิมพ์" name="date">
            </div>
            <div class="form-group col-md-6">
              <label for="journal_file"><strong>อัพโหลดไฟล์</strong></label>
              <input type="file" class="form-control" placeholder="Upload file" name="journal_file">
            </div>
            <button type="submit" class="btn btn-success btn-block">ยืนยัน</button>
        </form>
      </div>
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

      if(isset($_POST['titleTH']) && $_POST['titleTH'] != '' &&
         isset($_POST['titleEN']) && $_POST['titleEN'] != '' &&
         isset($_POST['author']) && $_POST['author'] != '' &&
         isset($_POST['journal_name']) && $_POST['journal_name'] != '' &&
         isset($_POST['volume']) && $_POST['volume'] != '' &&
         isset($_POST['number']) && $_POST['number'] != '' &&
         isset($_POST['page']) && $_POST['page'] != '' &&
         isset($_POST['date']) && $_POST['date'] != '')
        {
          $targetfolder = "C:\\xampp\\htdocs\\SeniorProject\\uploads\\";
          $targetfolder = $targetfolder . basename( $_FILES['journal_file']['name']) ;

          if(move_uploaded_file($_FILES['journal_file']['tmp_name'], $targetfolder))
          {
            echo "The file " . basename($_FILES['journal_file']['name']) . " is uploaded";
          }
          else
          {
            echo "Problem uploading file" . basename($_FILES['journal_file']['name']);
          }

          $titleTH=$_POST['titleTH'];
          $titleEN=$_POST['titleEN'];
          $author=$_POST['author'];
          $journal_name=$_POST['journal_name'];
          $volume=$_POST['volume'];
          $number=$_POST['number'];
          $page=$_POST['page'];
          $date=$_POST['date'];
          $type="journals";
          $file_path="http://localhost/seniorproject/uploads/". basename($_FILES['journal_file']['name']);
          $check_scholarship="false";

          $sql = "INSERT INTO `scholarship_journal` (`author`, `date`, `journal_name`, `titleTH`, `volume`, `page`, `id`, `titleEN`,`number`, `type`, `file_path`, `check_scholarship`)
                  VALUES ('$author', '$date', '$journal_name', '$titleTH', '$volume', '$page', NULL, '$titleEN', '$number', '$type', '$file_path', '$check_scholarship')";
          if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
            header('Location: http://localhost/seniorproject/admin/admin.php');
          } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
          }
        }
        $conn->close();
      ?>
  </body>
</html>
