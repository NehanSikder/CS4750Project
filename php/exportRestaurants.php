<!DOCTYPE HTML>
<html>
<head>
  <title>Export</title>
  <h1>Export Data</h1>
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
    $sql="SELECT* FROM restaurant NATURAL JOIN can_edit NATURAL JOIN restaurant_address NATURAL JOIN restaurant_phone NATURAL JOIN restaurant_photo WHERE user_id='{$_POST['user_id']}'";

    $json_array = array();
    $result = mysqli_query($con,$sql);
    while($row=mysqli_fetch_array($result)) {
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
    // $fp = fopen('restaurants.json', 'w');
    // fwrite($fp, json_encode($json_array));
    // fclose($fp);
    $json_data = json_encode($json_array, JSON_PRETTY_PRINT);
    //header('Content-Type: application/json');
    echo $json_data;
    file_put_contents('myfile.json', $json_data);


  ?>

    <form action="createdRestaurants.php" method="post">
      <input type="hidden" name="user_id" value="<?php echo $_POST['user_id'];?>">
      <input type="submit" value="Return">
    </form>


  </body>
  </html>
