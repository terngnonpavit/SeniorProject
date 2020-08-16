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

  </head>
  <body>
    <?php require('navbar.php');?>
    <div class="jumbotron jumbotron-fluid">
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

            if($type=='books'){
              $city=$row['city'];
              $page=$row['page'];
              $publisher=$row['publisher'];

              echo "
              <div class='card'>
                <div class='card-body'>
                  <p><strong>title(TH):</strong> $titleTH </p>
                  <p><strong>title(EN):</strong> $titleEN </p>
                  <p><strong>author:</strong> $author </p>
                  <p><strong>date:</strong> $date </p>
                  <p><strong>city:</strong> $city </p>
                  <p><strong>page:</strong> $page </p>
                  <p><strong>publisher:</strong> $publisher </p>
                  <p><strong>type:</strong> $type </p>
                </div>
              </div>
              <br/>
              ";

            }
            else if($type=='journals'){
              $issue=$row['issue'];
              $pages=$row['pages'];
              $volume=$row['volume'];
              $article_title=$row['article_title'];

              echo "
              <div class='card'>
                <div class='card-body'>
                  <p><strong>title(TH):</strong> $titleTH </p>
                  <p><strong>title(EN):</strong> $titleEN </p>
                  <p><strong>author:</strong> $author </p>
                  <p><strong>date:</strong> $date </p>
                  <p><strong>issue:</strong> $issue </p>
                  <p><strong>pages:</strong> $pages </p>
                  <p><strong>volume:</strong> $volume </p>
                  <p><strong>article_title:</strong> $article_title </p>
                  <p><strong>type:</strong> $type </p>
                </div>
              </div>
              <br/>
              ";
            }
            else if($type=='proceedings'){
              $place=$row['place'];
              $titleConference=$row['titleConference'];

              echo "
              <div class='card'>
                <div class='card-body'>
                  <p><strong>title(TH):</strong> $titleTH </p>
                  <p><strong>title(EN):</strong> $titleEN </p>
                  <p><strong>author:</strong> $author </p>
                  <p><strong>date:</strong> $date </p>
                  <p><strong>place:</strong> $place </p>
                  <p><strong>titleConference:</strong> $titleConference </p>
                  <p><strong>type:</strong> $type </p>
                </div>
              </div>
              <br/>
              ";
            }

          }
        }
        else {
          echo "We were unable to find results.";
        }
