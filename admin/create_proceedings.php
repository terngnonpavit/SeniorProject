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
        <form action="create_proceedings.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
              <label for="titleTH">title(TH)</label>
              <input type="text" class="form-control" placeholder="Enter title(TH)" name="titleTH">
            </div>
            <div class="form-group">
              <label for="titleEN">title(EN)</label>
              <input type="text" class="form-control" placeholder="Enter title(EN)" name="titleEN">
            </div>
            <div class="form-group">
              <label for="author">author</label>
              <input type="text" class="form-control" placeholder="Enter author" name="author">
            </div>
            <div class="form-group">
              <label for="conference_name">conference name</label>
              <input type="text" class="form-control" placeholder="Enter conference name" name="conference_name">
            </div>
            <div class="form-group">
              <label for="date">date</label>
              <input type="text" class="form-control" placeholder="Enter date" name="date">
            </div>
            <div class="form-group">
              <label for="place">place</label>
              <input type="text" class="form-control" placeholder="Enter place" name="place">
            </div>
            <div class="form-group">
              <label for="proceeding_file">file</label>
              <input type="file" class="form-control" placeholder="Upload file" name="proceeding_file">
            </div>
            <button type="submit" class="btn btn-success">Done</button>
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
         isset($_POST['conference_name']) && $_POST['conference_name'] != '' &&
         isset($_POST['date']) && $_POST['date'] != '' &&
         isset($_POST['place']) && $_POST['place'] != '')
        {

          $targetfolder = "C:\\xampp\\htdocs\\SeniorProject\\uploads\\";
          $targetfolder = $targetfolder . basename( $_FILES['proceeding_file']['name']) ;

          if(move_uploaded_file($_FILES['proceeding_file']['tmp_name'], $targetfolder))
          {
            echo "The file " . basename($_FILES['proceeding_file']['name']) . " is uploaded";
          }
          else
          {
            echo "Problem uploading file" . basename($_FILES['proceeding_file']['name']);
          }

          $titleTH=$_POST['titleTH'];
          $titleEN=$_POST['titleEN'];
          $author=$_POST['author'];
          $conference_name=$_POST['conference_name'];
          $date=$_POST['date'];
          $place=$_POST['place'];
          $type="proceedings";
          $file_path="http://localhost/seniorproject/uploads/". basename($_FILES['proceeding_file']['name']);
          $check_scholarship="false";

          $sql = "INSERT INTO `scholarship_proceeding` (`titleEN`, `author`, `id`, `type`, `titleTH`, `date`, `place`, `conference_name`, `file_path`, `check_scholarship`)
                  VALUES ('$titleEN', '$author', NULL, '$type', '$titleTH', '$date', '$place', '$conference_name', '$file_path', '$check_scholarship')";

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
