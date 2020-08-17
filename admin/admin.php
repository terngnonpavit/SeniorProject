<?php
// Start the session
session_start();
if(!isset($_SESSION["login_status"]) || $_SESSION["login_status"] == False ){
    header('Location: login.php');
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

    <div class="container">
      <!-- Nav tabs -->
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
            Books
            <a href="create_books.php" class="btn btn-success">Create</a>
          </h3>
          <?php require('admin_books.php');?>
        </div>
        <div id="journals" class="container tab-pane fade"><br>
          <h3>
            Journals
            <a href="create_journals.php" class="btn btn-success">Create</a>
          </h3>
          <?php require('admin_journals.php');?>
        </div>
        <div id="proceedings" class="container tab-pane fade"><br>
          <h3>
            Proceedings
            <a href="#" class="btn btn-success">Create</a>
          </h3>
          <?php require('admin_proceedings.php');?>
        </div>
      </div>
    </div>


  </body>
</html>