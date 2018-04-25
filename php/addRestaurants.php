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
 <h1>Add Restaurant</h1>
  <form action="addItems.php" method="post" id='addReviews'>
    Restaurant Name: <input class="form-control" type= "text" name="restaurant" required>
    <br>
      Street: <input class="form-control" type= "text" name="street" required>
      <br>
      City: <input class="form-control" type= "text" name="city" required>
      <br>
      State: <input class="form-control" type= "text" name="state" required>
      <br>
      Zip: <input class="form-control" type= "text" name="zip" required>
      <br>
      Phone: <input class="form-control" type= "text" name="phone" required>
      <br>
      Opens: <select class="form-control" id="rating" name="opens" required>
      <option value="7:00 AM">7:00 AM</option>
        <option value="8:00 AM">8:00 AM</option>
        <option value="9:00 AM">9:00 AM</option>
        <option value="10:00 AM">10:00 AM</option>
        <option value="11:00 AM">11:00 AM</option>
        <option value="12:00 PM">12:00 PM</option>
      </select>
      <br>
      Closes: <select class="form-control" id="rating" name="closes" required>
        <option value="6:00 PM">6:00 PM</option>
        <option value="7:00 PM">7:00 PM</option>
        <option value="8:00 PM">8:00 PM</option>
        <option value="9:00 PM">9:00 PM</option>
        <option value="10:00 PM">10:00 PM</option>
        <option value="11:00 PM">11:00 PM</option>
        <option value="12:00 AM">12:00 AM</option>
      </select>
      <br>

      <input type="hidden" name="user_id" value="<?php echo $_POST['user_id'];?>">
      <input type="hidden" name="userName" value="<?php echo $_POST['userName'];?>">
      <input type="hidden" name="password" value="<?php echo $_POST['password'];?>">
      <button class="btn btn-success" type="submit" value="Add Review">Add Items</button>
    </form>
  </div>

  </body>
  </html>
