<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
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
        echo '<div class="d-flex flex-column justify-content-between">';
        while($stmt->fetch()){
                echo '<form action="viewMoreRestaurantInfo.php" method="post">
                        <input type="hidden" name="restaurant_id" value="'.$restaurant_id.'">
                        <input type="hidden" name="userName" value="'.$_GET['userName'].'">
                        <input type="hidden" name="password" value="'.$_GET['password'].'">
                        <button class="btn btn-link" type="submit" value="View More">'.$restName.'</button>
                        </form>';
        }
        echo '</div>'; 
        $stmt->close();    
?>

