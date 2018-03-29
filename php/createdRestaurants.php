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
   if(mysqli_num_rows($result)==0){
     echo "No Restaurants Made";
     exit;
   }
   while($row = mysqli_fetch_array($result)) {
     echo "Restaurant Name: ". $row['restName'] ."<br>";
     echo "Hours: ". $row['hours']."<br>";
     echo "Average Rating: ". $row['avg_rating']."<br>";
     echo "<br>";
     echo '<form action="editRestaurant.php" method="post">
          <input type="hidden" name="restaurant_id" value="'.$restaurant_id.'">
          <input type="hidden" name="user_id" value="'.$user_id.'">
          <input type="submit" value="Edit" name="Edit">
          </form>';
     echo '<form action="deleteRestaurant.php" method="post">
          <input type="hidden" name="restaurant_id" value="'.$restaurant_id.'">
          <input type="hidden" name="user_id" value="'.$user_id.'">
          <input type="submit" value="Delete" name="Delete">
          </form>';
     echo "<br>";

  }
  ?>

</body>
</html>
