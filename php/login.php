
<!DOCTYPE HTML>
<html>
<head>
  <title>User's Page</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
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
  // Check if required fields have been submitted
  $required_fields = array('userName', 'password');
  foreach($required_fields as $field) {
    if (empty($_POST[$field])) {
      echo 'Need to input '.$field;
      echo "<br>";
      exit;
    }
  }
  $stmt = $con->prepare("SELECT * FROM user WHERE user_name = ? and password = ?");
  $userName=$_POST["userName"];
  $password=$_POST["password"];
  $stmt->bind_param("ss",$userName,$password);
  $stmt->execute();
  $stmt->bind_result($user_id, $user_name, $password, $name, $age, $email, $admin);
  $stmt->store_result();
  $stmt->fetch();
  if($stmt->num_rows>0){
  
 }else{
    echo "Incorrect username or password";
    exit;
  }
  $stmt->close();
?>
<!-- Navbar -->
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Restaurant Review</a>
    </div>
    <ul class="nav navbar-nav">
      <li>
          <form class="navbar-form navbar-left" action="login.php" method="post">
            <input type="hidden" name="userName" value="<?php echo $userName;?>">
            <input type="hidden" name="password" value="<?php echo $password;?>">
            <button class="btn btn-link" type="submit" value="Home">Home</button>
          </form>
      </li>
      <li>
        <form class="navbar-form navbar-left" action="createdReviews.php" method="post">
          <input type="hidden" name="userName" value="<?php echo $userName;?>">
          <input type="hidden" name="password" value="<?php echo $password;?>">
          <input type="hidden" name="user_id" value="<?php echo $user_id;?>">
          <button class="btn btn-link" type="submit" value="Reviews Posted">Reviews Posted</button>
        </form>
      </li>
      <li>
         <form class="navbar-form navbar-left" action="createdRestaurants.php" method="post">
          <input type="hidden" name="userName" value="<?php echo $userName;?>">
          <input type="hidden" name="password" value="<?php echo $password;?>">
          <input type="hidden" name="user_id" value="<?php echo $user_id;?>">
          <button class="btn btn-link" type="submit" value="Restaurants Made">Restaurants Made</button>
        </form>
      </li>
      <li>
        <form class="navbar-form navbar-left" action="search.php" method="post">
          <input type="hidden" name="userName" value="<?php echo $userName;?>">
          <input type="hidden" name="password" value="<?php echo $password;?>">
          <button class="btn btn-link" type="submit" value="Search">Search</button>
        </form>
      </li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li>
        <form class="navbar-form navbar-right" action="profile.php" method="post">
          <input type="hidden" name="userName" value="<?php echo $userName;?>">
          <input type="hidden" name="password" value="<?php echo $password;?>">
          <input type="hidden" name="user_id" value="<?php echo $user_id;?>">
          <button class="btn btn-link" type="submit" value="Profile">Profile</button>
        </form>
      <li>
      </li>
         <form class="navbar-form navbar-right" action="logout.php" method="post">
          <input type="hidden" name="userName" value="<?php echo $userName;?>">
          <input type="hidden" name="password" value="<?php echo $password;?>">
          <button style = 'margin-right: 5px;' class="btn btn-link" type="submit" value="Profile">Logout</button>
        </form>
      </li>
    </ul>
  </div>
</nav>


<div class="container">

  <?php
   include_once("./library.php"); // To connect to the database
   $con = new mysqli($SERVER, $USERNAME, $PASSWORD, $DATABASE);
   // Check connection
   if (mysqli_connect_errno())
   {
     echo "Failed to connect to MySQL: " . mysqli_connect_error();
   }
  // Check if required fields have been submitted
  $required_fields = array('userName', 'password');
  foreach($required_fields as $field) {
    if (empty($_POST[$field])) {
      echo 'Need to input '.$field;
      echo "<br>";
      exit;
    }
  }


  $stmt = $con->prepare("SELECT * FROM user WHERE user_name = ? and password = ?");
  $userName=$_POST["userName"];
  $password=$_POST["password"];
  $stmt->bind_param("ss",$userName,$password);
  $stmt->execute();
  $stmt->bind_result($user_id, $user_name, $password, $name, $age, $email, $admin);
  $stmt->store_result();
  $stmt->fetch();
  if($stmt->num_rows>0){
    echo "<h1>";
    echo "Welcome, ";
    echo $name;
    echo "</h1>";
    echo "<br>";
    
 }

  else{
    echo "Incorrect username or password";
    exit;
  }
  $stmt->close();


?>


  <!-- <style>
  ul {
      list-style-type: none;
      margin: 0;
      padding: 0;
  }
  </style>
  <ul>
    <li><a href="login.php?userName=">Home</a></li>
    <li><a href="createdReviews.html">Reviews Posted</a></li>
    <li><a href="createdRestaurants.html">Restaurants Made</a></li>
    <li><a href="addRestaurants.html">Add Restaurants</a></li>
    <li><a href="search.html">Search</a></li>
    <li><a href="profile.html">Profile</a></li>
  </ul> -->
  <div class="row">
        <div class="col-xs-6">
            <form action="addRestaurants.php" method="post">
              <input type="hidden" name="userName" value="<?php echo $userName;?>">
              <input type="hidden" name="password" value="<?php echo $password;?>">
              <button class="btn btn-primary btn-lg btn-block"  type="submit" value="Add Restaurants">Add Restaurants</button>
            </form>
        </div>
        <div class="col-xs-6">
             <form action="addReviews.php" method="post">
              <input type="hidden" name="userName" value="<?php echo $userName;?>">
              <input type="hidden" name="password" value="<?php echo $password;?>">
              <button class="btn btn-success btn-lg btn-block"  type="submit" value="Add Reviews">Add Reviews</button>
            </form>
        </div>
    </div>

  
  
</div>




</body>
</html>
