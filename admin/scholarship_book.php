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
      $sql = "SELECT * FROM `scholarship_book` WHERE `id`=$id";
      $result = $conn->query($sql);
      $row = $result->fetch_assoc();
      $titleTH=$row['titleTH'];
      $titleEN=$row['titleEN'];
      $writer_name=$row['writer_name'];
      $page_amount=$row['page_amount'];
      $publisher=$row['publisher'];
      $date=$row['date'];

      $sql = "SELECT * FROM `teacher` WHERE `position`='หัวหน้าภาควิชา'";
      $result = $conn->query($sql);
      $row = $result->fetch_assoc();
      $head_of_department=$row['name'];

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
      <form action="scholarship_book.php/?id=<?php echo $_GET['id']; ?>" method="post" enctype="multipart/form-data">
          <div class="form-group">
            <label for="titleTH"><strong>ชื่อตำรา(ไทย)</strong></label>
            <input type="text" class="form-control" placeholder="กรุณากรอกชื่อตำรา(ไทย)" name="titleTH" value="<?php echo $titleTH; ?>">
          </div>
          <div class="form-group">
            <label for="titleEN"><strong>ชื่อตำรา(english)</strong></label>
            <input type="text" class="form-control" placeholder="กรุณากรอกชื่อตำรา(english)" name="titleEN" value="<?php echo $titleEN; ?>">
          </div>
          <div class='row'>
            <div class="form-group col-md-6">
              <label for="writer_name"><strong>ชื่อ-สกุลหัวหน้าโครงการ</strong></label>
              <select class="form-control" name="writer_name">
                  <?php
                    foreach ($teacher_name as $name) {
                        echo "<option value='$name'>$name</option>";
                    }
                  ?>
              </select>
            </div>
            <div class="form-group col-md-3">
              <label for="write_ratio"><strong>สัดส่วนของการเขียนตำรา(%)</strong></label>
              <input type="text" class="form-control" placeholder="กรุณากรอกสัดส่วนของการเขียนตำรา(%)" name="write_ratio">
            </div>
            <div class="form-group col-md-3">
              <label for="writer_department"><strong>ภาควิชา</strong></label>
              <input type="text" class="form-control" placeholder="กรุณากรอกภาควิชา" name="writer_department" value="คอมพิวเตอร์">
            </div>
          </div>
          <div class="form-group">
            <label for="publisher"><strong>สำนักพิมพ์(publisher)</strong></label>
            <input type="text" class="form-control" placeholder="กรุณาระบุสำนักพิมพ์" name="publisher" value="<?php echo $publisher; ?>">
          </div>
          <div class='row'>
            <div class="form-group col-md-6">
              <label for="page_amount"><strong>ปริมาณเนื้อหา(จำนวนหน้า)</strong></label>
              <input type="text" class="form-control" placeholder="กรุณาระบุจำนวนหน้า" name="page_amount" value="<?php echo $page_amount; ?>">
            </div>
            <div class="form-group col-md-6">
              <label for="date"><strong>วัน/เดือน/ปีที่ตีพิมพ์</strong></label>
              <input type="text" class="form-control" placeholder="กรุณาระบุวัน/เดือน/ปี" name="date" value="<?php echo $date; ?>">
            </div>
          </div>
          <br>
          <br>
          <hr>
          <div class='row'>
            <div class="form-group col-md-6">
              <label for="co_writer_name"><strong>ชื่อ-สกุลผู้ร่วมโครงการ</strong></label>
              <select class="form-control" name="co_writer_name">
                <?php
                  foreach ($teacher_name as $name) {
                      echo "<option value='$name'>$name</option>";
                  }
                ?>
              </select>
            </div>
            <div class="form-group col-md-3">
              <label for="co_write_ratio"><strong>สัดส่วนของการเขียนตำรา(%)</strong></label>
              <input type="text" class="form-control" placeholder="กรุณากรอกสัดส่วนของการเขียนตำรา(เปอร์เซ็นต์)" name="co_write_ratio">
            </div>
            <div class="form-group col-md-3">
              <label for="co_writer_department"><strong>ภาควิชา</strong></label>
              <input type="text" class="form-control" placeholder="กรุณากรอกภาควิชา" name="co_writer_department" value="คอมพิวเตอร์">
            </div>
          </div>
          <div class="form-group">
            <label for="keywordTH"><strong>คำสำคัญ(ไทย)</strong></label>
            <input type="text" class="form-control" placeholder="กรุณาระบุคำสำคัญ(ไทย)" name="keywordTH">
          </div>
          <div class="form-group">
            <label for="keywordEN"><strong>คำสำคัญ(english)</strong></label>
            <input type="text" class="form-control" placeholder="กรุณาระบุคำสำคัญ(english)" name="keywordEN">
          </div>
          <div class='row'>
            <div class="form-group col-md-6">
              <label for="amount"><strong>จำนวนเงินทุนที่ขอรับการสนับสนุน(ระบุเป็นตัวเลข เช่น 2,000)</strong></label>
              <input type="text" class="form-control" placeholder="ระบุจำนวนเงินทุนที่ขอรับการสนับสนุน" name="amount">
            </div>
            <div class="form-group col-md-6">
              <label for="amount_text"><strong>จำนวนเงินทุนที่ขอรับการสนับสนุน(ระบุเป็นข้อความ เช่น สองพัน)</strong></label>
              <input type="text" class="form-control" placeholder="ระบุจำนวนเงินทุนที่ขอรับการสนับสนุน" name="amount_text">
            </div>
          </div>
          <div class='row'>
            <div class="form-group col-md-4">
              <label for="subject_no"><strong>รายวิชา</strong></label>
              <input type="text" class="form-control" placeholder="กรุณาระบุรายวิชา" name="subject_no">
            </div>
            <div class="form-group col-md-8">
              <label for="subject"><strong>ชื่อวิชา</strong></label>
              <input type="text" class="form-control" placeholder="กรุณาระบุชื่อวิชา" name="subject">
            </div>
          </div>
          <div class='row'>
            <div class="form-group col-md-6">
              <label for="for_student"><strong>สำหรับนักศึกษาระดับ</strong></label>
              <select class="form-control" name="for_student">
                  <option value="ปริญญาตรี">ปริญญาตรี</option>
                  <option value="ปริญญาโท">ปริญญาโท</option>
                  <option value="ปริญญาเอก">ปริญญาเอก</option>
              </select>
            </div>
            <div class="form-group col-md-6">
              <label for="student_year"><strong>ชั้นปีที่</strong></label>
              <select class="form-control" name="student_year">
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
              </select>
            </div>
          </div>

          <br>
          <hr>
          <div class='row'>
          <div class="form-group col-md-6">
              <label for="chapter_no_1"><strong>บทที่(1)</strong></label>
              <input type="text" class="form-control" placeholder="กรุณาระบุบทที่" name="chapter_no_1">
            </div>
            <div class="form-group col-md-6">
              <label for="chapter_name_1"><strong>ชื่อบท(1)</strong></label>
              <input type="text" class="form-control" placeholder="กรุณาระบุชื่อบท" name="chapter_name_1">
            </div>
          </div>
          <div class="form-group">
            <label for="content_1"><strong>เนื้อหา(1)</strong></label>
            <textarea type="text" class="form-control" placeholder="กรุณาระบุเนื้อหา" rows="5" name="content_1"></textarea>
          </div>
          <br>
          <hr>
          <div class='row'>
            <div class="form-group col-md-6">
              <label for="chapter_no_2"><strong>บทที่(2)</strong></label>
              <input type="text" class="form-control" placeholder="กรุณาระบุบทที่" name="chapter_no_2">
            </div>
            <div class="form-group col-md-6">
              <label for="chapter_name_2"><strong>ชื่อบท(2)</strong></label>
              <input type="text" class="form-control" placeholder="กรุณาระบุชื่อบท" name="chapter_name_2">
            </div>
          </div>
          <div class="form-group">
            <label for="content_2"><strong>เนื้อหา(2)</strong></label>
            <textarea type="text" class="form-control" placeholder="กรุณาระบุเนื้อหา" rows="5" name="content_2"></textarea>
          </div>
          <br>
          <hr>
          <div class='row'>
            <div class="form-group col-md-6">
              <label for="chapter_no_3"><strong>บทที่(3)</strong></label>
              <input type="text" class="form-control" placeholder="กรุณาระบุบทที่" name="chapter_no_3">
            </div>
            <div class="form-group col-md-6">
              <label for="chapter_name_3"><strong>ชื่อบท(3)</strong></label>
              <input type="text" class="form-control" placeholder="กรุณาระบุชื่อบท" name="chapter_name_3">
            </div>
          </div>
          <div class="form-group">
            <label for="content_3"><strong>เนื้อหา(3)</strong></label>
            <textarea type="text" class="form-control" placeholder="กรุณาระบุเนื้อหา" rows="5" name="content_3"></textarea>
          </div>
          <br>
          <hr>
          <div class="form-group">
            <label for="teaching_history"><strong>ประวัติการสอน(โดยสังเขป)</strong></label>
            <textarea type="text" class="form-control" placeholder="กรุณาระบุประวัติการสอน(โดยสังเขป)" rows="5" name="teaching_history"></textarea>
          </div>
          <div class='row'>
            <div class="form-group col-md-3">
              <label for="applicant"><strong>ลงชื่อผู้ขอรับทุน</strong></label>
              <select class="form-control" name="applicant">
                  <?php
                    foreach ($teacher_name as $name) {
                      echo "<option value='$name'>$name</option>";
                    }
                  ?>
              </select>
            </div>
            <div class="form-group col-md-3">
              <label for="head_of_department"><strong>ลงชื่อหัวหน้าภาควิชา</strong></label>
              <input type="text" class="form-control" placeholder="กรุณาระบุชื่อหัวหน้าภาควิชา" name="head_of_department" value="<?php echo $head_of_department; ?>">
            </div>
            <div class="form-group col-md-3">
              <label for="department_name"><strong>สังกัดของหัวหน้าภาควิชา</strong></label>
              <input type="text" class="form-control" placeholder="กรุณาระบุสังกัดภาควิชา" name="department_name" value="คอมพิวเตอร์">
            </div>
            <div class="form-group col-md-3">
              <label for="year"><strong>ปีงบประมาณ(พ.ศ.)</strong></label>
              <input type="text" class="form-control" placeholder="กรุณากรอกปีงบประมาณ(พ.ศ.)" name="year">
            </div>
          </div>
          <button type="submit" class="btn btn-success btn-block">ยืนยัน</button>
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

              $id=$_GET['id'];

              $year=$_POST['year'];
              $titleTH=$_POST['titleTH'];
              $titleEN=$_POST['titleEN'];
              $writer_name=$_POST['writer_name'];
              $author=$writer_name;
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
              $date=$_POST['date'];
              $publisher=$_POST['publisher'];
              $type="scholarship_book";
              $check_scholarship="true";

              $sql = "UPDATE `scholarship_book` SET `year`='$year', `titleTH`='$titleTH', `titleEN`='$titleEN', `writer_name`='$writer_name', `author`='$author', `writer_department`='$writer_department', `write_ratio`='$write_ratio', `co_writer_name`='$co_writer_name', `co_writer_department`='$co_writer_department'
              , `co_write_ratio`='$co_write_ratio'
              , `keywordTH`='$keywordTH', `keywordEN`='$keywordEN', `amount`='$amount', `amount_text`='$amount_text', `subject_no`='$subject_no', `subject`='$subject', `for_student`='$for_student', `student_year`='$student_year', `page_amount`='$page_amount', `chapter_no_1`='$chapter_no_1'
              , `chapter_name_1`='$chapter_name_1'
              , `content_1`='$content_1', `chapter_no_2`='$chapter_no_2', `chapter_name_2`='$chapter_name_2', `content_2`='$content_2', `chapter_no_3`='$chapter_no_3', `chapter_name_3`='$chapter_name_3', `content_3`='$content_3', `teaching_history`='$teaching_history'
              , `applicant`='$applicant', `head_of_department`='$head_of_department', `department_name`='$department_name', `date`='$date', `publisher`='$publisher', `type`='$type', `check_scholarship`='$check_scholarship' WHERE `scholarship_book`.`id` = $id;";

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
