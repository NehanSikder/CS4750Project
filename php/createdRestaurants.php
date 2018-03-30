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

   if(isset($_POST['restaurant_id']) && isset($_POST['user_id']) && isset($_POST['delete']) && is_numeric($_POST['restaurant_id']) && is_numeric($_POST['user_id'])){
     $sql="DELETE FROM restaurant WHERE restaurant_id='{$_POST['restaurant_id']}'";
     $result = mysqli_query($con,$sql);
   }

   $sql1="SELECT* FROM can_edit NATURAL JOIN restaurant WHERE user_id='{$_POST['user_id']}'";
   $result1 = mysqli_query($con,$sql1);
   if(mysqli_num_rows($result1)==0){
     echo "No Restaurants Made";
     exit;
   }
   while($row = mysqli_fetch_array($result1)) {
     echo "Restaurant Name: ". $row['restName'] ."<br>";
     echo "Hours: ". $row['hours']."<br>";
     $counter=1;
     $sql2="SELECT* FROM can_edit NATURAL JOIN restaurant_phone WHERE user_id='{$_POST['user_id']}' and restaurant_id='{$row['restaurant_id']}'";
     $result2 = mysqli_query($con,$sql2);
     while($row_number = mysqli_fetch_array($result2)) {
       echo "Phone Number ".$counter. ": ". $row_number['phone_number']."<br>";
       $counter++;
     }
     echo "Average Rating: ". $row['avg_rating']."<br>";
     $counter=1;
     $sql3="SELECT* FROM can_edit NATURAL JOIN restaurant_photo WHERE user_id='{$_POST['user_id']}' and restaurant_id='{$row['restaurant_id']}'";
     $result3 = mysqli_query($con,$sql3);
     while($row_url = mysqli_fetch_array($result3)) {
       echo "URL ".$counter. ": ". $row_url['url']."<br>";
       $counter++;
     }
     $restaurant_id=$row['restaurant_id'];
     $user_id=$row['user_id'];
     echo '<form action="editRestaurant.php" method="post">
          <input type="hidden" name="restaurant_id" value="'.$restaurant_id.'">
          <input type="hidden" name="user_id" value="'.$user_id.'">
          <input type="submit" value="Edit" name="Edit">
          </form>';
     echo '<form action="createdRestaurants.php" method="post">
          <input type="hidden" name="restaurant_id" value="'.$restaurant_id.'">
          <input type="hidden" name="user_id" value="'.$user_id.'">
          <input type="hidden" name="delete" value="delete">
          <input type="submit" value="Delete" name="Delete">
          </form>';
     echo "<br>";

  }
  ?>

</body>
</html>
