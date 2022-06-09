<?php
    include('header.php');
    
    session_start();
    if(!isset($_SESSION['login'])){
        header('Location: login123.php');
    }

    include('connection.php');
    $sql = "SELECT * from  `accounts` ORDER BY id DESC";
    $qry = mysqli_query($conn, $sql);
    

    echo "<div style=\"width:1000px;margin: 0 auto\">";
    echo "<h1>All Accounts</h1><br>";
    echo "
        <table border=1 cellspacing = 0  style=\"font-size:18px;\">
            <tr style=\"padding:10px\">
                <th style=\"padding:5px;width:30px\">Id</th>
                <th >Email</th>
                <th >Password</th>
                <th >Created-ON</th>
                <th >Duration</th>
                <th>Action</th>
            </tr>
    ";

    while($row = mysqli_fetch_assoc($qry)){

        echo "<tr >
                <td style=\"padding:10px\">". $row['id']." </td>
                <td style=\"padding:10px\">". $row['email']." </td>
                <td style=\"padding:10px\">". $row['password']." </td>
               <td style=\"padding:10px\">". $row['cdate']." </td>
                <td style=\"padding:10px\">". $row['duration']." </td>
                <td style=\"padding:10px\"><a href=view-account.php?id=".$row['id'].">View Details</a></td> 
            </tr>


        ";

    }

    echo "</table></div>";

?>