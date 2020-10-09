<?php
// Start the session
session_start();
if(!isset($_SESSION["login_status"]) || $_SESSION["login_status"] == False ){
    header('Location: http://localhost/seniorproject/login.php');}
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
      $sql = "SELECT * FROM `proceedings` WHERE `id`=$id";
      $result = $conn->query($sql);
      $row = $result->fetch_assoc();
      $titleTH=$row['titleTH'];
      $titleEN=$row['titleEN'];
      $author=$row['author'];
      $titleConference=$row['titleConference'];
      $date=$row['date'];
      $place=$row['place'];

      $conn->close();
    ?>

    <div class="container">
      <form action='<?php echo "http://localhost/seniorproject/admin/edit_proceeding.php/?id=$id"?>' method="post" enctype="multipart/form-data">
          <div class="form-group">
            <label for="titleTH">title(TH)</label>
            <input type="text" class="form-control" placeholder="Enter title(TH)" name="titleTH" value="<?php echo $titleTH; ?>">
          </div>
          <div class="form-group">
            <label for="titleEN">title(EN)</label>
            <input type="text" class="form-control" placeholder="Enter title(EN)" name="titleEN" value="<?php echo $titleEN; ?>">
          </div>
          <div class="form-group">
            <label for="author">author</label>
            <input type="text" class="form-control" placeholder="Enter author" name="author" value="<?php echo $author; ?>">
          </div>
          <div class="form-group">
            <label for="titleConference">titleConference</label>
            <input type="text" class="form-control" placeholder="Enter titleConference" name="titleConference" value="<?php echo $titleConference; ?>">
          </div>
          <div class="form-group">
            <label for="date">date</label>
            <input type="text" class="form-control" placeholder="Enter date" name="date" value="<?php echo $date; ?>">
          </div>
          <div class="form-group">
            <label for="place">place</label>
            <input type="text" class="form-control" placeholder="Enter place" name="place" value="<?php echo $place; ?>">
          </div>
          <div class="form-group">
            <label for="proceeding_file">file</label>
            <input type="file" class="form-control" placeholder="Upload file" name="proceeding_file">
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
         isset($_POST['author']) && $_POST['author'] != '' &&
         isset($_POST['titleConference']) && $_POST['titleConference'] != '' &&
         isset($_POST['date']) && $_POST['date'] != '' &&
         isset($_POST['place']) && $_POST['place'] != '')
        {
          $id=$_GET['id'];

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
          $titleConference=$_POST['titleConference'];
          $date=$_POST['date'];
          $place=$_POST['place'];
          $type="proceedings";
          $file_path="http://localhost/seniorproject/uploads/". basename($_FILES['proceeding_file']['name']);

          $sql = "UPDATE `proceedings` SET `titleEN` = '$titleEN', `author` = '$author', `titleTH` = '$titleTH', `date` = '$date', `place` = '$place', `titleConference` = '$titleConference' WHERE `proceedings`.`id` = $id;";
          if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
            // header('Location: http://localhost/seniorproject/admin/admin.php');
            echo "<script type='text/javascript'>window.location.href='http://localhost/seniorproject/admin/admin.php'</script>";
          } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
          }
        }
        $conn->close();
      ?>


  </body>
</html>
