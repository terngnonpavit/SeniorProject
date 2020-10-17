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

    <div class="container">
      <form action="scholarship_proceeding.php" method="post" enctype="multipart/form-data">
          <div class="form-group">
            <label for="author">ชื่อผู้ขอรับการสนับสนุน</label>
            <input type="text" class="form-control" placeholder="กรุณากรอกชื่อผู้ขอรับการสนับสนุน" name="author">
          </div>
          <div class="form-group">
            <label for="department">สังกัด</label>
            <input type="text" class="form-control" placeholder="กรุณาระบุสังกัด" name="department">
          </div>
          <div class="form-group">
            <label for="titleTH">ชื่อผลงานวิจัย(ไทย)</label>
            <input type="text" class="form-control" placeholder="กรุณากรอกชื่อผลงานวิจัย(ไทย)" name="titleTH">
          </div>
          <div class="form-group">
            <label for="titleEN">ชื่อผลงานวิจัย(english)</label>
            <input type="text" class="form-control" placeholder="กรุณากรอกชื่อผลงานวิจัย(english)" name="titleEN">
          </div>
          <div class="form-group">
            <label for="conference_name">ชื่อการประชุมวิชาการ</label>
            <input type="text" class="form-control" placeholder="กรุณากรอกชื่อการประชุมวิชาการ" name="conference_name">
          </div>
          <div class="form-group">
            <label for="place">สถานที่</label>
            <input type="text" class="form-control" placeholder="กรุณากรอกสถานที่" name="place">
          </div>
          <div class="form-group">
            <label for="date">วัน/เดือน/ปี</label>
            <input type="text" class="form-control" placeholder="กรุณากรอกวัน/เดือน/ปี" name="date">
          </div>
          <div class="form-group">
            <label for="type_of_document">ประเภทของผลงาน</label>
            <input type="text" class="form-control" placeholder="กรุณากรอกประเภทของผลงาน" name="type_of_document">
          </div>
          <div class="form-group">
            <label for="type_of_publication">ประเภทของการตีพิมพ์และการประชุมวิชาการ(เลือกเพียง 1 ประเภท)</label>
            <input type="text" class="form-control" placeholder="กรุณาเลือกประเภทของการตีพิมพ์และการประชุมวิชาการ(เลือกเพียง 1 ประเภท)" name="type_of_publication">
          </div>
          <div class="form-group">
            <label for="approval">การเป็นผลงานที่ใช้ขออนุมัติสิ้นสุดสัญญาโครงการที่ได้รับทุนอุดหนุนการวิจัยจากคณะวิทยาศาสตร์</label>
            <input type="text" class="form-control" placeholder="กรุณาระบุ" name="approval">
          </div>
          <div class="form-group">
            <label for="participation">การมีส่วนร่วมในผลงาน</label>
            <input type="text" class="form-control" placeholder="กรุณาระบุ" name="participation">
          </div>
          <div class="form-group">
            <label for="form_document">รูปแบบของเอกสารที่เผยแพร่</label>
            <input type="text" class="form-control" placeholder="กรุณาระบุ" name="form_document">
          </div>
          <div class="form-group">
            <label for="certification">การรับรองผลงาน</label>
            <input type="text" class="form-control" placeholder="กรุณาระบุ" name="certification">
          </div>
          <div class="form-group">
            <label for="amount">จำนวนเงินทุนที่ขอรับการสนับสนุน(ระบุเป็นตัวเลข เช่น 3,000)</label>
            <input type="text" class="form-control" placeholder="ระบุจำนวนเงินทุนที่ขอรับการสนับสนุน" name="amount">
          </div>
          <div class="form-group">
            <label for="amount_text">จำนวนเงินทุนที่ขอรับการสนับสนุน(ระบุเป็นข้อความ เช่น สามพันบาทถ้วน)</label>
            <input type="text" class="form-control" placeholder="ระบุจำนวนเงินทุนที่ขอรับการสนับสนุน" name="amount_text">
          </div>
          <div class="form-group">
            <label for="applicant">ลงชื่อผู้ขอรับการสนับสนุน</label>
            <input type="text" class="form-control" placeholder="กรุณาระบุชื่อผู้ขอรับการสนับสนุน" name="applicant">
          </div>
          <div class="form-group">
            <label for="head_of_department">ลงชื่อหัวหน้าภาควิชา</label>
            <input type="text" class="form-control" placeholder="กรุณาระบุชื่อหัวหน้าภาควิชา" name="head_of_department">
          </div>
          <div class="form-group">
            <label for="department_name">สังกัดของหัวหน้าภาควิชา(เช่น คอมพิวเตอร์)</label>
            <input type="text" class="form-control" placeholder="กรุณาระบุสังกัดภาควิชา" name="department_name">
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

      if(isset($_POST['titleTH']) && $_POST['titleTH'] != '' &&
         isset($_POST['titleEN']) && $_POST['titleEN'] != '' &&
         isset($_POST['author']) && $_POST['author'] != '')
         {
          $author=$_POST['author'];
          $department=$_POST['department'];
          $titleTH=$_POST['titleTH'];
          $titleEN=$_POST['titleEN'];
          $conference_name=$_POST['conference_name'];
          $place=$_POST['place'];
          $date=$_POST['date'];
          $type_of_document=$_POST['type_of_document'];
          $type_of_publication=$_POST['type_of_publication'];
          $approval=$_POST['approval'];
          $participation=$_POST['participation'];
          $form_document=$_POST['form_document'];
          $certification=$_POST['certification'];
          $amount=$_POST['amount'];
          $amount_text=$_POST['amount_text'];
          $applicant=$_POST['applicant'];
          $head_of_department=$_POST['head_of_department'];
          $department_name=$_POST['department_name'];

          $sql = "INSERT INTO `scholarship_proceeding` (`author`, `department`, `titleTH`, `titleEN`, `conference_name`, `place`, `date`, `type_of_document`, `type_of_publication`, `approval`, `participation`, `form_document`, `certification`, `amount`, `amount_text`, `applicant`, `head_of_department`, `department_name`) VALUES ('$author', '$department', '$titleTH', '$titleEN', '$conference_name', '$place', '$date', '$type_of_document', '$type_of_publication', '$approval', '$participation', '$form_document', '$certification', '$amount', '$amount_text', '$applicant', '$head_of_department', '$department_name')";

          if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
            echo "<script type='text/javascript'>window.location.href='http://localhost/seniorproject/admin/scholarship_menu.php'</script>";
          } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
          }
        }
        $conn->close();
      ?>
  </body>
</html>
