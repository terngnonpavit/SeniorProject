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

    <div class="container">
      <form action="create_journals.php" method="post">
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
            <label for="article_title">article_title</label>
            <input type="text" class="form-control" placeholder="Enter article_title" name="article_title">
          </div>
          <div class="form-group">
            <label for="pages">pages</label>
            <input type="text" class="form-control" placeholder="Enter pages" name="pages">
          </div>
          <div class="form-group">
            <label for="volume">volume</label>
            <input type="text" class="form-control" placeholder="Enter volume" name="volume">
          </div>
          <div class="form-group">
            <label for="issue">issue</label>
            <input type="text" class="form-control" placeholder="Enter issue" name="issue">
          </div>
          <div class="form-group">
            <label for="date">date</label>
            <input type="text" class="form-control" placeholder="Enter date" name="date">
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
         isset($_POST['article_title']) && $_POST['article_title'] != '' &&
         isset($_POST['pages']) && $_POST['pages'] != '' &&
         isset($_POST['volume']) && $_POST['volume'] != '' &&
         isset($_POST['issue']) && $_POST['issue'] != '' &&
         isset($_POST['date']) && $_POST['date'] != '')
        {
          $titleTH=$_POST['titleTH'];
          $titleEN=$_POST['titleEN'];
          $author=$_POST['author'];
          $article_title=$_POST['article_title'];
          $pages=$_POST['pages'];
          $volume=$_POST['volume'];
          $date=$_POST['date'];
          $issue=$_POST['issue'];
          $type="journals";

          $sql = "INSERT INTO `journals` (`author`, `date`, `article_title`, `titleTH`, `volume`, `issue`, `pages`, `id`, `titleEN`, `type`)
                  VALUES ('$author', '$date', '$article_title', '$titleTH', '$volume', '$issue', '$pages', NULL, '$titleEN', '$type')";
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
