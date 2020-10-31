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
      $author=$row['author'];
      $department=$row['department'];
      $titleTH=$row['titleTH'];
      $titleEN=$row['titleEN'];
      $conference_name=$row['conference_name'];
      $place_and_date=$row['place_and_date'];
      $type_of_document=$row['type_of_document'];
      $type_of_publication=$row['type_of_publication'];
      $approval=$row['approval'];
      $participation=$row['participation'];
      $form_document=$row['form_document'];
      // $certification=$row['certification'];
      $amount=$row['amount'];
      $amount_text=$row['amount_text'];
      $applicant=$row['applicant'];
      $head_of_department=$row['head_of_department'];
      $department_name=$row['department_name'];

      $conn->close();
      $temp=explode(',',$form_document);
      $other=end($temp);
    ?>

        <div class="container">
          <form action='<?php echo "http://localhost/seniorproject/admin/edit_scholarship_proceeding.php/?id=$id"?>' method="post" enctype="multipart/form-data">
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
              <label for="place_and_date">สถานที่ วันเดือนปี ที่จัด</label>
              <input type="text" class="form-control" placeholder="กรุณากรอกสถานที่ วันเดือนปี ที่จัด" name="place_and_date" value="<?php echo $place_and_date; ?>">
            </div>
            <div class="form-group">
              <label for="type_of_document">ประเภทของผลงาน</label>
              <select class="form-control" name="type_of_document">
                  <option value="research_article" <?php if($type_of_document=="research_article") echo 'selected'?>>Research Article</option>
                  <option value="review_article" <?php if($type_of_document=="review_article") echo 'selected'?>>Review Article</option>
                  <option value="abstract" <?php if($type_of_document=="abstract") echo 'selected'?>>Abstract</option>
              </select>
            </div>
            <div class="form-group">
              <label for="type_of_publication">ประเภทของการตีพิมพ์และการประชุมวิชาการ(เลือกเพียง 1 ประเภท)</label>
              <select class="form-control" name="type_of_publication">
                  <option value="Proceedings ตีพิมพ์ในเอกสารสืบเนื่องจาการประชุมวิชาการระดับนานาชาติ" <?php if($type_of_publication=="Proceedings ตีพิมพ์ในเอกสารสืบเนื่องจาการประชุมวิชาการระดับนานาชาติ") echo 'selected'?>>Proceedings ตีพิมพ์ในเอกสารสืบเนื่องจาการประชุมวิชาการระดับนานาชาติ รางวัลละไม่เกิน 3,000 บาท</option>
                  <option value="Proceedings ตีพิมพ์ในเอกสารสืบเนื่องจาการประชุมวิชาการระดับชาติ" <?php if($type_of_publication=="Proceedings ตีพิมพ์ในเอกสารสืบเนื่องจาการประชุมวิชาการระดับชาติ") echo 'selected'?>>Proceedings ตีพิมพ์ในเอกสารสืบเนื่องจาการประชุมวิชาการระดับชาติ รางวัลละไม่เกิน 2,000 บาท</option>
                  <option value="บทคัดย่อตีพิมพ์ในเอกสารสืบเนื่องจากการประชุมวิชาการระดับนานาชาติ" <?php if($type_of_publication=="บทคัดย่อตีพิมพ์ในเอกสารสืบเนื่องจากการประชุมวิชาการระดับนานาชาติ") echo 'selected'?>>บทคัดย่อตีพิมพ์ในเอกสารสืบเนื่องจากการประชุมวิชาการระดับนานาชาต รางวัลละไม่เกิน 1,500 บาท</option>
                  <option value="บทคัดย่อตีพิมพ์ในเอกสารสืบเนื่องจากการประชุมวิชาการระดับชาติ" <?php if($type_of_publication=="บทคัดย่อตีพิมพ์ในเอกสารสืบเนื่องจากการประชุมวิชาการระดับชาติ") echo 'selected'?>>บทคัดย่อตีพิมพ์ในเอกสารสืบเนื่องจากการประชุมวิชาการระดับชาติ รางวัลละไม่เกิน 1,000 บาท</option>
              </select>
            </div>
            <div class="form-group">
              <label for="approval">การเป็นผลงานที่ใช้ขออนุมัติสิ้นสุดสัญญาโครงการที่ได้รับทุนอุดหนุนการวิจัยจากคณะวิทยาศาสตร์</label>
              <select class="form-control" name="approval">
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
              <label for="form_document">รูปแบบของเอกสารที่เผยแพร่</label>
              <select class="form-control selectpicker" name="form_document[]" multiple data-live-search="true">
                  <option value="รูปเล่ม หรือ หนังสือ" <?php if(strpos($form_document,"รูปเล่ม หรือ หนังสือ")!==false) echo 'selected'?>>รูปเล่ม หรือ หนังสือ</option>
                  <option value="ซีดี" <?php if(strpos($form_document,"ซีดี")!==false) echo 'selected'?>>ซีดี</option>
                  <option value="เว็บไซต์" <?php if(strpos($form_document,"เว็บไซต์")!==false) echo 'selected'?>>เว็บไซต์</option>
              </select>
              <input type="text" class="form-control" placeholder="อื่นๆ กรุณาระบุ" name="other" value="<?php echo $other; ?>">
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
          $place_and_date=$_POST['place_and_date'];
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

          $form_document_str='';
          foreach($form_document as $document){
            $form_document_str .= ($document.',');
          }
          $form_document_str .= $other;

          $sql = "UPDATE `scholarship_proceeding` SET `author`='$author', `department`='$department', `titleEN`='$titleEN', `titleTH`='$titleTH', `conference_name`='$conference_name', `place_and_date`='$place_and_date', `type_of_document`='$type_of_document'
          , `type_of_publication`='$type_of_publication'
          , `approval`='$approval', `participation`='$participation', `form_document`='$form_document_str', `amount`='$amount', `amount_text`='$amount_text' WHERE `scholarship_proceeding`.`id` = $id;";

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
