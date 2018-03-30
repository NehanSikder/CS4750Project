<!DOCTYPE HTML>
<html>
<head>
  <title>Restaurant Page</title>
  <h1>Restaurants Owned</h1>
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

   if(isset($_POST['restaurant_id']) && isset($_POST['user_id']) && isset($_POST['delete']) && is_numeric($_POST['restaurant_id']) && is_numeric($_POST['user_id'])){
     $sql="DELETE FROM restaurant WHERE restaurant_id='{$_POST['restaurant_id']}'";
     $result = mysqli_query($con,$sql);
   }

   if(isset($_POST['restaurant_id']) && isset($_POST['user_id']) && isset($_POST['update']) && is_numeric($_POST['restaurant_id']) && is_numeric($_POST['user_id'])){
     $restaurant_id=$_POST['restaurant_id'];
     $restName=$_POST['restName'];
     $hours=$_POST['hours'];
     $phone1=$_POST['phone1'];
     $phone2=$_POST['phone2'];
     $phone3=$_POST['phone3'];
     $url1=$_POST['url1'];
     $url2=$_POST['url2'];
     $url3=$_POST['url3'];
     if(!empty($restName)){
       $stmt = $con->prepare("UPDATE restaurant SET restName=? WHERE restaurant_id=?");
       $stmt->bind_param("si",$restName, $restaurant_id);
       $stmt->execute();
     }
     if(!empty($hours)){
       $stmt = $con->prepare("UPDATE restaurant SET hours=? WHERE restaurant_id=?");
       $stmt->bind_param("si",$hours, $restaurant_id);
       $stmt->execute();
     }
     if(!empty($phone1)){
       $sql="SELECT* FROM restaurant_phone WHERE restaurant_id='{$_POST['restaurant_id']}'";
       $result = mysqli_query($con,$sql);
       if(mysqli_num_rows($result)==0){
         $stmt = $con->prepare("INSERT INTO restaurant_phone (phone_number,restaurant_id) VALUES (?, ?)");
         $stmt->bind_param("si",$phone1, $restaurant_id);
         $stmt->execute();
       }
       else{
         $stmt = $con->prepare("UPDATE restaurant_phone SET phone_number=? WHERE restaurant_id=?");
         $stmt->bind_param("si",$phone1, $restaurant_id);
         $stmt->execute();
       }
     }
     if(!empty($phone2)){
         $stmt = $con->prepare("UPDATE restaurant_phone SET phone_number2=? WHERE restaurant_id=?");
         $stmt->bind_param("si",$phone2, $restaurant_id);
         $stmt->execute();
     }
     if(!empty($phone3)){
         $stmt = $con->prepare("UPDATE restaurant_phone SET phone_number3=? WHERE restaurant_id=?");
         $stmt->bind_param("si",$phone3, $restaurant_id);
         $stmt->execute();
     }
     if(!empty($url1)){
       $sql="SELECT* FROM restaurant_photo WHERE restaurant_id='{$_POST['restaurant_id']}'";
       $result = mysqli_query($con,$sql);
       if(mysqli_num_rows($result)==0){
         $stmt = $con->prepare("INSERT INTO restaurant_photo (url ,restaurant_id) VALUES (?, ?)");
         $stmt->bind_param("si",$url1, $restaurant_id);
         $stmt->execute();
       }
       else{
         $stmt = $con->prepare("UPDATE restaurant_photo SET url=? WHERE restaurant_id=?");
         $stmt->bind_param("si",$url1, $restaurant_id);
         $stmt->execute();
       }
     }
     if(!empty($url2)){
       $stmt = $con->prepare("UPDATE restaurant_photo SET url2=? WHERE restaurant_id=?");
       $stmt->bind_param("si",$url2, $restaurant_id);
       $stmt->execute();
     }
     if(!empty($url3)){
       $stmt = $con->prepare("UPDATE restaurant_photo SET url3=? WHERE restaurant_id=?");
       $stmt->bind_param("si",$url3, $restaurant_id);
       $stmt->execute();
     }
   }

   $sql1="SELECT* FROM can_edit NATURAL JOIN restaurant WHERE user_id='{$_POST['user_id']}'";
   $result1 = mysqli_query($con,$sql1);
   if(mysqli_num_rows($result1)==0){
     echo "No Restaurants Made";
     exit;
   }
   while($row = mysqli_fetch_array($result1)) {
     echo "Restaurant Name: ". $row['restName'] ."<br>";
     echo "Hours: ". $row['hours']."<br>";
     $sql2="SELECT* FROM can_edit NATURAL JOIN restaurant_phone WHERE user_id='{$_POST['user_id']}' and restaurant_id='{$row['restaurant_id']}'";
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
     $sql3="SELECT* FROM can_edit NATURAL JOIN restaurant_photo WHERE user_id='{$_POST['user_id']}' and restaurant_id='{$row['restaurant_id']}'";
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
     echo '<form action="editRestaurant.php" method="post">
          <input type="hidden" name="restaurant_id" value="'.$restaurant_id.'">
          <input type="hidden" name="user_id" value="'.$user_id.'">
          <input type="submit" value="Edit" name="Edit">
          </form>';
     echo '<form action="createdRestaurants.php" method="post">
          <input type="hidden" name="restaurant_id" value="'.$restaurant_id.'">
          <input type="hidden" name="user_id" value="'.$user_id.'">
          <input type="hidden" name="delete" value="delete">
          <input type="submit" value="Delete" name="Delete">
          </form>';
     echo "<br>";

  }
  ?>

</body>
</html>
