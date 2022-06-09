<?php
session_start();
if(!isset($_SESSION['login'])){
    header('Location: login123.php');
}
include('header.php');

if(isset($_GET['id'])){
    $accountId = $_GET['id'];
}
include('connection.php');

$sql = "Select * from `accounts` where id = $accountId";
$qry = mysqli_query($conn, $sql);
$accountrow = mysqli_fetch_assoc($qry);

$email = $accountrow['email'];
$password = $accountrow['password'];
$createdDate = $accountrow['cdate'];
$endDate = $accountrow['edate'];


$sql = "Select * from `keys` where accountId = $accountId";
$qry = mysqli_query($conn, $sql);

echo "<div style=\"width:1000px;margin:auto auto\">";

echo "<form action =\"\" method = \"POST\">";

echo "<h2 style=\"text-align:center;\">Email: <input type=\"text\" name=\"up_email\" value =$email> </h2>".
     "<h2 style=\"text-align:center;\">Password: <input type=\"text\" name=\"up_password\" value =$password></h2>".
     "<br>".
     "<h3>Created on: <input type=\"date\" name=\"up_cdate\" value = \"$createdDate\"> ".
     "<span style=\"float:right;\">End on: <input type=\"date\" name=\"up_edate\" value = \"$endDate\"></span></h3>";

$keycount = 1;

echo "
<table border=1 cellspacing=0 style=\"font-size:18px;\">
<tr style=\"padding:5px 10px;\" >
    <th style=\"padding:5px 10px;width:500px\">Value</th>
    <th style=\"padding:5px 10px;width:100px\">Profile Pin</th>
    <th style=\"padding:5px 10px;width:120px\">Redeemed Date</th>
    <th style=\"padding:5px 10px;width:120px\">Valid till</th>
    <th style=\"padding:5px 10px;width:200px\">Redeem Details</th>

</tr>

";

while($row = mysqli_fetch_assoc($qry)){
    
    if($keycount == 1){
        $color = "blue";
    }
    elseif($keycount == 2){
        $color = "#999900";
    }
    elseif($keycount == 3){
        $color = "red";
    }
    elseif($keycount == 4){
        $color = "green";
    }
    
    
    echo "
        <tr style=\"color:$color\">
            <td style=\"padding:5px 10px\"><input type=\"text\" value = ".$row['value']." > </td>
            <td style=\"padding:5px 10px\"><input type=\"text\" value = ".$row['pin']."> </td>
            <td style=\"padding:5px 10px\"><input type=\"date\" value = ".$row['redeemdate']."> </td>
            <td style=\"padding:5px 10px\"><input type=\"date\" value = ".$row['endDate']."> </td>";
            
            if($row['customerId'] == null){
                echo "<td style=\"padding:5px 10px\">Not redeemed</td>";
            }
            else{
                $cid = $row['customerId'];
                $sql1 = "Select * from `customer` where id = $cid";
                $qry1 = mysqli_query($conn, $sql1);
                $row1 = mysqli_fetch_assoc($qry1);

                echo "<td style=\"padding:5px 10px\"> Name: ". $row1['name']. "<br> 
                          Phone:       ".$row1['phone']."</td>";
            }


        echo "</tr>";


    $keycount++;
}

echo "</table>";

echo "<br><a class = \"\" href=\"\">Save</a>";
echo "<a style=\"float:right\" class = \"\" href=\"\">Delete Account</a>";


echo "</div>"


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Account</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    
</body>
</html>

