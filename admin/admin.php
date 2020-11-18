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
      <!-- Nav tabs -->
      <ul class="nav nav-tabs" role="tablist">
        <!-- <li class="nav-item">
          <a class="nav-link active text-success" data-toggle="tab" href="#books">Books</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-info" data-toggle="tab" href="#journals">Journals</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-primary" data-toggle="tab" href="#proceedings">Proceedings</a>
        </li> -->
        <li class="nav-item">
          <a class="nav-link active text-success" data-toggle="tab" href="#scholarship_book">ตำรา(Book)</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-info" data-toggle="tab" href="#scholarship_journal">วารสารทางวิชาการ(Journal)</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-primary" data-toggle="tab" href="#scholarship_proceeding">เอกสารจากการประชุมวิชาการ(Proceeding)</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark" data-toggle="tab" href="#teacher">อาจารย์(Teacher)</a>
        </li>
      </ul>

      <!-- Tab panes -->
      <div class="tab-content">
        <!-- <div id="books" class="container tab-pane active"><br>
          <h3>
            Books
            <a href="create_books.php" class="btn btn-success">Create</a>
          </h3>
          <?php //require('admin_books.php');?>
        </div>
        <div id="journals" class="container tab-pane fade"><br>
          <h3>
            Journals
            <a href="create_journals.php" class="btn btn-info">Create</a>
          </h3>
          <?php //require('admin_journals.php');?>
        </div>
        <div id="proceedings" class="container tab-pane fade"><br>
          <h3>
            Proceedings
            <a href="create_proceedings.php" class="btn btn-primary">Create</a>
          </h3>
          <?php //require('admin_proceedings.php');?>
        </div> -->
        <div id="scholarship_book" class="container tab-pane active"><br>
          <h3>
            ตำรา(Book)
            <a href="create_books.php" class="btn btn-success">Create</a>
          </h3>
          <div class='row row-cols-2'>
            <?php require('admin_scholarship_book.php');?>
          </div>
        </div>
        <div id="scholarship_journal" class="container tab-pane fade"><br>
          <h3>
            วารสารทางวิชาการ(Journal)
            <a href="create_journals.php" class="btn btn-info">Create</a>
          </h3>
          <?php require('admin_scholarship_journal.php');?>
        </div>
        <div id="scholarship_proceeding" class="container tab-pane fade"><br>
          <h3>
            เอกสารจากการประชุมวิชาการ(Proceeding)
            <a href="scholarship_proceeding.php" class="btn btn-primary">Create</a>
          </h3>
          <?php require('admin_scholarship_proceeding.php');?>
        </div>
        <div id="teacher" class="container tab-pane fade"><br>
          <h3>
            อาจารย์(Teacher)
            <a href="create_teacher.php" class="btn btn-dark">Create</a>
          </h3>
          <?php require('admin_teacher.php');?>
        </div>
      </div>
    </div>


  </body>
</html>
