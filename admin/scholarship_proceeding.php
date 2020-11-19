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
      $sql = "SELECT * FROM `scholarship_proceeding` WHERE `id`=$id";
      $result = $conn->query($sql);
      $row = $result->fetch_assoc();
      $titleTH=$row['titleTH'];
      $titleEN=$row['titleEN'];
      $author=$row['author'];
      $date=$row['date'];
      $place=$row['place'];
      $conference_name=$row['conference_name'];

      // $sql = "SELECT * FROM `teacher` WHERE `position`='หัวหน้าภาควิชา'";
      // $result = $conn->query($sql);
      // $row = $result->fetch_assoc();
      // $head_of_department=$row['name'];
      //
      // $active="Active";
      // $sql = "SELECT * FROM `teacher` WHERE `status`='$active'";
      // $result = $conn->query($sql);
      // if ($result->num_rows > 0) {
      //   $teacher_name=[];
      //   while($row = $result->fetch_assoc())  {
      //     array_push($teacher_name,$row['name']);
      //   }
      // }

      $conn->close();
    ?>
    <div class="container">
      <form action="scholarship_proceeding.php/?id=<?php echo $_GET['id']; ?>" method="post" enctype="multipart/form-data">
          <div class="form-group">
            <label for="author">ชื่อผู้ขอรับการสนับสนุน</label>
            <input type="text" class="form-control" placeholder="กรุณากรอกชื่อผู้ขอรับการสนับสนุน" name="author" value="<?php echo $author; ?>">
          </div>
          <div class="form-group">
            <label for="department">สังกัด</label>
            <input type="text" class="form-control" placeholder="กรุณาระบุสังกัด" name="department">
          </div>
          <div class="form-group">
            <label for="titleEN">ชื่อผลงานวิจัย(english)</label>
            <input type="text" class="form-control" placeholder="กรุณากรอกชื่อผลงานวิจัย(english)" name="titleEN" value="<?php echo $titleEN; ?>">
          </div>
          <div class="form-group">
            <label for="titleTH">ชื่อผลงานวิจัย(ไทย)</label>
            <input type="text" class="form-control" placeholder="กรุณากรอกชื่อผลงานวิจัย(ไทย)" name="titleTH" value="<?php echo $titleTH; ?>">
          </div>
          <div class="form-group">
            <label for="conference_name">ชื่อการประชุมวิชาการ</label>
            <input type="text" class="form-control" placeholder="กรุณากรอกชื่อการประชุมวิชาการ" name="conference_name" value="<?php echo $conference_name; ?>">
          </div>
          <div class="form-group">
            <label for="place">สถานที่จัด</label>
            <input type="text" class="form-control" placeholder="กรุณากรอกสถานที่" name="place" value="<?php echo $place; ?>">
          </div>
          <div class="form-group">
            <label for="date">วันเดือนปี ที่จัด</label>
            <input type="text" class="form-control" placeholder="กรุณากรอกวันเดือนปี ที่จัด" name="date" value="<?php echo $date; ?>">
          </div>
          <div class="form-group">
            <label for="type_of_document">ประเภทของผลงาน</label>
            <select class="form-control" name="type_of_document">
                <option value="research_article">Research Article</option>
                <option value="review_article">Review Article</option>
                <option value="abstract">Abstract</option>
            </select>
          </div>
          <div class="form-group">
            <label for="type_of_publication">ประเภทของการตีพิมพ์และการประชุมวิชาการ(เลือกเพียง 1 ประเภท)</label>
            <select class="form-control" name="type_of_publication">
                <option value="Proceedings ตีพิมพ์ในเอกสารสืบเนื่องจาการประชุมวิชาการระดับนานาชาติ">Proceedings ตีพิมพ์ในเอกสารสืบเนื่องจาการประชุมวิชาการระดับนานาชาติ รางวัลละไม่เกิน 3,000 บาท</option>
                <option value="Proceedings ตีพิมพ์ในเอกสารสืบเนื่องจาการประชุมวิชาการระดับชาติ">Proceedings ตีพิมพ์ในเอกสารสืบเนื่องจาการประชุมวิชาการระดับชาติ รางวัลละไม่เกิน 2,000 บาท</option>
                <option value="บทคัดย่อตีพิมพ์ในเอกสารสืบเนื่องจากการประชุมวิชาการระดับนานาชาติ">บทคัดย่อตีพิมพ์ในเอกสารสืบเนื่องจากการประชุมวิชาการระดับนานาชาต รางวัลละไม่เกิน 1,500 บาท</option>
                <option value="บทคัดย่อตีพิมพ์ในเอกสารสืบเนื่องจากการประชุมวิชาการระดับชาติ">บทคัดย่อตีพิมพ์ในเอกสารสืบเนื่องจากการประชุมวิชาการระดับชาติ รางวัลละไม่เกิน 1,000 บาท</option>
            </select>
          </div>
          <div class="form-group">
            <label for="approval">การเป็นผลงานที่ใช้ขออนุมัติสิ้นสุดสัญญาโครงการที่ได้รับทุนอุดหนุนการวิจัยจากคณะวิทยาศาสตร์</label>
            <select class="form-control" name="approval">
                <option value="กรณีที่ 1 ไม่เป็น (ได้รับการสนับสนุนเต็มจำนวน)">กรณีที่ 1 ไม่เป็น (ได้รับการสนับสนุนเต็มจำนวน)</option>
                <option value="กรณีที่ 2 เป็น (ได้รับการสนับสนุน 20% ของเงินรางวัลที่กำหนด)">กรณีที่ 2 เป็น (ได้รับการสนับสนุน 20% ของเงินรางวัลที่กำหนด)</option>
            </select>
          </div>
          <div class="form-group">
            <label for="participation">การมีส่วนร่วมในผลงาน</label>
            <select class="form-control" name="participation">
                <option value="กรณีที่ 1 First Author">กรณีที่ 1 First Author (ได้รับการสนับสนุนเต็มจำนวน)</option>
                <option value="กรณีที่ 1 Corresponding Author">กรณีที่ 1 Corresponding Author (ได้รับการสนับสนุนเต็มจำนวน)</option>
                <option value="กรณีที่ 2 เป็นผู้ร่วมเขียน">กรณีที่ 2 เป็นผู้ร่วมเขียน (ได้รับการสนับสนุนกึ่งหนึ่งของเงินรางวัลที่ได้รับจากหัวข้อก่อนหน้า)</option>
            </select>
          </div>
          <div class="form-group">
            <label for="form_document">รูปแบบของเอกสารที่เผยแพร่</label>
            <select class="form-control selectpicker" name="form_document[]" multiple data-live-search="true">
                <option value="รูปเล่ม หรือ หนังสือ">รูปเล่ม หรือ หนังสือ</option>
                <option value="ซีดี">ซีดี</option>
                <option value="เว็บไซต์">เว็บไซต์</option>
            </select>
            <input type="text" class="form-control" placeholder="อื่นๆ กรุณาระบุ" name="other">
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
          <div class="form-group">
            <label for="proceeding_file">file</label>
            <input type="file" class="form-control" placeholder="Upload file" name="proceeding_file">
          </div>
          <button type="submit" class="btn btn-success">Done</button>
      </form>
    </div>
    <script>
      $(document).ready(function(){
        $('#selectpicker').selectpicker();
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
          $id=$_GET['id'];

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
          $other=$_POST['other'];
          // $certification=$_POST['certification'];
          $amount=$_POST['amount'];
          $amount_text=$_POST['amount_text'];
          $applicant=$_POST['applicant'];
          $head_of_department=$_POST['head_of_department'];
          $department_name=$_POST['department_name'];
          $type="scholarship_proceeding";
          $check_scholarship="true";

          $form_document_str='';
          foreach($form_document as $document){
            $form_document_str .= ($document.',');
          }
          $form_document_str .= $other;

          $sql = "UPDATE `scholarship_proceeding` SET `author`='$author', `department`='$department', `titleEN`='$titleEN', `titleTH`='$titleTH', `conference_name`='$conference_name', `place`='$place', `date`='$date', `type_of_document`='$type_of_document'
          , `type_of_publication`='$type_of_publication'
          , `approval`='$approval', `participation`='$participation', `form_document`='$form_document_str', `amount`='$amount', `amount_text`='$amount_text', `type`='$type', `check_scholarship`='$check_scholarship', `applicant`='$applicant', `head_of_department`='$head_of_department', `department_name`='$department_name' WHERE `scholarship_proceeding`.`id` = $id;";

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
