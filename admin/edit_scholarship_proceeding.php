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
      $place=$row['place'];
      $date=$row['date'];
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
      $temp=explode(',',$form_document);
      $other=end($temp);
    ?>

      <div class="container">
        <form action='<?php echo "http://localhost/seniorproject/admin/edit_scholarship_proceeding.php/?id=$id"?>' method="post" enctype="multipart/form-data">
          <div class='row'>
            <div class="form-group col-md-6">
              <label for="author"><strong>ชื่อผู้ขอรับการสนับสนุน</strong></label>
              <select class="form-control" name="author">
                <?php
                   foreach ($teacher_name as $name) {
                   if($author==$name){
                     echo "<option value='$name' selected>$name</option>";
                   }
                   else{
                     echo "<option value='$name'>$name</option>";
                   }
                 }
               ?>
             </select>
            </div>
            <div class="form-group col-md-6">
              <label for="department"><strong>สังกัด</strong></label>
              <input type="text" class="form-control" placeholder="กรุณาระบุสังกัด" name="department" value="<?php echo $department; ?>">
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
              <label for="conference_name"><strong>ชื่อการประชุมวิชาการ</strong></label>
              <input type="text" class="form-control" placeholder="กรุณากรอกชื่อการประชุมวิชาการ" name="conference_name" value="<?php echo $conference_name; ?>">
            </div>
          <div class='row'>
            <div class="form-group col-md-6">
              <label for="place"><strong>สถานที่จัด</strong></label>
              <input type="text" class="form-control" placeholder="กรุณากรอกสถานที่่จัด" name="place" value="<?php echo $place; ?>">
            </div>
            <div class="form-group">
              <label for="date"><strong>วัน/เดือน/ปี ที่จัด<strong></label>
              <input type="text" class="form-control" placeholder="กรุณากรอกวันเดือนปี ที่จัด" name="date" value="<?php echo $date; ?>">
            </div>
          </div>
            <br>
            <br>
            <hr>
          <div class='row'>
            <div class="form-group col-md-6">
              <label for="type_of_document"><strong>ประเภทของผลงาน</strong></label>
              <select class="form-control" name="type_of_document" value="<?php echo $type_of_document; ?>">
                  <option value="research_article" <?php if($type_of_document=="research_article") echo 'selected'?>>Research Article</option>
                  <option value="review_article" <?php if($type_of_document=="review_article") echo 'selected'?>>Review Article</option>
                  <option value="abstract" <?php if($type_of_document=="abstract") echo 'selected'?>>Abstract</option>
              </select>
            </div>
            <div class="form-group col-md-6">
              <label for="type_of_publication"><strong>ประเภทของการตีพิมพ์และการประชุมวิชาการ(เลือกเพียง 1 ประเภท)</strong></label>
              <select class="form-control" name="type_of_publication">
                  <option value="Proceedings ตีพิมพ์ในเอกสารสืบเนื่องจาการประชุมวิชาการระดับนานาชาติ" <?php if($type_of_publication=="Proceedings ตีพิมพ์ในเอกสารสืบเนื่องจาการประชุมวิชาการระดับนานาชาติ") echo 'selected'?>>Proceedings ตีพิมพ์ในเอกสารสืบเนื่องจาการประชุมวิชาการระดับนานาชาติ รางวัลละไม่เกิน 3,000 บาท</option>
                  <option value="Proceedings ตีพิมพ์ในเอกสารสืบเนื่องจาการประชุมวิชาการระดับชาติ" <?php if($type_of_publication=="Proceedings ตีพิมพ์ในเอกสารสืบเนื่องจาการประชุมวิชาการระดับชาติ") echo 'selected'?>>Proceedings ตีพิมพ์ในเอกสารสืบเนื่องจาการประชุมวิชาการระดับชาติ รางวัลละไม่เกิน 2,000 บาท</option>
                  <option value="บทคัดย่อตีพิมพ์ในเอกสารสืบเนื่องจากการประชุมวิชาการระดับนานาชาติ" <?php if($type_of_publication=="บทคัดย่อตีพิมพ์ในเอกสารสืบเนื่องจากการประชุมวิชาการระดับนานาชาติ") echo 'selected'?>>บทคัดย่อตีพิมพ์ในเอกสารสืบเนื่องจากการประชุมวิชาการระดับนานาชาต รางวัลละไม่เกิน 1,500 บาท</option>
                  <option value="บทคัดย่อตีพิมพ์ในเอกสารสืบเนื่องจากการประชุมวิชาการระดับชาติ" <?php if($type_of_publication=="บทคัดย่อตีพิมพ์ในเอกสารสืบเนื่องจากการประชุมวิชาการระดับชาติ") echo 'selected'?>>บทคัดย่อตีพิมพ์ในเอกสารสืบเนื่องจากการประชุมวิชาการระดับชาติ รางวัลละไม่เกิน 1,000 บาท</option>
              </select>
            </div>
          </div>
          <div class='row'>
            <div class="form-group col-md-8">
              <label for="approval"><strong>การเป็นผลงานที่ใช้ขออนุมัติสิ้นสุดสัญญาโครงการที่ได้รับทุนอุดหนุนการวิจัยจากคณะวิทยาศาสตร์</strong></label>
              <select class="form-control" name="approval">
                  <option value="กรณีที่ 1 ไม่เป็น (ได้รับการสนับสนุนเต็มจำนวน)" <?php if($approval=="กรณีที่ 1 ไม่เป็น (ได้รับการสนับสนุนเต็มจำนวน)") echo 'selected'?>>กรณีที่ 1 ไม่เป็น (ได้รับการสนับสนุนเต็มจำนวน)</option>
                  <option value="กรณีที่ 2 เป็น (ได้รับการสนับสนุน 20% ของเงินรางวัลที่กำหนด)" <?php if($approval=="กรณีที่ 2 เป็น (ได้รับการสนับสนุน 20% ของเงินรางวัลที่กำหนด)") echo 'selected'?>>กรณีที่ 2 เป็น (ได้รับการสนับสนุน 20% ของเงินรางวัลที่กำหนด)</option>
              </select>
            </div>
            <div class="form-group col-md-4">
              <label for="participation"><strong>การมีส่วนร่วมในผลงาน</strong></label>
              <select class="form-control" name="participation">
                  <option value="กรณีที่ 1 First Author" <?php if($participation=="กรณีที่ 1 First Author") echo 'selected'?>>กรณีที่ 1 First Author (ได้รับการสนับสนุนเต็มจำนวน)</option>
                  <option value="กรณีที่ 1 Corresponding Author" <?php if($participation=="กรณีที่ 1 Corresponding Author") echo 'selected'?>>กรณีที่ 1 Corresponding Author (ได้รับการสนับสนุนเต็มจำนวน)</option>
                  <option value="กรณีที่ 2 เป็นผู้ร่วมเขียน" <?php if($participation=="กรณีที่ 2 เป็นผู้ร่วมเขียน") echo 'selected'?>>กรณีที่ 2 เป็นผู้ร่วมเขียน (ได้รับการสนับสนุนกึ่งหนึ่งของเงินรางวัลที่ได้รับจากหัวข้อก่อนหน้า)</option>
              </select>
            </div>
          </div>
            <div class="form-group">
              <label for="form_document"><strong>รูปแบบของเอกสารที่เผยแพร่</strong></label>
              <select class="form-control selectpicker" name="form_document[]" multiple data-live-search="true">
                  <option value="รูปเล่ม หรือ หนังสือ" <?php if(strpos($form_document,"รูปเล่ม หรือ หนังสือ")!==false) echo 'selected'?>>รูปเล่ม หรือ หนังสือ</option>
                  <option value="ซีดี" <?php if(strpos($form_document,"ซีดี")!==false) echo 'selected'?>>ซีดี</option>
                  <option value="เว็บไซต์" <?php if(strpos($form_document,"เว็บไซต์")!==false) echo 'selected'?>>เว็บไซต์</option>
              </select>
              <input type="text" class="form-control" placeholder="อื่นๆ กรุณาระบุ" name="other" value="<?php echo $other; ?>">
            </div>
          <div class='row'>
            <div class="form-group col-md-6">
              <label for="amount"><strong>จำนวนเงินทุนที่ขอรับการสนับสนุน(ตัวเลข)</strong></label>
              <select class="form-control" name="amount">
                  <option value="Proceedings ตีพิมพ์ในเอกสารสืบเนื่องจาการประชุมวิชาการระดับนานาชาติ" <?php if($amount=="Proceedings ตีพิมพ์ในเอกสารสืบเนื่องจาการประชุมวิชาการระดับนานาชาติ") echo 'selected'?>>3,000 บาท</option>
                  <option value="Proceedings ตีพิมพ์ในเอกสารสืบเนื่องจาการประชุมวิชาการระดับชาติ" <?php if($amount=="Proceedings ตีพิมพ์ในเอกสารสืบเนื่องจาการประชุมวิชาการระดับชาติ") echo 'selected'?>>2,000 บาท</option>
                  <option value="บทคัดย่อตีพิมพ์ในเอกสารสืบเนื่องจากการประชุมวิชาการระดับนานาชาติ" <?php if($amount=="บทคัดย่อตีพิมพ์ในเอกสารสืบเนื่องจากการประชุมวิชาการระดับนานาชาต") echo 'selected'?>>1,500 บาท</option>
                  <option value="บทคัดย่อตีพิมพ์ในเอกสารสืบเนื่องจากการประชุมวิชาการระดับชาติ" <?php if($amount=="บทคัดย่อตีพิมพ์ในเอกสารสืบเนื่องจากการประชุมวิชาการระดับชาติ") echo 'selected'?>>1,000 บาท</option>
              </select>
            </div>
            <div class="form-group col-md-6">
              <label for="amount_text"><strong>จำนวนเงินทุนที่ขอรับการสนับสนุน(ข้อความ)</strong></label>
              <select class="form-control" name="amount_text">
                  <option value="Proceedings ตีพิมพ์ในเอกสารสืบเนื่องจาการประชุมวิชาการระดับนานาชาติ" <?php if($amount_text=="Proceedings ตีพิมพ์ในเอกสารสืบเนื่องจาการประชุมวิชาการระดับนานาชาติ") echo 'selected'?>>สามพันบาทถ้วน</option>
                  <option value="Proceedings ตีพิมพ์ในเอกสารสืบเนื่องจาการประชุมวิชาการระดับชาติ" <?php if($amount_text=="Proceedings ตีพิมพ์ในเอกสารสืบเนื่องจาการประชุมวิชาการระดับชาติ") echo 'selected'?>>สองพันบาทถ้วน</option>
                  <option value="บทคัดย่อตีพิมพ์ในเอกสารสืบเนื่องจากการประชุมวิชาการระดับนานาชาติ" <?php if($amount_text=="บทคัดย่อตีพิมพ์ในเอกสารสืบเนื่องจากการประชุมวิชาการระดับนานาชาติ") echo 'selected'?>>หนึ่งพันห้าร้อยบาทถ้วน</option>
                  <option value="บทคัดย่อตีพิมพ์ในเอกสารสืบเนื่องจากการประชุมวิชาการระดับชาติ" <?php if($amount_text=="บทคัดย่อตีพิมพ์ในเอกสารสืบเนื่องจากการประชุมวิชาการระดับชาติ") echo 'selected'?>>หนึ่งพันบาทถ้วน</option>
              </select>
            </div>
          </div>
          <div class='row'>
            <div class="form-group col-md-4">
              <label for="applicant"><strong>ลงชื่อผู้ขอรับการสนับสนุน</strong></label>
              <select class="form-control" name="applicant">
              <?php
                foreach ($teacher_name as $name) {
                  if($applicant==$name){
                    echo "<option value='$name' selected>$name</option>";
                  }
                  else{
                    echo "<option value='$name'>$name</option>";
                  }
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
              <input type="text" class="form-control" placeholder="กรุณาระบุสังกัดภาควิชา" name="department_name" value="คอมพิวเตอร์">
            </div>
            <div class="form-group">
              <label for="proceeding_file">อัพโหลดไฟล์</label>
              <input type="file" class="form-control" placeholder="Upload file" name="proceeding_file">
            </div>
            <button type="submit" class="btn btn-success btn-block">ยืนยัน</button>
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

          $targetfolder = "C:\\xampp\\htdocs\\SeniorProject\\uploads\\";
          $targetfolder = $targetfolder . basename( $_FILES['proceeding_file']['name']) ;
          $file_path='';
          if(move_uploaded_file($_FILES['proceeding_file']['tmp_name'], $targetfolder))
          {
            echo "The file " . basename($_FILES['proceeding_file']['name']) . " is uploaded";
            $file_path="http://localhost/seniorproject/uploads/". basename($_FILES['proceeding_file']['name']);
          }

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

          $form_document_str='';
          foreach($form_document as $document){
            $form_document_str .= ($document.',');
          }
          $form_document_str .= $other;

          $sql = "UPDATE `scholarship_proceeding` SET `author`='$author', `department`='$department', `titleEN`='$titleEN', `titleTH`='$titleTH', `conference_name`='$conference_name', `place`='$place', `date`='$date', `type_of_document`='$type_of_document'
          , `type_of_publication`='$type_of_publication'
          , `approval`='$approval', `participation`='$participation', `form_document`='$form_document_str', `amount`='$amount', `amount_text`='$amount_text', `type`='$type', `file_path`='$file_path', `applicant`='$applicant', `head_of_department`='$head_of_department', `department_name`='$department_name' WHERE `scholarship_proceeding`.`id` = $id;";

          if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
            echo '<script language="javascript">';
            echo 'alert("แก้ไขเอกสารจาการประชุมวิชาการเสร็จสมบูรณ์")';
            echo '</script>';
            echo "<script type='text/javascript'>window.location.href='http://localhost/seniorproject/admin/admin.php'</script>";
          } else {
            echo '<script language="javascript">';
            echo 'alert("แก้ไข proceeding ไม่สำเร็จ")';
            echo '</script>';
            // echo "Error: " . $sql . "<br>" . $conn->error;
          }
        }
        $conn->close();
      ?>

  </body>
</html>
