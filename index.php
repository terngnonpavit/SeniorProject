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
    <nav class="navbar navbar-expand-md bg-dark navbar-dark">
      <!-- Brand -->
      <a class="navbar-brand" href="#">CPSU</a>
        <!-- Toggler/collapsibe Button -->
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
      <span class="navbar-toggler-icon"></span>
      </button>


      <div class="collapse navbar-collapse justify-content-end" id="collapsibleNavbar">
        <div class="navbar-nav">
          <!-- <button type="button" class="btn btn-success"> <i class="fas fa-user-circle"></i> login</button> -->
          <a class="btn btn-success" href="login.html"><i class="fas fa-user-circle"></i> login</a>
        </div>
          <ul class="navbar-nav">

            <!-- <li class="nav-item">
              <a class="nav-link" href="#">Link</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Link</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Link</a>
            </li> -->
          </ul>
      </div>
    </nav>
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
              <option value="ตำรา">ตำรา/Treatises</option>
              <option value="หนังสือ">หนังสือ/Books</option>
              <option value="งานวิจัย">งานวิจัย/Research</option>
              <option value="วารสารทางวิชาการ">วารสารทางวิชาการ/Journals</option>
              <option value="รายงานการประชุมวิชาการ">รายงานการประชุมวิชาการ/Conference Proceedings</option>
          </select>


          <input class="form-control" type="text" placeholder="Search.." name="search">


          <button type="submit" class="btn btn-success"> <i class="fas fa-search"></i> ค้นหา</button>
      </form>
    </div>


  </body>
</html>
