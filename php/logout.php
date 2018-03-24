<?php
   ob_start();
   session_start();
   unset($_SESSION["userName"]);
   unset($_SESSION["password"]);
   echo 'Successfully Logged Out';
   header('Refresh: 2; URL = ../index.html');
?>