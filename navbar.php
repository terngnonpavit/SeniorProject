<nav class="navbar navbar-expand-md bg-dark navbar-dark">
  <!-- Brand -->
  <a class="navbar-brand" href="http://localhost/seniorproject/index.php">
    <!-- <img src="http://localhost/seniorproject/images/SC-SU-Logo-ENG.png" style="height:30px; width:20px"> -->
    CPSU <i class="fas fa-search"></i>
  </a>
    <!-- Toggler/collapsibe Button -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
  <span class="navbar-toggler-icon"></span>
  </button>


  <div class="collapse navbar-collapse justify-content-end" id="collapsibleNavbar">
    <div class="navbar-nav">
      <?php
      if(!isset($_SESSION["login_status"]) || $_SESSION["login_status"] == False ){
        echo '<a class="btn btn-success" href="http://localhost/seniorproject/login.php"><i class="fas fa-user-circle"></i> Login</a>';
      }
      else{
        echo '
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="http://localhost/seniorproject/admin/admin.php">Admin</a>
          </li>
        </ul>
        ';
        echo '<a class="btn btn-danger" href="http://localhost/seniorproject/logout.php"><i class="fas fa-user-circle"></i> Logout</a>';
      }
      ?>

      <!-- <a class="btn btn-success" href="login.php"><i class="fas fa-user-circle"></i> login</a> -->
    </div>

  </div>
</nav>
