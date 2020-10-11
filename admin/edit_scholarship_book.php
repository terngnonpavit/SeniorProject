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
      <form action="scholarship_book.php" method="post" enctype="multipart/form-data">
          <div class="form-group">
            <label for="year">ปีงบประมาณ</label>
            <input type="text" class="form-control" placeholder="กรุณากรอกปีงบประมาณ" name="year">
          </div>
          <div class="form-group">
            <label for="titleTH">ชื่อตำรา(ไทย)</label>
            <input type="text" class="form-control" placeholder="กรุณากรอกชื่อตำรา(ไทย)" name="titleTH">
          </div>
          <div class="form-group">
            <label for="titleEN">ชื่อตำรา(english)</label>
            <input type="text" class="form-control" placeholder="กรุณากรอกชื่อตำรา(english)" name="titleEN">
          </div>
          <div class="form-group">
            <label for="writer_name">ชื่อ-สกุลหัวหน้าโครงการ</label>
            <input type="text" class="form-control" placeholder="กรุณากรอกชื่อ-สกุลหัวหน้าโครงการ" name="writer_name">
          </div>
          <div class="form-group">
            <label for="writer_department">ภาควิชา</label>
            <input type="text" class="form-control" placeholder="กรุณากรอกภาควิชา" name="writer_department">
          </div>
          <div class="form-group">
            <label for="write_ratio">สัดส่วนของการเขียนตำรา(เปอร์เซ็นต์)</label>
            <input type="text" class="form-control" placeholder="กรุณากรอกสัดส่วนของการเขียนตำรา(เปอร์เซ็นต์)" name="write_ratio">
          </div>
          <div class="form-group">
            <label for="co_writer_name">ชื่อ-สกุลผู้ร่วมโครงการ</label>
            <input type="text" class="form-control" placeholder="กรุณากรอกชื่อ-สกุลผู้ร่วมโครงการ" name="co_writer_name">
          </div>
          <div class="form-group">
            <label for="co_writer_department">ภาควิชา</label>
            <input type="text" class="form-control" placeholder="กรุณากรอกภาควิชา" name="co_writer_department">
          </div>
          <div class="form-group">
            <label for="co_write_ratio">สัดส่วนของการเขียนตำรา(เปอร์เซ็นต์)</label>
            <input type="text" class="form-control" placeholder="กรุณากรอกสัดส่วนของการเขียนตำรา(เปอร์เซ็นต์)" name="co_write_ratio">
          </div>
          <div class="form-group">
            <label for="keywordTH">คำสำคัญ(ไทย)</label>
            <input type="text" class="form-control" placeholder="กรุณาระบุคำสำคัญ(ไทย)" name="keywordTH">
          </div>
          <div class="form-group">
            <label for="keywordEN">คำสำคัญ(english)</label>
            <input type="text" class="form-control" placeholder="กรุณาระบุคำสำคัญ(english)" name="keywordEN">
          </div>
          <div class="form-group">
            <label for="amount">จำนวนเงินทุนที่ขอรับการสนับสนุน(ระบุเป็นตัวเลข เช่น 2,000)</label>
            <input type="text" class="form-control" placeholder="ระบุจำนวนเงินทุนที่ขอรับการสนับสนุน" name="amount">
          </div>
          <div class="form-group">
            <label for="amount_text">จำนวนเงินทุนที่ขอรับการสนับสนุน(ระบุเป็นข้อความ เช่น สองพัน)</label>
            <input type="text" class="form-control" placeholder="ระบุจำนวนเงินทุนที่ขอรับการสนับสนุน" name="amount_text">
          </div>
          <div class="form-group">
            <label for="subject_no">รายวิชา</label>
            <input type="text" class="form-control" placeholder="กรุณาระบุรายวิชา" name="subject_no">
          </div>
          <div class="form-group">
            <label for="subject">ชื่อวิชา</label>
            <input type="text" class="form-control" placeholder="กรุณาระบุชื่อวิชา" name="subject">
          </div>
          <div class="form-group">
            <label for="for_student">สำหรับนักศึกษาระดับ(เช่น ปริญญาตรี)</label>
            <input type="text" class="form-control" placeholder="กรุณาระบุระดับนักศึกษา" name="for_student">
          </div>
          <div class="form-group">
            <label for="student_year">ชั้นปีที่</label>
            <input type="text" class="form-control" placeholder="กรุณาระบุชั้นปี" name="student_year">
          </div>
          <div class="form-group">
            <label for="page_amount">ปริมาณเนื้อหา(จำนวนหน้า)</label>
            <input type="text" class="form-control" placeholder="กรุณาระบุจำนวนหน้า" name="page_amount">
          </div>
          <div class="form-group">
            <label for="chapter_no_1">บทที่</label>
            <input type="text" class="form-control" placeholder="กรุณาระบุบทที่" name="chapter_no_1">
          </div>
          <div class="form-group">
            <label for="chapter_name_1">ชื่อบท</label>
            <input type="text" class="form-control" placeholder="กรุณาระบุชื่อบท" name="chapter_name_1">
          </div>
          <div class="form-group">
            <label for="content_1">เนื้อหา</label>
            <input type="text" class="form-control" placeholder="กรุณาระบุเนื้อหา" name="content_1">
          </div>
          <div class="form-group">
            <label for="chapter_no_2">บทที่</label>
            <input type="text" class="form-control" placeholder="กรุณาระบุบทที่" name="chapter_no_2">
          </div>
          <div class="form-group">
            <label for="chapter_name_2">ชื่อบท</label>
            <input type="text" class="form-control" placeholder="กรุณาระบุชื่อบท" name="chapter_name_2">
          </div>
          <div class="form-group">
            <label for="content_2">เนื้อหา</label>
            <input type="text" class="form-control" placeholder="กรุณาระบุเนื้อหา" name="content_2">
          </div>
          <div class="form-group">
            <label for="chapter_no_3">บทที่</label>
            <input type="text" class="form-control" placeholder="กรุณาระบุบทที่" name="chapter_no_3">
          </div>
          <div class="form-group">
            <label for="chapter_name_3">ชื่อบท</label>
            <input type="text" class="form-control" placeholder="กรุณาระบุชื่อบท" name="chapter_name_3">
          </div>
          <div class="form-group">
            <label for="content_3">เนื้อหา</label>
            <input type="text" class="form-control" placeholder="กรุณาระบุเนื้อหา" name="content_3">
          </div>
          <div class="form-group">
            <label for="teaching_history">ประวัติการสอน(โดยสังเขป)</label>
            <input type="text" class="form-control" placeholder="กรุณาระบุประวัติการสอน(โดยสังเขป)" name="teaching_history">
          </div>
          <div class="form-group">
            <label for="applicant">ลงชื่อ(ผู้ขอรับทุน)</label>
            <input type="text" class="form-control" placeholder="กรุณาระบุชื่อผู้ขอรับทุน" name="applicant">
          </div>
          <div class="form-group">
            <label for="Head of Department">ลงชื่อ(หัวหน้าภาควิชา)</label>
            <input type="text" class="form-control" placeholder="กรุณาระบุชื่อหัวหน้าภาควิชา" name="head_of_department">
          </div>
          <div class="form-group">
            <label for="department_name">สังกัดของหัวหน้าภาควิชา(เช่น ภาควิชาคอมพิวเตอร์)</label>
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
         isset($_POST['year']) && $_POST['year'] != '')
         {
          $year=$_POST['year'];
          $titleTH=$_POST['titleTH'];
          $titleEN=$_POST['titleEN'];
          $writer_name=$_POST['writer_name'];
          $writer_department=$_POST['writer_department'];
          $write_ratio=$_POST['write_ratio'];
          $co_writer_name=$_POST['co_writer_name'];
          $co_writer_department=$_POST['co_writer_department'];
          $co_write_ratio=$_POST['co_write_ratio'];
          $keywordTH=$_POST['keywordTH'];
          $keywordEN=$_POST['keywordEN'];
          $amount=$_POST['amount'];
          $amount_text=$_POST['amount_text'];
          $subject_no=$_POST['subject_no'];
          $subject=$_POST['subject'];
          $for_student=$_POST['for_student'];
          $student_year=$_POST['student_year'];
          $page_amount=$_POST['page_amount'];
          $chapter_no_1=$_POST['chapter_no_1'];
          $chapter_no_2=$_POST['chapter_no_2'];
          $chapter_no_3=$_POST['chapter_no_3'];
          $chapter_name_1=$_POST['chapter_name_1'];
          $chapter_name_2=$_POST['chapter_name_2'];
          $chapter_name_3=$_POST['chapter_name_3'];
          $content_1=$_POST['content_1'];
          $content_2=$_POST['content_2'];
          $content_3=$_POST['content_3'];
          $teaching_history=$_POST['teaching_history'];
          $applicant=$_POST['applicant'];
          $head_of_department=$_POST['head_of_department'];
          $department_name=$_POST['department_name'];

          $sql = "UPDATE `scholarship_book` (`year`, `titleTH`, `titleEN`, `writer_name`, `writer_department`, `write_ratio`, `co_writer_name`, `co_writer_department`, `co_write_ratio`, `keywordTH`, `keywordEN`, `amount`, `amount_text`, `subject_no`, `subject`, `for_student`, `student_year`, `page_amount`, `chapter_no_1`, `chapter_name_1`, `content_1`, `chapter_no_2`, `chapter_name_2`, `content_2`, `chapter_no_3`, `chapter_name_3`, `content_3`, `teaching_history`, `applicant`, `head_of_department`, `department_name`) VALUES ('$year', '$titleTH', '$titleEN', '$writer_name', '$writer_department', '$write_ratio', '$co_writer_name', '$co_writer_department', '$co_write_ratio', '$keywordTH', '$keywordEN', '$amount', '$amount_text', '$subject_no', '$subject', '$for_student', '$student_year', '$page_amount', '$chapter_no_1', '$chapter_name_1', '$content_1', '$chapter_no_2', '$chapter_name_2', '$content_2', '$chapter_no_3', '$chapter_name_3', '$content_3', '$teaching_history', '$applicant', '$head_of_department', '$department_name')";

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