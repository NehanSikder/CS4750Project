<!DOCTYPE HTML>
<html>
<head>
  <title>Review Page</title>
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


   $sql="SELECT* FROM review NATURAL JOIN restaurant WHERE user_id='{$_POST['user_id']}'";
   $result = mysqli_query($con,$sql);
   if(mysqli_num_rows($result)==0){
     echo "No Reviews Made";
     exit;
   }

   while($row = mysqli_fetch_array($result)) {
     echo $row['restName'] ."<br>";
     echo $row['rating']."<br>";
     echo $row['comment']."<br>";
     $user_id=$_POST['user_id'];
     $review_id=$row['review_id'];
     echo "<td><a href='editReview.php?review_id={$review_id}&amp;user_id={$user_id}' />Edit</a></td>";
     echo "<br>";
     echo "<td><a href='deleteReview.php?review_id={$review_id}&amp;user_id={$user_id}' />Delete</a></td>";
     echo "<br>";
     echo "<br>";
  }
  ?>

</body>
</html>
