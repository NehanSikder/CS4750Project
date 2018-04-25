<!DOCTYPE HTML>
<html>
<head>
  <title>Add Review</title>
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../stylesheet.css">
</head>
<body>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Restaurant Review</a>
    </div>
    <ul class="nav navbar-nav">
      <li>
          <form class="navbar-form navbar-left" action="login.php" method="post">
            <input type="hidden" name="userName" value="<?php echo $_POST['userName'];?>">
            <input type="hidden" name="password" value="<?php echo $_POST['password'];?>">
            <button class="btn btn-link" type="submit" value="Home">Home</button>
          </form>
      </li>
      <li>
        <form class="navbar-form navbar-left" action="createdReviews.php" method="post">
          <input type="hidden" name="userName" value="<?php echo $_POST['userName'];?>">
          <input type="hidden" name="password" value="<?php echo $_POST['password'];?>">
          <input type="hidden" name="user_id" value="<?php echo $_POST['user_id'];?>">
          <button class="btn btn-link" type="submit" value="Reviews Posted">Reviews Posted</button>
        </form>
      </li>
      <li>
         <form class="navbar-form navbar-left" action="createdRestaurants.php" method="post">
          <input type="hidden" name="userName" value="<?php echo $_POST['userName'];?>">
          <input type="hidden" name="password" value="<?php echo $_POST['password'];?>">
          <input type="hidden" name="user_id" value="<?php echo $_POST['user_id'];?>">
          <button class="btn btn-link" type="submit" value="Restaurants Made">Restaurants Made</button>
        </form>
      </li>
      <li>
        <form class="navbar-form navbar-left" action="search.php" method="post">
          <input type="hidden" name="userName" value="<?php echo $_POST['userName'];?>">
          <input type="hidden" name="password" value="<?php echo $_POST['password'];?>">
          <button class="btn btn-link" type="submit" value="Search">Search</button>
        </form>
      </li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li>
        <form class="navbar-form navbar-right" action="profile.php" method="post">
          <input type="hidden" name="userName" value="<?php echo $_POST['userName'];?>">
          <input type="hidden" name="password" value="<?php echo $_POST['password'];?>">
          <input type="hidden" name="user_id" value="<?php echo $_POST['user_id']?>">
          <button class="btn btn-link" type="submit" value="Profile">Profile</button>
        </form>
      <li>
      </li>
         <form class="navbar-form navbar-right" action="logout.php" method="post">
          <input type="hidden" name="userName" value="<?php echo $_POST['userName'];?>">
          <input type="hidden" name="password" value="<?php echo $_POST['password'];?>">
          <button style = 'margin-right: 5px;' class="btn btn-link" type="submit" value="Profile">Logout</button>
        </form>
      </li>
    </ul>
  </div>
</nav>

<div class="container">
 <h1>Add Menu Items to <?php echo $_POST['restaurant']?></h1>

 <?php
   ob_start();

 include_once("./library.php"); // To connect to the database
 $con = new mysqli($SERVER, $USERNAME, $PASSWORD, $DATABASE);
 // Check connection
 if (mysqli_connect_errno())
 {
 echo "Failed to connect to MySQL: " . mysqli_connect_error();
 }

if (isset($_POST['user_id']) && is_numeric($_POST['user_id'])){
     $user_id=$_POST['user_id'];
     $userName=$_POST["userName"];
     $password=$_POST["password"];
  }
   else{
     echo "Invalid Access";
     exit;
}
  if(isset($_POST['restaurant'])){
    if(!isset($_POST['addedItem'])){
        $hoursStr = $_POST['opens'] . " to " . $_POST['closes'];
        $stmt = $con->prepare("INSERT INTO restaurant (restName,hours) VALUES (?,?)");
        $stmt->bind_param("ss",$_POST['restaurant'],$hoursStr);
        $stmt->execute();
        $last_id = $con->insert_id; 
        $stmt = $con->prepare("INSERT INTO restaurant_address (restaurant_id,street,city,state,zip) VALUES (?,?,?,?,?)");
        $stmt->bind_param("issss",$last_id,$_POST['street'],$_POST['city'],$_POST['state'],$_POST['zip']);
        $stmt->execute();
        $stmt = $con->prepare("INSERT INTO restaurant_phone (restaurant_id,phone_number) VALUES (?,?)");
        $stmt->bind_param("is",$last_id,$_POST['phone']);
        $stmt->execute();
        $stmt = $con->prepare("INSERT INTO can_edit (restaurant_id,user_id) VALUES (?,?)");
        $stmt->bind_param("ii",$last_id,$_POST['user_id']);
        $stmt->execute();
        $stmt->close();
    }
    else{
        if(empty($_POST['itemName'])){
          echo '<script language="javascript">';
          echo 'alert("Name Field cannot be empty");';
          echo '</script>';
        }
        else{
            $stmt = $con->prepare("INSERT INTO item (name,description,price) VALUES (?,?,?)");
            $stmt->bind_param("ssd",$_POST['itemName'],$_POST['description'],$_POST['price']);
            $stmt->execute();

            $last_id = $con->insert_id;
            $stmt = $con->prepare("SELECT restaurant_id FROM restaurant WHERE restName = ?");
            $stmt->bind_param("s",$_POST['restaurant']);
            $stmt->execute();
            $stmt->bind_result($id);
            $stmt->fetch();
            $stmt->close();
            
            $stmt = $con->prepare("INSERT INTO serves (restaurant_id,item_id) VALUES (?,?)");
            $stmt->bind_param("ii",$id,$last_id);
            $stmt->execute();
        }
    }
  }
?>
  <br>
  <form action="addItems.php" method="post" id='addReviews'>
    <h2> Menu Item Info </h2>
    Item Name: <input class= "form-control" type="text" name="itemName"/>
    Item Description: <input class= "form-control" type="text" name="description"/>
    Item Price: <input class= "form-control" type="text" name="price"/>
    <input type="hidden" name="user_id" value="<?php echo $_POST['user_id'];?>">
    <input type="hidden" name="userName" value="<?php echo $_POST['userName'];?>">
    <input type="hidden" name="password" value="<?php echo $_POST['password'];?>">
    <input type="hidden" name="restaurant" value="<?php echo $_POST['restaurant'];?>">
    <input type="hidden" name="street" value="<?php echo $_POST['street'];?>">
    <input type="hidden" name="city" value="<?php echo $_POST['city'];?>">
    <input type="hidden" name="state" value="<?php echo $_POST['state'];?>">
    <input type="hidden" name="zip" value="<?php echo $_POST['zip'];?>">
    <input type="hidden" name="phone" value="<?php echo $_POST['phone'];?>">
    <input type="hidden" name="opens" value="<?php echo $_POST['opens'];?>">
    <input type="hidden" name="closes" value="<?php echo $_POST['closes'];?>">
    <input type="hidden" name="addedItem" value=1/>
    <button class="btn btn-success" type="submit" value="Add Review">Add Another</button>
  </form>
  <form action="createdRestaurants.php" method="post" id='addReviews'>
    <input type="hidden" name="user_id" value="<?php echo $_POST['user_id'];?>">
    <input type="hidden" name="userName" value="<?php echo $_POST['userName'];?>">
    <input type="hidden" name="password" value="<?php echo $_POST['password'];?>">
    <button class="btn btn-success" type="submit" value="Finish">Finish</button>
  </form>
  </div>

  </body>
  </html>
