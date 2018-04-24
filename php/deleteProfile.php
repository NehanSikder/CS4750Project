<!DOCTYPE HTML>
<html>
<head>
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
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
$loginURL = '../index.html'; 
   if (isset($_POST['user_id'])  && is_numeric($_POST['user_id'])){
     $sql="DELETE FROM user WHERE user_id='{$_POST['user_id']}'";
     $result = mysqli_query($con,$sql);
     echo '<script language="javascript">';
    echo 'alert("Account has been deleted");';
    echo 'window.location = "'.$loginURL.'";';
    echo '</script>';

  }
   else{
     echo "Invalid Access";
     exit;
   }

  ?>
  <!-- <h1>Account has been deleted</h1>
  <form action="../index.html" method="post">
      <input type="submit" value="Home Page">
  </form> -->
</body>
</html>
