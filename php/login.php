<!DOCTYPE HTML>
<html>
<head>
  <title>User's Page</title>
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
    echo "<h1>";
    echo "Welcome ";
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



  <form action="login.php" method="post">
    <input type="hidden" name="userName" value="<?php echo $userName;?>">
    <input type="hidden" name="password" value="<?php echo $password;?>">
    <button type="submit" value="Home">Home</button>
  </form>
  <form action="createdReviews.php" method="post">
    <input type="hidden" name="userName" value="<?php echo $userName;?>">
    <input type="hidden" name="password" value="<?php echo $password;?>">
    <input type="hidden" name="user_id" value="<?php echo $user_id;?>">
    <button type="submit" value="Reviews Posted">Reviews Posted</button>
  </form>
  <form action="createdRestaurants.php" method="post">
    <input type="hidden" name="userName" value="<?php echo $userName;?>">
    <input type="hidden" name="password" value="<?php echo $password;?>">
    <button type="submit" value="Restaurants Made">Restaurants Made</button>
  </form>
  <form action="addRestaurants.php" method="post">
    <input type="hidden" name="userName" value="<?php echo $userName;?>">
    <input type="hidden" name="password" value="<?php echo $password;?>">
    <button type="submit" value="Add Restaurants">Add Restaurants</button>
  </form>
  <form action="search.php" method="post">
    <input type="hidden" name="userName" value="<?php echo $userName;?>">
    <input type="hidden" name="password" value="<?php echo $password;?>">
    <button type="submit" value="Search">Search</button>
  </form>
  <form action="profile.php" method="post">
    <input type="hidden" name="userName" value="<?php echo $userName;?>">
    <input type="hidden" name="password" value="<?php echo $password;?>">
    <button type="submit" value="Profile">Profile</button>
  </form>
   <form action="logout.php" method="post">
    <input type="hidden" name="userName" value="<?php echo $userName;?>">
    <input type="hidden" name="password" value="<?php echo $password;?>">
    <button type="submit" value="Profile">Logout</button>
  </form>




</body>
</html>
