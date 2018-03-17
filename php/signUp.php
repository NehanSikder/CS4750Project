<?php
 include_once("./library.php"); // To connect to the database
 $con = new mysqli($SERVER, $USERNAME, $PASSWORD, $DATABASE);
 // Check connection
 if (mysqli_connect_errno())
 {
 echo "Failed to connect to MySQL: " . mysqli_connect_error();
 }
// Check if required fields have been submitted
$required_fields = array('userName', 'password', 'name');
$error = false;
foreach($required_fields as $field) {
  if (empty($_POST[$field])) {
  	echo 'Need to input '.$field;
  	echo "<br>";
  	exit;
  }
}
 // Form the SQL query (an INSERT query)
 $sql="INSERT INTO user (user_name, password, name, age, email)
 VALUES
 ('$_POST[userName]','$_POST[password]','$_POST[name]','$_POST[age]','$_POST[email]')";

 if (!mysqli_query($con,$sql))
 {
 die('Error: ' . mysqli_error($con));
 }
 echo "New User: $_POST[userName] created"; // Output to user
 mysqli_close($con);
?> 
