<!DOCTYPE HTML>
<html>
<head>
  <title>Edit Review</title>
  <h1>Edit Review</h1>
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
   if (isset($_POST['restaurant_id']) && isset($_POST['user_id']) && is_numeric($_POST['restaurant_id']) && is_numeric($_POST['user_id'])){
     $review_id=$_POST['restaurant_id'];
     $user_id=$_POST['user_id'];
  }
   else{
     echo "Invalid Access";
     exit;
   }
  ?>

    <form action="createdRestaurants.php" method="post">
      Restaurant Name: <input type= "text" name="comment"> <br>
      <input type="hidden" name="user_id" value="<?php echo $user_id;?>">
      <input type="hidden" name="restaurant_id" value="<?php echo $review_id;?>">
      <input type="submit" value="Submit">
    </form>

  </body>
  </html>
