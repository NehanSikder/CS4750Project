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
          <input type="submit" value="Edit Profile" name="Edit Profile">
          </form>';
     echo '<form action="deleteProfile.php" method="post">
          <input type="hidden" name="user_id" value="'.$user_id.'">
          <input type="submit" value="Delete Account" name="Delete Account">
          </form>';
     echo "<br>";

  }
  ?>

</body>
</html>
