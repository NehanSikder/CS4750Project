<!DOCTYPE HTML>
<html>
<head>
  <title>Edit Review</title>
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../stylesheet.css">
</head>
<body>
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
 <h1>Edit Review</h1>

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
      Comment: <input class="form-control" type= "text" name="comment">
      <br>
      Rating: <select class="form-control" id="rating" name="rating">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
      </select>
      <br>

      <input type="hidden" name="user_id" value="<?php echo $user_id;?>">
      <input type="hidden" name="review_id" value="<?php echo $review_id;?>">
      <input type="hidden" name="userName" value="<?php echo $userName;?>">
      <input type="hidden" name="password" value="<?php echo $password;?>">
      <button class="btn btn-success" type="submit" value="Edit Review">Edit Review</button>
      </form>
  </div>

  </body>
  </html>
