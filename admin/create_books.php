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
    <link rel="stylesheet" href="../fm.tagator.jquery.css">
    <script src="../fm.tagator.jquery.js"></script>

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
      $sql = "SELECT * FROM teacher WHERE `status`='$active'";
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
      <br>
      <div>
        <form action="create_books.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
              <label for="titleTH"><strong>ชื่อผลงาน(ไทย)</strong></label>
              <input type="text" class="form-control" placeholder="ระบุชื่อผลงาน(ไทย)" name="titleTH">
            </div>
            <div class="form-group">
              <label for="titleEN"><strong>ชื่อผลงาน(อังกฤษ)</strong></label>
              <input type="text" class="form-control" placeholder="ระบุชื่อผลงาน(อังกฤษ)" name="titleEN">
            </div>
            <div class="row">
              <!-- <div class="form-group col-md-6">
                <label for="author"><strong>ผู้เขียน</strong></label>
                <select class="form-control" name="author">
                    <?php
                      // foreach ($teacher_name as $name) {
                      //   echo "<option value='$name'>$name</option>";
                      // }
                    ?>
                </select>
              </div> -->
              <!-- <div class="form-group col-md-6">
                <label for="author"><strong>ผู้เขียน</strong></label>
                <input type="text" class="form-control" placeholder="ระบุชื่อผู้เขียน" name="author">
              </div> -->
              <div class="form-group col-md-6">
                <label for="author"><strong>ผู้เขียน</strong></label>
                <input type="text" class="form-control" placeholder="ระบุผู้เขียน" name="author" id="author_tag">
              </div>
              <div class="form-group col-md-6">
                <label for="page"><strong>จำนวนหน้า</strong></label>
                <input type="text" class="form-control" placeholder="ระบุจำนวนหน้า" name="page">
              </div>
            </div>
            <div class="form-group">
              <label for="publisher"><strong>สำนักพิมพ์</strong></label>
              <input type="text" class="form-control" placeholder="ระบุสำนักพิมพ์" name="publisher">
            </div>
            <div class="row">
              <div class="form-group col-md-6">
                <label for="date"><strong>วัน/เดือน/ปีที่ตีพิมพ์</strong></label>
                <input type="text" class="form-control" placeholder="ระบุวัน/เดือน/ปีที่ตีพิมพ์" name="date">
              </div>
              <div class="form-group col-md-6">
                <label for="book_file"><strong>อัพโหลดไฟล์</strong></label>
                <input type="file" class="form-control" placeholder="อัพโหลดไฟล์" name="book_file">
              </div>
            </div>

            <button type="submit" class="btn btn-success btn-block">ยืนยัน</button>
        </form>
      </div>
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

      if(isset($_POST['titleTH']) && $_POST['titleTH'] != '' &&
         isset($_POST['titleEN']) && $_POST['titleEN'] != '' &&
         isset($_POST['author']) && $_POST['author'] != '' &&
         isset($_POST['page']) && $_POST['page'] != '' &&
         isset($_POST['publisher']) && $_POST['publisher'] != '' &&
         isset($_POST['date']) && $_POST['date'] != '')
        {


          $targetfolder = "C:\\xampp\\htdocs\\SeniorProject\\uploads\\";
          $targetfolder = $targetfolder . basename( $_FILES['book_file']['name']) ;
          $file_path = '';
          if(move_uploaded_file($_FILES['book_file']['tmp_name'], $targetfolder))
          {
            echo "The file " . basename($_FILES['book_file']['name']) . " is uploaded";
            $file_path="http://localhost/seniorproject/uploads/". basename($_FILES['book_file']['name']);
          }

          $titleTH=$_POST['titleTH'];
          $titleEN=$_POST['titleEN'];
          $author=$_POST['author'];
          $page=$_POST['page'];
          $publisher=$_POST['publisher'];
          $date=$_POST['date'];
          $type="scholarship_book";
          $check_scholarship="false";

          $sql = "INSERT INTO scholarship_book (author, date, titleTH, publisher, page_amount, titleEN, type, file_path, check_scholarship) VALUES ('$author', '$date', '$titleTH', '$publisher', '$page', '$titleEN', '$type', '$file_path', '$check_scholarship')";

          if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
            // header('Location: http://localhost/seniorproject/admin/admin.php');
            echo '<script language="javascript">';
            echo 'alert("กรอกข้อมูลสำเร็จแล้ว")';
            echo '</script>';
            echo "<script type='text/javascript'>window.location.href='http://localhost/seniorproject/admin/admin.php'</script>";
          } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
          }
        }
        $conn->close();
      ?>
  </body>
</html>
