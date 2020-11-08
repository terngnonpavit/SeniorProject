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

$search=$_POST['search'] ;
$type=$_POST['type'] ;
//echo $type;
$sql='';
if  ($type=='all')
{
  $sql = "select titleTH , titleEN, author, date
          from proceedings where titleTH like '%".$search."%' or titleEN like '%".$search."%' or author like '%".$search."%' or date like '%".$search."%'
          UNION
          select titleTH , titleEN, author, date
          from books where titleTH like '%".$search."%' or titleEN like '%".$search."%' or author like '%".$search."%' or date like '%".$search."%'
          UNION
          select titleTH , titleEN, author, date
          from journals where titleTH like '%".$search."%' or titleEN like '%".$search."%' or author like '%".$search."%' or date like '%".$search."%'
          ";
}
else
{
  $sql = "select * from ".$type." where titleTH like '%".$search."%' or titleEN like '%".$search."%' or author like '%".$search."%' or date like '%".$search."%'";
}
 echo $sql."<br />";

$result = $conn->query($sql);
if ($result->num_rows > 0) {
   //output data of each row
   $no = 0;
  while($row = $result->fetch_assoc())  {

    $titleTH=$row['titleTH'];
    $titleEN=$row['titleEN'];
    $author=$row['author'];
    // $type=$row['type'];
    // $date=$row['date'];
    $no++;

    echo "$no  $titleTH <br />
    $titleEN <br />
    $author <br />
    .................................................<br />
    ";
  }
} else {
  echo "no results";
}
$conn->close();
?>
