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
    <link rel="stylesheet" href="http://localhost/seniorproject/fm.tagator.jquery.css">
    <script src="http://localhost/seniorproject/fm.tagator.jquery.js"></script>
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
      $titleTH=$row['titleTH'];
      $titleEN=$row['titleEN'];
      $author=$row['author'];
      $journal_name=$row['journal_name'];
      $volume=$row['volume'];
      $number=$row['number'];
      $page=$row['page'];
      $date=$row['date'];

      $sql = "SELECT * FROM `teacher` WHERE `position`='หัวหน้าภาควิชา'";
      $result = $conn->query($sql);
      $row = $result->fetch_assoc();
      $head_of_department=$row['title'].$row['name'];

      $active="Active";
      $sql = "SELECT * FROM `teacher` WHERE `status`='$active'";
      $result = $conn->query($sql);
      if ($result->num_rows > 0) {
        $teacher_name=[];
        while($row = $result->fetch_assoc())  {
          array_push($teacher_name,$row['title'].$row['name']);
        }
      }

      $conn->close();
    ?>
    <div class="container">
      <form action="scholarship_journal.php/?id=<?php echo $_GET['id']; ?>" method="post" enctype="multipart/form-data">
        <div class='row'>
          <div class="form-group col-md-6">
            <label for="author"><strong>ชื่อผู้เขียน</strong></label>
            <input type="text" class="form-control" placeholder="กรุณากรอกชื่อผู้เขียน" name="author" id="author_tag" value="<?php echo $author; ?>">
          </div>
          <div class="form-group col-md-6">
            <label for="department"><strong>สังกัด</strong></label>
            <input type="text" class="form-control" placeholder="กรุณาระบุสังกัด" name="department" value="ภาควิชาคอมพิวเตอร์">
          </div>
        </div>
          <div class="form-group">
            <label for="titleEN"><strong>ชื่อผลงานวิจัย(english)</strong></label>
            <input type="text" class="form-control" placeholder="กรุณากรอกชื่อผลงานวิจัย(english)" name="titleEN" value="<?php echo $titleEN; ?>">
          </div>
          <div class="form-group">
            <label for="titleTH"><strong>ชื่อผลงานวิจัย(ไทย)</strong></label>
            <input type="text" class="form-control" placeholder="กรุณากรอกชื่อผลงานวิจัย(ไทย)" name="titleTH" value="<?php echo $titleTH; ?>">
          </div>
          <div class="form-group">
            <label for="journal_name"><strong>ชื่อวารสารที่ตีพิมพ์</strong></label>
            <input type="text" class="form-control" placeholder="กรุณากรอกชื่อวารสารที่ตีพิมพ์" name="journal_name" value="<?php echo $journal_name; ?>">
          </div>
        <div class='row'>
          <div class="form-group col-md-3">
            <label for="volume"><strong>ปีที่</strong></label>
            <input type="text" class="form-control" placeholder="กรุณาระบุปีที่" name="volume" value="<?php echo $volume; ?>">
          </div>
          <div class="form-group col-md-3">
            <label for="number"><strong>ฉบับที่</strong></label>
            <input type="text" class="form-control" placeholder="กรุณาระบุฉบับที่" name="number" value="<?php echo $number; ?>">
          </div>
          <div class="form-group col-md-3">
            <label for="page"><strong>หน้า</strong></label>
            <input type="text" class="form-control" placeholder="กรุณาระบุหน้า" name="page" value="<?php echo $page; ?>">
          </div>
          <div class="form-group col-md-3">
            <label for="date"><strong>วัน/เดือน/ปี ที่ตีพิมพ์</strong></label>
            <input type="text" class="form-control" placeholder="กรุณากรอกวัน/เดือน/ปี ที่ตีพิมพ์" name="date" value="<?php echo $date; ?>">
          </div>
        </div>
          <br>
          <br>
          <hr>
        <div class='row'>
          <div class="form-group col-md-6">
            <label for="type_of_document"><strong>ประเภทของผลงาน</strong></label>
            <select class="form-control" name="type_of_document">
                <option value="research_article">Research Article</option>
                <option value="review_article">Review Article</option>
                <option value="book">Book</option>
                <option value="book_chapter">Book Chapter</option>
            </select>
          </div>
          <div class="form-group col-md-6">
            <label for="type_of_publication"><strong>ประเภทของวารสารที่ตีพิมพ์(เลือกเพียง 1 ประเภท)</strong></label>
            <select class="form-control" name="type_of_publication">
                <option value="วารสารระดับนานาชาติที่ปรากฏในฐานข้อมูล ISI/Scopus รางวัลละไม่เกิน 30,000 บาท">วารสารระดับนานาชาติที่ปรากฏในฐานข้อมูล ISI/Scopus รางวัลละไม่เกิน 30,000 บาท</option>
                <option value="วารสารระดับนานาชาติที่ปรากฏในฐานข้อมูลตามเกณฑ์ ก.พ.อ. รางวัลละไม่เกิน 10,000 บาท">วารสารระดับนานาชาติที่ปรากฏในฐานข้อมูลตามเกณฑ์ ก.พ.อ. รางวัลละไม่เกิน 10,000 บาท</option>
                <option value="วารสารระดับชาติที่ปรากฏในฐานข้อมูล TCI กลุ่ม 1 รางวัลละไม่เกิน 6,000 บาท">วารสารระดับชาติที่ปรากฏในฐานข้อมูล TCI กลุ่ม 1 รางวัลละไม่เกิน 6,000 บาท</option>
                <option value="วารสารระดับชาติที่ปรากฏในฐานข้อมูล TCI กลุ่ม 2 รางวัลละไม่เกิน 4,000 บาท">วารสารระดับชาติที่ปรากฏในฐานข้อมูล TCI กลุ่ม 2 รางวัลละไม่เกิน 4,000 บาท</option>
            </select>
              <input type="text" class="form-control" placeholder="กรณีที่เลือกวารสารระดับนานาชาติที่ปรากฏในฐานข้อมูลตามเกณฑ์ ก.พ.อ. โปรดระบุชื่อฐานข้อมูล" name="database_name">
          </div>
        </div>
        <div class='row'>
          <div class="form-group  col-md-8">
            <label for="approval"><strong>การเป็นผลงานที่ใช้ขออนุมัติสิ้นสุดสัญญาโครงการที่ได้รับทุนอุดหนุนการวิจัยจากคณะวิทยาศาสตร์</strong></label>
            <select class="form-control" name="approval">
                <option value="กรณีที่ 1 ไม่เป็น (ได้รับการสนับสนุนเต็มจำนวน)">กรณีที่ 1 ไม่เป็น (ได้รับการสนับสนุนเต็มจำนวน)</option>
                <option value="กรณีที่ 2 เป็น (ได้รับการสนับสนุน 20% ของเงินรางวัลที่กำหนด)">กรณีที่ 2 เป็น (ได้รับการสนับสนุน 20% ของเงินรางวัลที่กำหนด)</option>
            </select>
          </div>
          <div class="form-group  col-md-4">
            <label for="participation"><strong>การมีส่วนร่วมในผลงาน</strong></label>
            <select class="form-control" name="participation">
                <option value="กรณีที่ 1 First Author">กรณีที่ 1 First Author (ได้รับการสนับสนุนเต็มจำนวน)</option>
                <option value="กรณีที่ 1 Corresponding Author">กรณีที่ 1 Corresponding Author (ได้รับการสนับสนุนเต็มจำนวน)</option>
                <option value="กรณีที่ 2 เป็นผู้ร่วมเขียน">กรณีที่ 2 เป็นผู้ร่วมเขียน (ได้รับการสนับสนุนกึ่งหนึ่งของเงินรางวัลที่ได้รับจากหัวข้อก่อนหน้า)</option>
            </select>
          </div>
        </div>
        <div class='row'>
          <div class="form-group col-md-6">
            <label for="amount"><strong>จำนวนเงินทุนที่ขอรับการสนับสนุน(ตัวเลข)</strong></label>
            <select class="form-control" name="amount">
                <option value="30,000">30,000 บาท</option>
                <option value="10,000">10,000 บาท</option>
                <option value="6,000">6,000 บาท</option>
                <option value="4,000">4,000 บาท</option>
            </select>
          </div>
          <div class="form-group col-md-6">
            <label for="amount_text"><strong>จำนวนเงินทุนที่ขอรับการสนับสนุน(ข้อความ)</strong></label>
            <select class="form-control" name="amount_text">
                <option value="สามหมื่นบาทถ้วน">สามหมื่นบาทถ้วน</option>
                <option value="หนึ่งหมื่นบาทถ้วน">หนึ่งหมื่นบาทถ้วน</option>
                <option value="หกพันบาทถ้วน">หกพันบาทถ้วน</option>
                <option value="สี่พันบาทถ้วน">สี่พันบาทถ้วน</option>
            </select>
          </div>
        </div>
        <div class='row'>
          <div class="form-group col-md-4">
            <label for="applicant"><strong>ลงชื่อผู้ขอรับการสนับสนุน</strong></label>
            <select class="form-control" name="applicant">
              <?php
                foreach ($teacher_name as $name) {
                    echo "<option value='$name'>$name</option>";
                }
              ?>
            </select>
          </div>
          <div class="form-group col-md-4">
            <label for="head_of_department"><strong>ลงชื่อหัวหน้าภาควิชา</strong></label>
            <input type="text" class="form-control" placeholder="กรุณาระบุชื่อหัวหน้าภาควิชา" name="head_of_department" value="<?php echo $head_of_department; ?>">
          </div>
          <div class="form-group col-md-4">
            <label for="department_name"><strong>สังกัดของหัวหน้าภาควิชา</strong></label>
            <input type="text" class="form-control" placeholder="กรุณากรอกภาควิชา" name="department_name" value="คอมพิวเตอร์">
          </div>
        </div>
          <div class="form-group">
            <label for="journal_file"><strong>อัพโหลดไฟล์</strong></label>
            <input type="file" class="form-control" placeholder="Upload file" name="journal_file">
          </div>
          <button type="submit" class="btn btn-success btn-block">ยืนยัน</button>
      </form>
    </div>

    <script type="text/javascript">
     $('#author_tag').tagator({
        // autocomplete: ['first', 'second', 'third', 'jQuery', 'Script', 'Net'],
        autocomplete: [<?php foreach ($teacher_name as $name) {
          echo "'$name',";
        }?>],
        useDimmer: false,
        prefix: 'tagator_',
        height: 'auto',
        showAllOptionsOnFocus: true,
      });
    </script>

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
           $targetfolder = "C:\\xampp\\htdocs\\SeniorProject\\uploads\\";
           $targetfolder = $targetfolder . basename( $_FILES['journal_file']['name']) ;
           $file_path = '';
           if(move_uploaded_file($_FILES['journal_file']['tmp_name'], $targetfolder))
           {
             echo "The file " . basename($_FILES['journal_file']['name']) . " is uploaded";
             $file_path="http://localhost/seniorproject/uploads/". basename($_FILES['journal_file']['name']);
           }

          $id=$_GET['id'];

          $author=$_POST['author'];
          $department=$_POST['department'];
          $titleTH=$_POST['titleTH'];
          $titleEN=$_POST['titleEN'];
          $volume=$_POST['volume'];
          $number=$_POST['number'];
          $journal_name=$_POST['journal_name'];
          // $year=$_POST['year'];
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
          $page=$_POST['page'];
          $type="scholarship_journal";
          $check_scholarship="true";

          $sql = "UPDATE `scholarship_journal` SET `author`='$author', `department`='$department', `titleEN`='$titleEN', `titleTH`='$titleTH', `journal_name`='$journal_name', `date`='$date', `type_of_document`='$type_of_document'
          , `type_of_publication`='$type_of_publication'
          , `database_name`='$database_name', `approval`='$approval', `participation`='$participation', `amount`='$amount', `amount_text`='$amount_text', `applicant`='$applicant', `head_of_department`='$head_of_department', `department_name`='$department_name', `page`='$page', `type`='$type'
          , `file_path`='$file_path', `volume`='$volume', `number`='$number', `check_scholarship`='$check_scholarship', `file_path`='$file_path' WHERE `scholarship_journal`.`id` = $id;";

          if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
            echo '<script language="javascript">';
            echo 'alert("สร้างเอกสารขอทุนสำเร็จ")';
            echo '</script>';
            echo "<script type='text/javascript'>window.location.href='http://localhost/seniorproject/admin/admin.php'</script>";
          } else {
            echo '<script language="javascript">';
            echo 'alert("สร้างเอกสารขอทุนไม่สำเร็จ")';
            echo '</script>';
            // echo "Error: " . $sql . "<br>" . $conn->error;
          }
        }
        $conn->close();
      ?>
  </body>
</html>
