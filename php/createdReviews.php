<!DOCTYPE HTML>
<html>
<head>
  <title>Review Page</title>
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../stylesheet.css">
</head>
<body>
<!-- Navbar -->
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Restaurant Review</a>
    </div>
    <ul class="nav navbar-nav">
      <li>
          <form class="navbar-form navbar-left" action="login.php" method="post">
            <input type="hidden" name="userName" value="<?php echo $_POST['userName'];?>">
            <input type="hidden" name="password" value="<?php echo $_POST['password'];?>">
            <button class="btn btn-link" type="submit" value="Home">Home</button>
          </form>
      </li>
      <li>
        <form class="navbar-form navbar-left" action="createdReviews.php" method="post">
          <input type="hidden" name="userName" value="<?php echo $_POST['userName'];?>">
          <input type="hidden" name="password" value="<?php echo $_POST['password'];?>">
          <input type="hidden" name="user_id" value="<?php echo $_POST['user_id'];?>">
          <button class="btn btn-link" type="submit" value="Reviews Posted">Reviews Posted</button>
        </form>
      </li>
      <li>
         <form class="navbar-form navbar-left" action="createdRestaurants.php" method="post">
          <input type="hidden" name="userName" value="<?php echo $_POST['userName'];?>">
          <input type="hidden" name="password" value="<?php echo $_POST['password'];?>">
          <input type="hidden" name="user_id" value="<?php echo $_POST['user_id'];?>">
          <button class="btn btn-link" type="submit" value="Restaurants Made">Restaurants Made</button>
        </form>
      </li>
      <li>
        <form class="navbar-form navbar-left" action="search.php" method="post">
          <input type="hidden" name="userName" value="<?php echo $_POST['userName'];?>">
          <input type="hidden" name="password" value="<?php echo $_POST['password'];?>">
          <button class="btn btn-link" type="submit" value="Search">Search</button>
        </form>
      </li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li>
        <form class="navbar-form navbar-right" action="profile.php" method="post">
          <input type="hidden" name="userName" value="<?php echo $_POST['userName'];?>">
          <input type="hidden" name="password" value="<?php echo $_POST['password'];?>">
          <input type="hidden" name="user_id" value="<?php echo $_POST['user_id']?>">
          <button class="btn btn-link" type="submit" value="Profile">Profile</button>
        </form>
      <li>
      </li>
         <form class="navbar-form navbar-right" action="logout.php" method="post">
          <input type="hidden" name="userName" value="<?php echo $_POST['userName'];?>">
          <input type="hidden" name="password" value="<?php echo $_POST['password'];?>">
          <button style = 'margin-right: 5px;' class="btn btn-link" type="submit" value="Profile">Logout</button>
        </form>
      </li>
    </ul>
  </div>
</nav>


 <div class="container">
  <h1>Created Reviews</h1>

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
          <button class="btn btn-warning" type="submit" value="Edit">Edit</button>
          </form>';
     echo '<form action="deleteReview.php" method="post">
          <input type="hidden" name="review_id" value="'.$review_id.'">
          <input type="hidden" name="user_id" value="'.$user_id.'">
          <input type="hidden" name="userName" value="'.$_POST['userName'].'">
          <input type="hidden" name="password" value="'.$_POST['password'].'">
          <button class="btn btn-danger" type="submit" value="Delete">Delete</button>

          </form>';
     echo "<br>";
  }
  ?>
</div>

</body>
</html>
