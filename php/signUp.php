<?php
 include_once("./library.php"); // To connect to the database
 $con = new mysqli($SERVER, $USERNAME, $PASSWORD, $DATABASE);
 // Check connection
 if (mysqli_connect_errno())
 {
 echo "Failed to connect to MySQL: " . mysqli_connect_error();
 }


// check if username is already taken
 $userName = $_POST['userName'];
 $signUpURL = '/signUp.html';
//call stored proc to get list of all usernames
  $result = mysqli_query($con, 
     "CALL get_all_usernames()") or die("Stored Procedure Query failed: " . mysqli_error());
  //loop the result set
  while ($row = mysqli_fetch_array($result)){   
      if ($row[0] ==  $userName) {
     	echo '<script language="javascript">';
		echo 'alert("Username: '.$userName.' already taken");';
		echo 'window.location = "'.$signUpURL.'";';
		echo '</script>';
		exit;
      }
  }

// Check if required fields have been submitted
$required_fields = array('userName', 'password', 'name');

foreach($required_fields as $field) {
  if (empty($_POST[$field])) {
  	// echo 'Need to input '.$field;
  	// echo "<br>";
  	echo '<script language="javascript">';
		echo 'alert("Need to input: '.$field.' to signUp");';
	echo 'window.location = "'.$signUpURL.'";';
	echo '</script>';
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
