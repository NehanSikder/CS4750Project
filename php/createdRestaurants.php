<!DOCTYPE HTML>
<html>
<head>
  <title>Restaurant Page</title>
  <h1>Restaurants Owned</h1>
</head>
<body>
  <?php
   include_once("./library.php"); // To connect to the database
   $con = new mysqli($SERVER, $USERNAME, $PASSWORD, $DATABASE);
   // Check connection
   if (mysqli_connect_errno())
   {
     echo "Failed to connect to MySQL: " . mysqli_connect_error();
   }


   $sql="SELECT* FROM can_edit NATURAL JOIN restaurant WHERE user_id='{$_POST['user_id']}'";
   $result = mysqli_query($con,$sql);
   while($row = mysqli_fetch_array($result)) {
     echo $row['restName'] ."<br>";
     echo $row['hours']."<br>";
     echo $row['avg_rating']."<br>";
     echo "<br>";

  }
  ?>

</body>
</html>
