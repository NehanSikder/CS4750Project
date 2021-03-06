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
  <h1>Created Restaurants</h1>

  <?php
   include_once("./library.php"); // To connect to the database
   $con = new mysqli($SERVER, $USERNAME, $PASSWORD, $DATABASE);
   // Check connection
   if (mysqli_connect_errno())
   {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
   }

   if (isset($_POST['restaurant_id']) && isset($_POST['user_id']) && isset($_POST['delete']) && is_numeric($_POST['restaurant_id']) && is_numeric($_POST['user_id'])){
     $sql="DELETE FROM restaurant WHERE restaurant_id='{$_POST['restaurant_id']}'";
     $result = mysqli_query($con,$sql);
   }

   if(isset($_POST['restaurant_id']) && isset($_POST['user_id']) && isset($_POST['update']) && is_numeric($_POST['restaurant_id']) && is_numeric($_POST['user_id']))
   {
     $restaurant_id=$_POST['restaurant_id'];
     $restName=$_POST['restName'];
     $hours=$_POST['hours'];
     $street=$_POST['street'];
     $city=$_POST['city'];
     $state=$_POST['state'];
     $zip=$_POST['zip'];
     $phone1=$_POST['phone1'];
     $phone2=$_POST['phone2'];
     $phone3=$_POST['phone3'];
     $url1=$_POST['url1'];
     $url2=$_POST['url2'];
     $url3=$_POST['url3'];
     if(!empty($restName))
     {
       $stmt = $con->prepare("UPDATE restaurant SET restName=? WHERE restaurant_id=?");
       $stmt->bind_param("si",$restName, $restaurant_id);
       $stmt->execute();
     }
     if(!empty($hours))
     {
       $stmt = $con->prepare("UPDATE restaurant SET hours=? WHERE restaurant_id=?");
       $stmt->bind_param("si",$hours, $restaurant_id);
       $stmt->execute();
     }
     if(!empty($street))
     {
       $stmt = $con->prepare("UPDATE restaurant_address SET street=? WHERE restaurant_id=?");
       $stmt->bind_param("si",$street, $restaurant_id);
       $stmt->execute();
     }
     if(!empty($city))
     {
       $stmt = $con->prepare("UPDATE restaurant_address SET city=? WHERE restaurant_id=?");
       $stmt->bind_param("si",$city, $restaurant_id);
       $stmt->execute();
     }
     if(!empty($state))
     {
       $stmt = $con->prepare("UPDATE restaurant_address SET state=? WHERE restaurant_id=?");
       $stmt->bind_param("si",$state, $restaurant_id);
       $stmt->execute();
     }
     if(!empty($zip))
     {
       $stmt = $con->prepare("UPDATE restaurant_address SET zip=? WHERE restaurant_id=?");
       $stmt->bind_param("si",$zip, $restaurant_id);
       $stmt->execute();
     }
     if(!empty($phone1))
     {
       $sql="SELECT* FROM restaurant_phone WHERE restaurant_id='{$_POST['restaurant_id']}'";
       $result = mysqli_query($con,$sql);
       if(mysqli_num_rows($result)==0)
       {
         $stmt = $con->prepare("INSERT INTO restaurant_phone (phone_number,restaurant_id) VALUES (?, ?)");
         $stmt->bind_param("si",$phone1, $restaurant_id);
         $stmt->execute();
       }
       else
       {
         $stmt = $con->prepare("UPDATE restaurant_phone SET phone_number=? WHERE restaurant_id=?");
         $stmt->bind_param("si",$phone1, $restaurant_id);
         $stmt->execute();
       }
     }
     if(!empty($phone2))
     {
         $stmt = $con->prepare("UPDATE restaurant_phone SET phone_number2=? WHERE restaurant_id=?");
         $stmt->bind_param("si",$phone2, $restaurant_id);
         $stmt->execute();
     }
     if(!empty($phone3))
     {
       $stmt = $con->prepare("UPDATE restaurant_phone SET phone_number3=? WHERE restaurant_id=?");
       $stmt->bind_param("si",$phone3, $restaurant_id);
       $stmt->execute();
     }
     if(!empty($url1))
     {
       $sql="SELECT* FROM restaurant_photo WHERE restaurant_id='{$_POST['restaurant_id']}'";
       $result = mysqli_query($con,$sql);
       if(mysqli_num_rows($result)==0)
       {
         $stmt = $con->prepare("INSERT INTO restaurant_photo (url ,restaurant_id) VALUES (?, ?)");
         $stmt->bind_param("si",$url1, $restaurant_id);
         $stmt->execute();
       }
       else
       {
         $stmt = $con->prepare("UPDATE restaurant_photo SET url=? WHERE restaurant_id=?");
         $stmt->bind_param("si",$url1, $restaurant_id);
         $stmt->execute();
       }
     }
     if(!empty($url2))
     {
       $stmt = $con->prepare("UPDATE restaurant_photo SET url2=? WHERE restaurant_id=?");
       $stmt->bind_param("si",$url2, $restaurant_id);
       $stmt->execute();
     }
     if(!empty($url3))
     {
       $stmt = $con->prepare("UPDATE restaurant_photo SET url3=? WHERE restaurant_id=?");
       $stmt->bind_param("si",$url3, $restaurant_id);
       $stmt->execute();
      }
    }

   $sql1="SELECT* FROM user WHERE user_id='{$_POST['user_id']}'";
   $result1 = mysqli_query($con,$sql1);
   $row = mysqli_fetch_array($result1);
   $admin=$row['admin'];
   if($admin==0){
     $sql1="SELECT* FROM can_edit NATURAL JOIN restaurant NATURAL JOIN restaurant_address WHERE user_id='{$_POST['user_id']}'";
     $result1 = mysqli_query($con,$sql1);
   }
   else{
     $sql1="SELECT* FROM restaurant NATURAL JOIN restaurant_address";
     $result1 = mysqli_query($con,$sql1);
   }


   if(mysqli_num_rows($result1)==0){
     echo "No Restaurants Made";
     exit;
   }
   while($row = mysqli_fetch_array($result1))
   {
     echo "Restaurant Name: ". $row['restName'] ."<br>";
     echo "Hours: ". $row['hours']."<br>";
     echo "Street: ". $row['street']."<br>";
     echo "City: ". $row['city']."<br>";
     echo "State: ". $row['state']."<br>";
     echo "Zip Code: ". $row['zip']."<br>";
     $sql2="SELECT* FROM can_edit NATURAL JOIN restaurant_phone WHERE user_id='{$_POST['user_id']}' and restaurant_id='{$row['restaurant_id']}'";
     if($admin!=0){
       $sql2="SELECT* FROM can_edit NATURAL JOIN restaurant_phone WHERE restaurant_id='{$row['restaurant_id']}'";
     }
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
     $avg_sql="SELECT AVG(rating) AS avgRating FROM restaurant NATURAL JOIN review WHERE restaurant_id='{$row['restaurant_id']}'";
     $avg_rating_result=mysqli_query($con,$avg_sql);
     $avg_rating_row = mysqli_fetch_array($avg_rating_result);
     echo "Average Rating: ". $avg_rating_row['avgRating']."<br>";
     $sql3="SELECT* FROM can_edit NATURAL JOIN restaurant_photo WHERE user_id='{$_POST['user_id']}' and restaurant_id='{$row['restaurant_id']}'";
     if($admin!=0){
       $sql3="SELECT* FROM can_edit NATURAL JOIN restaurant_photo WHERE restaurant_id='{$row['restaurant_id']}'";
     }
     $result3 = mysqli_query($con,$sql3);
     if(mysqli_num_rows($result3)!=0){
       $row_url = mysqli_fetch_array($result3);
       echo "URL: ".$row_url['url']."<br>";
       if(!empty($row_url['url2'])){
         echo "Other URL: ".$row_url['url2']."<br>";
       }
       if(!empty($row_url['url3'])){
         echo "Other URL: ".$row_url['url3']."<br>";
       }
     }

     // $counter=1;
     // $sql3="SELECT* FROM can_edit NATURAL JOIN restaurant_photo WHERE user_id='{$_POST['user_id']}' and restaurant_id='{$row['restaurant_id']}'";
     // $result3 = mysqli_query($con,$sql3);
     // while($row_url = mysqli_fetch_array($result3)) {
     //   echo "URL ".$counter. ": ". $row_url['url']."<br>";
     //   $counter++;
     // }
     $restaurant_id=$row['restaurant_id'];
     $user_id=$row['user_id'];
     if($admin!=0){
       $user_id=$_POST['user_id'];
     }
     echo '<form action="viewMoreRestaurantInfo.php" method="post">
          <input type="hidden" name="restaurant_id" value="'.$restaurant_id.'">
          <input type="hidden" name="userName" value="'.$_POST['userName'].'">
          <input type="hidden" name="password" value="'.$_POST['password'].'">
          <button class="btn btn-success" type="submit" value="View More">View More</button>
          </form>';
     echo '<form action="editRestaurant.php" method="post">
          <input type="hidden" name="restaurant_id" value="'.$restaurant_id.'">
          <input type="hidden" name="user_id" value="'.$user_id.'">
          <input type="hidden" name="userName" value="'.$_POST['userName'].'">
          <input type="hidden" name="password" value="'.$_POST['password'].'">
          <button class="btn btn-warning" type="submit" value="Edit">Edit</button>

          </form>';
     echo '<form action="createdRestaurants.php" method="post">
          <input type="hidden" name="restaurant_id" value="'.$restaurant_id.'">
          <input type="hidden" name="user_id" value="'.$user_id.'">
          <input type="hidden" name="userName" value="'.$_POST['userName'].'">
          <input type="hidden" name="password" value="'.$_POST['password'].'">
          <input type="hidden" name="delete" value="delete">
          <button class="btn btn-danger" type="submit" value="Delete">Delete</button>
          </form>';
     echo "<br>";
  }
  //prepare file for export
    $sql="SELECT* FROM restaurant JOIN can_edit ON restaurant.restaurant_id=can_edit.restaurant_id LEFT JOIN restaurant_address ON restaurant.restaurant_id=restaurant_address.restaurant_id LEFT JOIN restaurant_phone ON restaurant.restaurant_id=restaurant_phone.restaurant_id LEFT JOIN restaurant_photo ON restaurant.restaurant_id=restaurant_photo.restaurant_id WHERE user_id='{$_POST['user_id']}'";

    $json_array = array();
    $result = mysqli_query($con,$sql);
    while($row=mysqli_fetch_array($result))
    {
      $restaurant_id=$row['restaurant_id'];
      $restName=$row['restName'];
      $hours=$row['hours'];
      $street=$row['street'];
      $city=$row['city'];
      $state=$row['state'];
      $zip=$row['zip'];
      $phone1=$row['phone_number'];
      $phone2=$row['phone_number2'];
      $phone3=$row['phone_number3'];
      $url1=$row['url'];
      $url2=$row['url2'];
      $url3=$row['url3'];

      //$posts[]=$row;
      $json_array[] = array('Restaurant Name'=> $restName, 'Hours'=> $hours,
      'Street'=>$street, 'City'=>$city, 'State'=>$state, 'Zip'=>$zip,
      'Phone Number 1'=> $phone1, 'Phone Number 2'=>$phone2, 'Phone Number 3'=>$phone3,
      'Url 1'=> $url1, 'Url 2'=>$url2, 'URL 3'=>$url3);
    }
    $json_data = json_encode($json_array, JSON_PRETTY_PRINT);
    $file = '../myfile.json';
    file_put_contents($file, $json_data);
  ?>

  <form action="createdRestaurants.php" id="createdRestaurants" method="post">
    <input type="hidden" name="user_id" value="<?php echo $user_id;?>">
    <input type="hidden" name="userName" value="<?php echo $userName;?>">
    <input type="hidden" name="password" value="<?php echo $password;?>">
</form>
<a class="btn btn-primary" href="<?php echo $file;?>" download>Export</a>
</div>
</body>
</html>
