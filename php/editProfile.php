<!DOCTYPE HTML>
<html>
<head>
  <title>Edit Profile</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="../stylesheet.css">
</head>
<body>
<div class="container">
  <h1>Edit Profile</h1>

  <?php
   include_once("./library.php"); // To connect to the database
   $con = new mysqli($SERVER, $USERNAME, $PASSWORD, $DATABASE);
   // Check connection
   if (mysqli_connect_errno())
   {
     echo "Failed to connect to MySQL: " . mysqli_connect_error();
   }
   if (isset($_POST['user_id'])){
     $user_id=$_POST['user_id'];
     $userName=$_POST["userName"];
     $password=$_POST["password"];
  }
   else{
     echo "Invalid Access";
     exit;
   }
  ?>

  <form action="profile.php" method="post">
      Name: <input class="form-control" type= "text" name="name" required> <br>
      Age: <input class="form-control" type= "number" name="age" required> <br>
      Email: <input class="form-control" type= "text" name="email" required> <br>
      Primary Phone Number: <input class="form-control" type= "text" name="phone_number" required> <br>
      Second Phone Number: <input class="form-control" type= "text" name="phone_number2"> <br>
      Third Phone Number: <input class="form-control" type= "text" name="phone_number3"> <br>
      <br>
      <input class="form-control" type="hidden" name="user_id" value="<?php echo $user_id;?>">
      <input class="form-control" type="hidden" name="userName" value="<?php echo $userName;?>">
      <input class="form-control" type="hidden" name="password" value="<?php echo $password;?>">
      <button name="submit" value="submit" class="btn btn-danger">Submit</button>
    </form>
</div>
  </body>
  </html>
