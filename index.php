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
      <form class="form-inline" action="searching.php" method="post">
          <select class="form-control" name="type">
              <option value="ทุกประเภท">ทุกประเภท/All</option>
              <option value="เอกสารประกอบการสอน">เอกสารประกอบการสอน</option>
              <option value="เอกสารคำสอน">เอกสารคำสอน</option>
              <option value="บทความทางวิชาการ">บทความทางวิชาการ/Articles</option>
              <option value="ตำรา">ตำรา</option>
              <option value="หนังสือ">หนังสือ/Books</option>
              <option value="งานวิจัย">งานวิจัย/Research</option>
              <option value="วารสารทางวิชาการ">วารสารทางวิชาการ/Journals</option>
              <option value="เอกสารจากการประชุมวิชาการ">เอกสารจากการประชุมวิชาการ/Proceedings</option>
          </select>


          <input class="form-control" type="text" placeholder="Search" name="search">


          <button type="submit" class="btn btn-success"> <i class="fas fa-search"></i> ค้นหา</button>
      </form>
    </div>


  </body>
</html>
