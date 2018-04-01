<!DOCTYPE HTML>
<html>
<head>
  <title>Edit Review</title>
  <h1>Edit Review</h1>
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="../stylesheet.css">
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
     $userName=$_POST["userName"];
     $password=$_POST["password"];
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
      <input type="hidden" name="userName" value="<?php echo $userName;?>">
      <input type="hidden" name="password" value="<?php echo $password;?>">
      <input type="submit" value="Submit">
    </form>

  </body>
  </html>
