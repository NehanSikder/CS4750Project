<!DOCTYPE HTML>
<html>
<head>
  <title>Edit Profile</title>
  <h1>Edit Profile</h1>
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
   if (isset($_POST['user_id'])){
     $user_id=$_POST['user_id'];
  }
   else{
     echo "Invalid Access";
     exit;
   }
  ?>

  <form action="profile.php" method="post">
      Name: <input type= "text" name="name" required> <br>
      Age: <input type= "number" name="age" required> <br>
      Email: <input type= "text" name="email" required> <br>
      <br>
      <input type="hidden" name="user_id" value="<?php echo $user_id;?>">
      <input type="submit" value="Submit">
    </form>

  </body>
  </html>
