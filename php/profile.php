<head>
  <title>Profile</title>
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
  <h1>Profile</h1>


  <?php
   include_once("./library.php"); // To connect to the database
   $con = new mysqli($SERVER, $USERNAME, $PASSWORD, $DATABASE);
   // Check connection
   if (mysqli_connect_errno())
   {
     echo "Failed to connect to MySQL: " . mysqli_connect_error();
   }

   if(isset($_POST['name']) || isset($_POST['email']) || isset($_POST['age']) || isset($_POST['phone_number'])){
     $user_id=$_POST['user_id'];
     $name=$_POST['name'];
     $age=$_POST['age'];
     $email=$_POST['email'];
     $stmt = $con->prepare("UPDATE user SET name=?, age=?, email=? WHERE user_id=?");
     $stmt->bind_param("sisi",$name, $age, $email, $user_id);
     $stmt->execute();

     $phone_number=$_POST['phone_number'];
     $phone_number2=$_POST['phone_number2'];
     $phone_number3=$_POST['phone_number3'];
     if(!empty($phone_number)){
       $sql="SELECT* FROM user_phone WHERE user_id='{$_POST['user_id']}'";
       $result = mysqli_query($con,$sql);
       if(mysqli_num_rows($result)==0){
         $stmt = $con->prepare("INSERT INTO user_phone (phone_number,user_id) VALUES (?, ?)");
         $stmt->bind_param("si",$phone_number, $user_id);
         $stmt->execute();
       }
       else{
         $stmt = $con->prepare("UPDATE user_phone SET phone_number=? WHERE user_id=?");
         $stmt->bind_param("si",$phone_number, $user_id);
         $stmt->execute();
       }
     }
     if(!empty($phone_number2)){
         $stmt = $con->prepare("UPDATE user_phone SET phone_number2=? WHERE user_id=?");
         $stmt->bind_param("si",$phone_number2, $user_id);
         $stmt->execute();
     }
     if(!empty($phone_number3)){
         $stmt = $con->prepare("UPDATE user_phone SET phone_number3=? WHERE user_id=?");
         $stmt->bind_param("si",$phone_number3, $user_id);
         $stmt->execute();
     }

   }



   $sql="SELECT* FROM user WHERE user_id='{$_POST['user_id']}'";
   $result = mysqli_query($con,$sql);
   $user_id=$_POST['user_id'];
   while($row = mysqli_fetch_array($result)) {
     echo "Name: ".$row['name'] ."<br>";
     echo "Age: ".$row['age'] ."<br>";
     echo "Email: ".$row['email']."<br>";
     $sql2="SELECT* FROM user NATURAL JOIN user_phone WHERE user_id='{$_POST['user_id']}'";
     $result2 = mysqli_query($con,$sql2);
     $row_number = mysqli_fetch_array($result2);
     echo "Primary Phone Number: ".$row_number['phone_number']."<br>";
     if(!empty($row_number['phone_number2'])){
       echo "Second Phone Number: ".$row_number['phone_number2']."<br>";
     }
     if(!empty($row_number['phone_number3'])){
       echo "Third Phone Number: ".$row_number['phone_number3']."<br>";
     }
     echo "<br>";
     echo '<form action="editProfile.php" method="post">
          <input type="hidden" name="user_id" value="'.$user_id.'">
          <button class="btn btn-warning" type="submit" value="Edit Profile">Edit Profile</button>
          </form>';
     echo '<form action="deleteProfile.php" method="post">
          <input type="hidden" name="user_id" value="'.$user_id.'">
          <button class="btn btn-danger" type="submit" value="Delete Account">Delete Account</button>

          </form>';
     echo "<br>";

  }
  ?>
  </div>


</body>
</html>
