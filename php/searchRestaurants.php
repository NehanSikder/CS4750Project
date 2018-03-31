<?php
        include_once("./library.php"); // To connect to the database
        $con = new mysqli($SERVER, $USERNAME, $PASSWORD, $DATABASE);
        // Check connection
        if (mysqli_connect_errno())
        {
          echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }

        $stmt = $con->prepare("select * from restaurant where restName like ?");
        $searchString = '%' . $_GET['search'] . '%';
        $stmt->bind_param(s, $searchString);
        $stmt->execute();
        $stmt->bind_result($restaurant_id,$restName,$hours,$avg_rating);
        echo "<div class=\"d-flex flex-column justify-content-around\">\n";
        while($stmt->fetch()){
                echo "<a href=\"#\">$restName</a>";
        }
        echo "</div>"; 
        $stmt->close();    
?>