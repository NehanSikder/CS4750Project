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

   if(isset($_POST['name']) || isset($_POST['email']) || isset($_POST['age'])){
     $user_id=$_POST['user_id'];
     $name=$_POST['name'];
     $age=$_POST['age'];
     $email=$_POST['email'];
     $stmt = $con->prepare("UPDATE user SET name=?, age=?, email=? WHERE user_id=?");
     $stmt->bind_param("sisi",$name, $age, $email, $user_id);
     $stmt->execute();
   }



   $sql="SELECT* FROM user WHERE user_id='{$_POST['user_id']}'";
   $result = mysqli_query($con,$sql);
   $user_id=$_POST['user_id'];
   while($row = mysqli_fetch_array($result)) {
     echo "Name: ".$row['name'] ."<br>";
     echo "Age: ".$row['age'] ."<br>";
     echo "Email: ".$row['email']."<br>";
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
