<!DOCTYPE HTML>
<html>
<head>
  <title>Restaurant Page</title>
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
  <h3>Basic Information</h3>
  <div class="row">
<div class="col-sm-6">
  <?php
   include_once("./library.php"); // To connect to the database
   $con = new mysqli($SERVER, $USERNAME, $PASSWORD, $DATABASE);
   // Check connection
   if (mysqli_connect_errno())
   {
     echo "Failed to connect to MySQL: " . mysqli_connect_error();
   }

   $sql1="SELECT* FROM restaurant NATURAL JOIN restaurant_address WHERE restaurant_id='{$_POST['restaurant_id']}'";
   $result1 = mysqli_query($con,$sql1);
   while($row = mysqli_fetch_array($result1)) {
     echo "Restaurant Name: ". $row['restName'] ."<br>";
     echo "Hours: ". $row['hours']."<br>";
     echo "Street: ". $row['street']."<br>";
     echo "City: ". $row['city']."<br>";
     echo "State: ". $row['state']."<br>";
     echo "Zip Code: ". $row['zip']."<br>";
     $sql2="SELECT* FROM restaurant_phone WHERE restaurant_id='{$row['restaurant_id']}'";
     $result2 = mysqli_query($con,$sql2);
     $row_number = mysqli_fetch_array($result2);
     echo "Phone Number: ".$row_number['phone_number']."<br>";
     if(!empty($row_number['phone_number2'])){
       echo "Alternative Number: ".$row_number['phone_number2']."<br>";
     }
     if(!empty($row_number['phone_number3'])){
       echo "Alternative Number: ".$row_number['phone_number3']."<br>";
     }
     // $counter=1;
     // while($row_number = mysqli_fetch_array($result2)) {
     //   echo "Phone Number ".$counter. ": ". $row_number['phone_number']."<br>";
     //   $counter++;
     // }
     echo "Average Rating: ". $row['avg_rating']."<br>";
     $sql3="SELECT* FROM restaurant_photo WHERE restaurant_id='{$row['restaurant_id']}'";
     $result3 = mysqli_query($con,$sql3);
     if(mysqli_num_rows($result3)!=0){
       $row_url = mysqli_fetch_array($result3);
       echo '<img src="'.$row_url['url'].'" class="img-thumbnail"><br>';
       if(!empty($row_url['url2'])){
       echo '<img src="'.$row_url['url2'].'" class="img-thumbnail"><br>';
       }
       if(!empty($row_url['url3'])){
       echo '<img src="'.$row_url['url3'].'" class="img-thumbnail"><br>';
       }
     }
  }
  ?>
</div>
<div class="col-sm-6">
  

  <h3>Menu</h3>
  <?php
    $sql="SELECT * FROM serves NATURAL JOIN item WHERE restaurant_id='{$_POST['restaurant_id']}'";
    $result= mysqli_query($con, $sql);
    if(mysqli_num_rows($result)==0){
      echo "No Items Posted";
    }
    else{
      while($row = mysqli_fetch_array($result)) {
        echo "Item Name: ".$row['name']."<br>";
        echo "Description: ".$row['description']."<br>";
        echo "Price: $".$row['price']."<br>";
        echo "<br>";
      }
    }
   ?>

   <h3>Recent Comments</h3>
   <?php
      $sql="SELECT * FROM review WHERE restaurant_id='{$_POST['restaurant_id']}' ORDER BY review_id DESC LIMIT 5";
      $result= mysqli_query($con, $sql);
      if(mysqli_num_rows($result)==0){
        echo "No Comments";
      }
      else{
        while($row = mysqli_fetch_array($result)) {
          $query="SELECT * FROM review NATURAL JOIN user WHERE review_id='{$row['review_id']}'";
          $query_result= mysqli_query($con, $query);
          $user=mysqli_fetch_array($query_result);
          echo "User's Name: ".$user['name']."<br>";
          echo "Comment: ".$row['comment']."<br>";
          echo "Rating: ".$row['rating']."<br>";
          echo "<br>";
        }
      }
   ?>
   </div>
</div>
</div>
</body>
</html>
