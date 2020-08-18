<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <title>login</title>
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
    <div class="container col-4">
      <form action="check.php" method="post">
          <div class="form-group">
            <label for="Username">Username:</label>
            <input type="text" class="form-control" placeholder="Enter username" name="username">
          </div>
          <div class="form-group">
            <label for="Password">Password:</label>
            <input type="password" class="form-control" placeholder="Enter password" name="password">
          </div>
          <!-- <div class="form-group form-check">
            <label class="form-check-label">
              <input class="form-check-input" type="checkbox"> Remember me
            </label>
          </div> -->
            <button type="submit" class="btn btn-success">login</button>
      </form>
    </div>
    </body>
