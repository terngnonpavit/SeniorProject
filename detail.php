<?php session_start(); ?>

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
    <?php require('navbar.php');?>
      <div class="jumbotron jumbotron-fluid text-white" style="background-image: url(http://localhost/seniorproject/images/coverimage5.jpg); background-size: cover; height: 50%">
      <div class="container">
        <h1>CPSU Management of Lecture’s Academic publication</h1>
        <p>เว็บแอปพลิเคชันจัดการผลงานวิชาการคณาจารย์ ภาควิชาคอมพิวเตอร์ มหาวิทยาลัยศิลปากร</p>
      </div>
    </div>
    <div class="container">

      <!-- include -->
      <?php require('form.php');?>
      <br/>
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
        // echo $id;
        $type=$_GET['type'];
        // echo $type;

        $sql = "select * from $type where id=$id";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
          while($row = $result->fetch_assoc())  {
            $titleTH=$row['titleTH'];
            $titleEN=$row['titleEN'];
            $author=$row['author'];
            $date=$row['date'];
            $type=$row['type'];

            if($type=='scholarship_book'){
                $page_amount=$row['page_amount'];
                $publisher=$row['publisher'];
                $date=$row['date'];

              echo "
              <div class='card'>
                <div class='card-body'>
                  <h3><strong></strong> $titleTH </h3>
                  <h4><strong></strong> $titleEN </h4><hr>
                  <p><strong>author:</strong> $author </p>
                  <p><strong>page:</strong> $page_amount </p>
                  <p><strong>publisher:</strong> $publisher </p>
                  <p><strong>date:</strong> $date </p>

                  <span class='badge badge-success'>Books</span>
                  <a class='btn btn-danger' href=''><i class='fa fa-file-pdf-o'></i> PDF</a>
                </div>
              </div>
              <br/>
              ";

            }
            else if($type=='scholarship_journal'){
              $journal_name=$row['journal_name'];
              $number=$row['number'];
              $volume=$row['volume'];
              $page=$row['page'];
              $date=$row['date'];

              echo "
              <div class='card'>
                <div class='card-body'>
                  <h3><strong></strong> $titleTH </h3>
                  <h4><strong></strong> $titleEN </h4><hr>
                  <p><strong>author:</strong> $author </p>
                  <p><strong>journal name:</strong> $journal_name </p>
                  <p><strong>number:</strong> $number </p>
                  <p><strong>volume:</strong> $volume </p>
                  <p><strong>page:</strong> $page </p>
                  <p><strong>date:</strong> $date </p>
                  <span class='badge badge-info'>Journals</span>
                  <a class='btn btn-danger' href=''><i class='fa fa-file-pdf-o'></i> PDF</a>
                </div>
              </div>
              <br/>
              ";
            }
            else if($type=='scholarship_proceeding'){
              $conference_name=$row['conference_name'];
              $date=$row['date'];
              $place=$row['place'];

              echo "
              <div class='card'>
                <div class='card-body'>
                  <h3><strong></strong> $titleTH </h3>
                  <h4><strong></strong> $titleEN </h4><hr>
                  <p><strong>author:</strong> $author </p>
                  <p><strong>conference name:</strong> $conference_name </p>
                  <p><strong>date:</strong> $date </p>
                  <p><strong>place:</strong> $place </p>

                  <span class='badge badge-primary'>Proceedings</span>
                  <a class='btn btn-danger' href=''><i class='fa fa-file-pdf-o'></i> PDF</a>
                </div>
              </div>
              <br/>
              ";
            }

          }
        }
        else {
          echo "No Results";
        }
