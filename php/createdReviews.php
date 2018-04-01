<!DOCTYPE HTML>
<html>
<head>
  <title>Review Page</title>
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="../stylesheet.css">
  <h1>Reviews</h1>
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

   if(isset($_POST['rating']) || isset($_POST['comment'])){
     $review_id=$_POST['review_id'];
     $rating=$_POST['rating'];
     $comment=$_POST['comment'];
     $stmt = $con->prepare("UPDATE review SET rating=?, comment=? WHERE review_id=?");
     $stmt->bind_param("isi",$rating, $comment, $review_id);
     $stmt->execute();
   }

   $sql="SELECT* FROM review NATURAL JOIN restaurant WHERE user_id='{$_POST['user_id']}'";
   $result = mysqli_query($con,$sql);
   if(mysqli_num_rows($result)==0){
     echo "No Reviews Made";
     exit;
   }

   while($row = mysqli_fetch_array($result)) {
     echo "Restaurant Name: ". $row['restName'] ."<br>";
     echo "Rating: ". $row['rating']."<br>";
     echo "Comment: ". $row['comment']."<br>";
     $user_id=$_POST['user_id'];
     $review_id=$row['review_id'];
     // echo "<td><a href='editReview.php?review_id={$review_id}&amp;user_id={$user_id}' />Edit</a></td>";
     // echo "<br>";
     // echo "<td><a href='deleteReview.php?review_id={$review_id}&amp;user_id={$user_id}' />Delete</a></td>";
     // echo "<br>";
     // echo "<br>";
     echo '<form action="editReview.php" method="post">
          <input type="hidden" name="review_id" value="'.$review_id.'">
          <input type="hidden" name="user_id" value="'.$user_id.'">
          <input type="hidden" name="userName" value="'.$_POST['userName'].'">
          <input type="hidden" name="password" value="'.$_POST['password'].'">
          <input type="submit" value="Edit" name="Edit">
          </form>';
     echo '<form action="deleteReview.php" method="post">
          <input type="hidden" name="review_id" value="'.$review_id.'">
          <input type="hidden" name="user_id" value="'.$user_id.'">
          <input type="hidden" name="userName" value="'.$_POST['userName'].'">
          <input type="hidden" name="password" value="'.$_POST['password'].'">
          <input type="submit" value="Delete" name="Delete">
          </form>';
     echo "<br>";
  }
  ?>

</body>
</html>
