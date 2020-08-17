<nav class="navbar navbar-expand-md bg-dark navbar-dark">
  <!-- Brand -->
  <a class="navbar-brand" href="http://localhost/seniorproject/index.php">CPSU</a>
    <!-- Toggler/collapsibe Button -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
  <span class="navbar-toggler-icon"></span>
  </button>


  <div class="collapse navbar-collapse justify-content-end" id="collapsibleNavbar">
    <div class="navbar-nav">
      <!-- <button type="button" class="btn btn-success"> <i class="fas fa-user-circle"></i> login</button> -->
      <?php
      if(!isset($_SESSION["login_status"]) || $_SESSION["login_status"] == False ){
        echo '<a class="btn btn-success" href="http://localhost/seniorproject/login.php"><i class="fas fa-user-circle"></i> login</a>';
      }
      else{
        echo '<a class="btn btn-danger" href="http://localhost/seniorproject/logout.php"><i class="fas fa-user-circle"></i> logout</a>';
      }
      ?>

      <!-- <a class="btn btn-success" href="login.php"><i class="fas fa-user-circle"></i> login</a> -->
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
