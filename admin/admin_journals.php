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
  $sql = "select * from journals";

  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    $no = 0;
    while($row = $result->fetch_assoc())  {
      $id=$row['id'];
      $titleTH=$row['titleTH'];
      $titleEN=$row['titleEN'];
      $author=$row['author'];
      $date=$row['date'];
      $type=$row['type'];
      $issue=$row['issue'];
      $pages=$row['pages'];
      $volume=$row['volume'];
      $article_title=$row['article_title'];
      $no++;

      echo "
      <div class='card'>
        <div class='card-header'>
          <a class='text-info' href='http://localhost/seniorproject/detail.php/?id=$id&type=$type'><h4> $no.  $titleTH </h4></a>
        </div>
        <div class='card-body'>
          <p><strong>title(EN):</strong> $titleEN </p>
          <p><strong>author:</strong> $author </p>
          <p><strong>date:</strong> $date </p>
          <span class='badge badge-info'>Journals</span>
          <i class='fa fa-file-pdf-o' style='font-size:36px;color:red'></i>
        </div>
        <div class='card-footer'>
          <a href='http://localhost/seniorproject/admin/delete.php/?id=$id&type=$type' class='btn btn-outline-danger'>Delete</a>
        </div>
      </div>
      <br />
      ";

      // echo "
      // <div class='card'>
      //   <div class='card-body'>
      //     <p><strong>title(TH):</strong> $titleTH </p>
      //     <p><strong>title(EN):</strong> $titleEN </p>
      //     <p><strong>author:</strong> $author </p>
      //     <p><strong>date:</strong> $date </p>
      //     <p><strong>issue:</strong> $issue </p>
      //     <p><strong>pages:</strong> $pages </p>
      //     <p><strong>volume:</strong> $volume </p>
      //     <p><strong>article_title:</strong> $article_title </p>
      //     <p><strong>type:</strong> $type </p>
      //   </div>
      // </div>
      // <br/>
      // ";
    }
  }
  else {
    echo "We were unable to find results.";
  }
  $conn->close();
?>
