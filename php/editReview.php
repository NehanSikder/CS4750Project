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
   if (isset($_POST['review_id']) && isset($_POST['user_id']) && is_numeric($_POST['review_id']) && is_numeric($_POST['user_id'])){
     $review_id=$_POST['review_id'];
     $user_id=$_POST['user_id'];
  }
   else{
     echo "Invalid Access";
     exit;
   }
  ?>

  <form action="createdReviews.php" method="post">
    <?php
      $stmt = $con->prepare("SELECT restName FROM review NATURAL JOIN restaurant WHERE review_id=?");
      $stmt->bind_param("i",$review_id);
      $stmt->execute();
      $stmt->bind_result($restName);
      $stmt->store_result();
      $stmt->fetch();
      echo "Restaurant Name: ". $restName;
    ?>
    <br>
      Rating: <select id="rating" name="rating">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
      </select>
      <br>
      Comment: <input type= "text" name="comment">
      <br>

      <input type="hidden" name="user_id" value="<?php echo $user_id;?>">
      <input type="hidden" name="review_id" value="<?php echo $review_id;?>">
      <input type="submit" value="Submit">
    </form>

  </body>
  </html>
