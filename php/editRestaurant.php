<!DOCTYPE HTML>
<html>
<head>
  <title>Edit Restaurant</title>
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
          <input type="hidden" name="user_id" value="<?php echo $_POST['user_id'];?>">

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
  <h1>Edit Restaurant</h1>

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
     $userName=$_POST["userName"];
     $password=$_POST["password"];
  }
   else{
     echo "Invalid Access";
     exit;
   }
  ?>

    <form action="createdRestaurants.php" method="post">
      Restaurant Name: <input class="form-control" type= "text" name="restName"><br>
      Hours: <input class="form-control" type= "text" name="hours"><br>
      Street: <input class="form-control" type= "text" name="street"><br>
      City: <input class="form-control" type= "text" name="city"><br>
      State: <input class="form-control" type= "text" name="state"><br>
      Zip Code: <input class="form-control" type= "text" name="zip"><br>
      Phone Number 1: <input class="form-control" type= "text" name="phone1"><br>
      Phone Number 2: <input class="form-control" type= "text" name="phone2"><br>
      Phone Number 3: <input class="form-control" type= "text" name="phone3"><br>
      URL 1: <input class="form-control" type= "text" name="url1"><br>
      URL 2: <input class="form-control" type= "text" name="url2"><br>
      URL 3: <input class="form-control" type= "text" name="url3"><br>
      <input type="hidden" name="user_id" value="<?php echo $user_id;?>">
      <input type="hidden" name="restaurant_id" value="<?php echo $review_id;?>">
      <input type="hidden" name="userName" value="<?php echo $userName;?>">
      <input type="hidden" name="password" value="<?php echo $password;?>">
      <input type="hidden" name="update" value="update">
      <button class="btn btn-success" type="submit" value="Edit Restaurant">Edit Restaurant</button>
    </form>
</div>
  </body>
  </html>
