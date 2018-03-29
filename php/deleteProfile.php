<!DOCTYPE HTML>
<html>
<body>
  <?php
   include_once("./library.php"); // To connect to the database
   $con = new mysqli($SERVER, $USERNAME, $PASSWORD, $DATABASE);
   // Check connection
   if (mysqli_connect_errno())
   {
     echo "Failed to connect to MySQL: " . mysqli_connect_error();
   }

   if (isset($_POST['user_id'])  && is_numeric($_POST['user_id'])){
     $sql="DELETE FROM user WHERE user_id='{$_POST['user_id']}'";
     $result = mysqli_query($con,$sql);

  }
   else{
     echo "Invalid Access";
     exit;
   }

  ?>
  <h1>Account has been deleted</h1>
  <form action="../index.html" method="post">
      <input type="submit" value="Home Page">
  </form>
</body>
</html>
