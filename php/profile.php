<head>
  <title>Profile</title>
  <h1>Profile</h1>
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


   $sql="SELECT* FROM user WHERE user_id='{$_POST['user_id']}'";
   $result = mysqli_query($con,$sql);
   while($row = mysqli_fetch_array($result)) {
     echo $row['name'] ."<br>";
     echo $row['age'] ."<br>";
     echo $row['email']."<br>";
     echo "<br>";
     echo '<form action="editProfile.php" method="post">
          <input type="hidden" name="user_id" value="'.$user_id.'">
          <input type="submit" value="Edit" name="Edit">
          </form>';
     echo '<form name="deleteProfile.php" method="post">
          <input type="hidden" name="user_id" value="'.$user_id.'">
          <input type="submit" value="Delete" name="Delete">
          </form>';
     echo "<br>";

  }
  ?>

</body>
</html>
