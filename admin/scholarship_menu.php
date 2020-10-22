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
      <!-- file type -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>

  <body>
    <?php require('../navbar.php');?>

    <div class="container">
      <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" data-toggle="tab" href="#books">Books</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-toggle="tab" href="#journals">Journals</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-toggle="tab" href="#proceedings">Proceedings</a>
        </li>
      </ul>

      <!-- Tab panes -->
      <div class="tab-content">
        <div id="books" class="container tab-pane active"><br>
          <h3>
            ขอทุนวิจัยการเขียนตำรา
            <a href="scholarship_book.php" class="btn btn-success">Create</a>
          </h3>
          <?php require('admin_scholarship_book.php');?>
        </div>
        <div id="journals" class="container tab-pane fade"><br>
          <h3>
            ขอทุนวิจัยการตีพิมพ์ในวารสารทางวิชาการ
            <a href="scholarship_journal.php" class="btn btn-success">Create</a>
          </h3>
          <?php require('admin_scholarship_journal.php');?>
        </div>
        <div id="proceedings" class="container tab-pane fade"><br>
          <h3>
            ขอทุนวิจัยการตีพิมพ์ในเอกสารสืบเนื่องจาการประชุมวิชาการ
            <a href="scholarship_proceeding.php" class="btn btn-success">Create</a>
          </h3>
          <?php require('admin_scholarship_proceeding.php');?>
        </div>
      </div>
    </div>


  </body>
</html>
