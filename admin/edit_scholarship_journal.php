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
          $sql = "SELECT * FROM `scholarship_journal` WHERE `id`=$id";
          $result = $conn->query($sql);
          $row = $result->fetch_assoc();
          $author=$row['author'];
          $department=$row['department'];
          $titleTH=$row['titleTH'];
          $titleEN=$row['titleEN'];
          $journal_name=$row['journal_name'];
          $year=$row['year'];
          $date=$row['date'];
          $type_of_document=$row['type_of_document'];
          $type_of_publication=$row['type_of_publication'];
          $database_name=$row['database_name'];
          $approval=$row['approval'];
          $participation=$row['participation'];
          $amount=$row['amount'];
          $amount_text=$row['amount_text'];
          $applicant=$row['applicant'];
          $head_of_department=$row['head_of_department'];
          $department_name=$row['department_name'];

          $conn->close();
        ?>

        <div class="container">
          <form action='<?php echo "http://localhost/seniorproject/admin/edit_scholarship_journal.php/?id=$id"?>' method="post" enctype="multipart/form-data">
            <div class="form-group">
              <label for="author">ชื่อผู้ขอรับการสนับสนุน</label>
              <input type="text" class="form-control" placeholder="กรุณากรอกชื่อผู้ขอรับการสนับสนุน" name="author" value="<?php echo $author; ?>">
            </div>
            <div class="form-group">
              <label for="department">สังกัด</label>
              <input type="text" class="form-control" placeholder="กรุณาระบุสังกัด" name="department" value="<?php echo $department; ?>">
            </div>
            <div class="form-group">
              <label for="titleEN">ชื่อผลงานวิจัย(english)</label>
              <input type="text" class="form-control" placeholder="กรุณากรอกชื่อผลงานวิจัย(english)" name="titleEN" value="<?php echo $titleEN; ?>"
            </div>
            <div class="form-group">
              <label for="titleTH">ชื่อผลงานวิจัย(ไทย)</label>
              <input type="text" class="form-control" placeholder="กรุณากรอกชื่อผลงานวิจัย(ไทย)" name="titleTH" value="<?php echo $titleTH; ?>">
            </div>
            <div class="form-group">
              <label for="journal_name">ชื่อวารสารที่ตีพิมพ์</label>
              <input type="text" class="form-control" placeholder="กรุณากรอกชื่อวารสารที่ตีพิมพ" name="journal_name" value="<?php echo $journal_name; ?>">
            </div>
            <div class="form-group">
              <label for="year">ปีที่ ฉบับที่ เลขหน้า</label>
              <input type="text" class="form-control" placeholder="กรุณากรอกปีที่ ฉบับที่ เลขหน้า" name="year" value="<?php echo $year; ?>">
            </div>
            <div class="form-group">
              <label for="date">วัน/เดือน/ปี</label>
              <input type="text" class="form-control" placeholder="กรุณากรอกวัน/เดือน/ปี" name="date" value="<?php echo $date; ?>">
            </div>
            <div class="form-group">
              <label for="type_of_document">ประเภทของผลงาน</label>
              <select class="form-control" name="type_of_document" value="<?php echo $type_of_document; ?>">
                  <option value="research_article" <?php if($type_of_document=="research_article") echo 'selected'?>>Research Article</option>
                  <option value="review_article" <?php if($type_of_document=="review_article") echo 'selected'?>>Review Article</option>
                  <option value="book" <?php if($type_of_document=="book") echo 'selected'?>>Book</option>
                  <option value="book_chapter" <?php if($type_of_document=="book_chapter") echo 'selected'?>>Book Chapter</option>
              </select>
            </div>
            <div class="form-group">
              <label for="type_of_publication">ประเภทของวารสารที่ตีพิมพ์(เลือกเพียง 1 ประเภท)</label>
              <select class="form-control" name="type_of_publication" value="<?php echo $type_of_publication; ?>">
                  <option value="วารสารระดับนานาชาติที่ปรากฏในฐานข้อมูล ISI/Scopus รางวัลละไม่เกิน 30,000 บาท" <?php if($type_of_publication=="วารสารระดับนานาชาติที่ปรากฏในฐานข้อมูล ISI/Scopus รางวัลละไม่เกิน 30,000 บาท") echo 'selected'?>>วารสารระดับนานาชาติที่ปรากฏในฐานข้อมูล ISI/Scopus รางวัลละไม่เกิน 30,000 บาท</option>
                  <option value="วารสารระดับนานาชาติที่ปรากฏในฐานข้อมูลตามเกณฑ์ ก.พ.อ. รางวัลละไม่เกิน 10,000 บาท" <?php if($type_of_publication=="วารสารระดับนานาชาติที่ปรากฏในฐานข้อมูลตามเกณฑ์ ก.พ.อ. รางวัลละไม่เกิน 10,000 บาท") echo 'selected'?>>วารสารระดับนานาชาติที่ปรากฏในฐานข้อมูลตามเกณฑ์ ก.พ.อ. รางวัลละไม่เกิน 10,000 บาท</option>
                  <option value="วารสารระดับชาติที่ปรากฏในฐานข้อมูล TCI กลุ่ม 1 รางวัลละไม่เกิน 6,000 บาท" <?php if($type_of_publication=="วารสารระดับชาติที่ปรากฏในฐานข้อมูล TCI กลุ่ม 1 รางวัลละไม่เกิน 6,000 บาท") echo 'selected'?>>วารสารระดับชาติที่ปรากฏในฐานข้อมูล TCI กลุ่ม 1 รางวัลละไม่เกิน 6,000 บาท</option>
                  <option value="วารสารระดับชาติที่ปรากฏในฐานข้อมูล TCI กลุ่ม 2 รางวัลละไม่เกิน 4,000 บาท" <?php if($type_of_publication=="วารสารระดับชาติที่ปรากฏในฐานข้อมูล TCI กลุ่ม 2 รางวัลละไม่เกิน 4,000 บาท") echo 'selected'?>>วารสารระดับชาติที่ปรากฏในฐานข้อมูล TCI กลุ่ม 2 รางวัลละไม่เกิน 4,000 บาท</option>
              </select>
                <input type="text" class="form-control" placeholder="กรณีที่เลือกวารสารระดับนานาชาติที่ปรากฏในฐานข้อมูลตามเกณฑ์ ก.พ.อ. โปรดระบุชื่อฐานข้อมูล" name="database_name"  value="<?php echo $database_name; ?>">
            </div>
            <div class="form-group">
              <label for="approval">การเป็นผลงานที่ใช้ขออนุมัติสิ้นสุดสัญญาโครงการที่ได้รับทุนอุดหนุนการวิจัยจากคณะวิทยาศาสตร์</label>
              <select class="form-control" name="approval" value="<?php echo $approval; ?>">
                  <option value="กรณีที่ 1 ไม่เป็น (ได้รับการสนับสนุนเต็มจำนวน)" <?php if($approval=="กรณีที่ 1 ไม่เป็น (ได้รับการสนับสนุนเต็มจำนวน)") echo 'selected'?>>กรณีที่ 1 ไม่เป็น (ได้รับการสนับสนุนเต็มจำนวน)</option>
                  <option value="กรณีที่ 2 เป็น (ได้รับการสนับสนุน 20% ของเงินรางวัลที่กำหนด)" <?php if($approval=="กรณีที่ 2 เป็น (ได้รับการสนับสนุน 20% ของเงินรางวัลที่กำหนด)") echo 'selected'?>>กรณีที่ 2 เป็น (ได้รับการสนับสนุน 20% ของเงินรางวัลที่กำหนด)</option>
              </select>
            </div>
            <div class="form-group">
              <label for="participation">การมีส่วนร่วมในผลงาน</label>
              <select class="form-control" name="participation">
                  <option value="กรณีที่ 1 First Author" <?php if($participation=="กรณีที่ 1 First Author") echo 'selected'?>>กรณีที่ 1 First Author (ได้รับการสนับสนุนเต็มจำนวน)</option>
                  <option value="กรณีที่ 1 Corresponding Author" <?php if($participation=="กรณีที่ 1 Corresponding Author") echo 'selected'?>>กรณีที่ 1 Corresponding Author (ได้รับการสนับสนุนเต็มจำนวน)</option>
                  <option value="กรณีที่ 2 เป็นผู้ร่วมเขียน" <?php if($participation=="กรณีที่ 2 เป็นผู้ร่วมเขียน") echo 'selected'?>>กรณีที่ 2 เป็นผู้ร่วมเขียน (ได้รับการสนับสนุนกึ่งหนึ่งของเงินรางวัลที่ได้รับจากหัวข้อก่อนหน้า)</option>
              </select>
            </div>
            <div class="form-group">
              <label for="amount">จำนวนเงินทุนที่ขอรับการสนับสนุน(ระบุเป็นตัวเลข เช่น 3,000)</label>
              <input type="text" class="form-control" placeholder="ระบุจำนวนเงินทุนที่ขอรับการสนับสนุน" name="amount" value="<?php echo $amount; ?>">
            </div>
            <div class="form-group">
              <label for="amount_text">จำนวนเงินทุนที่ขอรับการสนับสนุน(ระบุเป็นข้อความ เช่น สามพันบาทถ้วน)</label>
              <input type="text" class="form-control" placeholder="ระบุจำนวนเงินทุนที่ขอรับการสนับสนุน" name="amount_text" value="<?php echo $amount_text; ?>">
            </div>
            <div class="form-group">
              <label for="applicant">ลงชื่อผู้ขอรับการสนับสนุน</label>
              <input type="text" class="form-control" placeholder="กรุณาระบุชื่อผู้ขอรับการสนับสนุน" name="applicant" value="<?php echo $applicant; ?>">
            </div>
            <div class="form-group">
              <label for="head_of_department">ลงชื่อหัวหน้าภาควิชา</label>
              <input type="text" class="form-control" placeholder="กรุณาระบุชื่อหัวหน้าภาควิชา" name="head_of_department" value="<?php echo $head_of_department; ?>">
            </div>
            <div class="form-group">
              <label for="department_name">สังกัดของหัวหน้าภาควิชา(เช่น คอมพิวเตอร์)</label>
              <input type="text" class="form-control" placeholder="กรุณาระบุสังกัดภาควิชา" name="department_name" value="<?php echo $department_name; ?>">
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

      if(isset($_POST['titleEN']) && $_POST['titleEN'] != '' &&
         isset($_POST['author']) && $_POST['author'] != '')
        {
          $id=$_GET['id'];

          $author=$_POST['author'];
          $department=$_POST['department'];
          $titleTH=$_POST['titleTH'];
          $titleEN=$_POST['titleEN'];
          $journal_name=$_POST['journal_name'];
          $year=$_POST['year'];
          $date=$_POST['date'];
          $type_of_document=$_POST['type_of_document'];
          $type_of_publication=$_POST['type_of_publication'];
          $database_name=$_POST['database_name'];
          $approval=$_POST['approval'];
          $participation=$_POST['participation'];
          $amount=$_POST['amount'];
          $amount_text=$_POST['amount_text'];
          $applicant=$_POST['applicant'];
          $head_of_department=$_POST['head_of_department'];
          $department_name=$_POST['department_name'];

          $sql = "UPDATE `scholarship_journal` SET `author`='$author', `department`='$department', `titleEN`='$titleEN', `titleTH`='$titleTH', `journal_name`='$journal_name', `year`='$year', `date`='$date', `type_of_document`='$type_of_document'
          , `type_of_publication`='$type_of_publication'
          , `database_name`='$database_name', `approval`='$approval', `participation`='$participation', `amount`='$amount', `amount_text`='$amount_text', `applicant`='$applicant', `head_of_department`='$head_of_department', `department_name`='$department_name' WHERE `scholarship_journal`.`id` = $id;";

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
