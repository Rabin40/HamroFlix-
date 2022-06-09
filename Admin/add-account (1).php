<?php
session_start();
if(!isset($_SESSION['login'])){
    header('Location: login123.php');
}
include('header.php');

if(isset($_POST['ac-submit'])){

    $email = $_POST['addac-email'];
    $password = $_POST['addac-password'];
    $duration = $_POST['duration'];

    include('connection.php');

        //for duration
        $day = $duration;
        $duration1 = $duration."D";
        



    // inserting data into Accounts table
    $sql = "Insert into `accounts` (email, password, cdate, rdate, edate, duration ) VALUES ('$email', '$password', CURRENT_DATE() , DATE_ADD(CURRENT_DATE(), INTERVAL 30 DAY),  DATE_ADD(CURRENT_DATE(), INTERVAL $day DAY), '$duration' )";
    $qry = mysqli_query($conn, $sql);



    if($qry){
        
        $replacedEmail = str_replace("@outlook.com", "", strtolower($email));
        $replacedEmail = str_replace("@gmail.com", "", strtolower($replacedEmail));
       
        //creating and inserting keys
      
        $key1 = "B".$duration1.$replacedEmail."-".rand(1000000000,9999999999);
        $key2 = "Y".$duration1.$replacedEmail."-".rand(1000000000,9999999999);
        $key3 = "R".$duration1.$replacedEmail."-".rand(1000000000,9999999999);
        $key4 = "G".$duration1.$replacedEmail."-".rand(1000000000,9999999999);
        $key5 = "P".$duration1.$replacedEmail."-".rand(1000000000,9999999999);

        
        $key1 = strtoupper($key1);
        $key2 = strtoupper($key2);
        $key3 = strtoupper($key3);
        $key4 = strtoupper($key4);
        $key5 = strtoupper($key5);

        $qry = mysqli_query($conn, "Select * from `accounts` where email='$email' ");
        $row = mysqli_fetch_assoc($qry);
        $accountId = $row['id'];
        
        $sql = "Insert into `keys` (value, pin, accountId) VALUES ('$key1', 9955, $accountId)";
        $qry = mysqli_query($conn, $sql);
        $sql = "Insert into `keys` (value, pin, accountId) VALUES ('$key2', 6655, $accountId)";
        $qry = mysqli_query($conn, $sql);
        $sql = "Insert into `keys` (value, pin, accountId) VALUES ('$key3', 7575, $accountId)";
        $qry = mysqli_query($conn, $sql);
        $sql = "Insert into `keys` (value, pin, accountId) VALUES ('$key4', 8555, $accountId)";
        $qry = mysqli_query($conn, $sql);
        $sql = "Insert into `keys` (value, pin, accountId) VALUES ('$key5', 1122, $accountId)";
        $qry = mysqli_query($conn, $sql);

        header('Location:view-account.php?id='.$accountId );
    }
    else{
        echo "Error! cound not insert account. Somethig went wrong";
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Account</title>
    <link rel="stylesheet" href="../styles/styles.css">
</head>
<body>
<div class="login">
        <h2>Add Account</h2>
        <div class="line"></div><br>
        <form method="POST" action="" class="login-form">
            <input type="email" name="addac-email" id="login-username" placeholder="Email"><br>
            <input type="text" name="addac-password" id="login-password" placeholder="Password">
            <p>Duration:</p>
            <select name="duration" class="duration">
                <option value="30">1 months</option>
                <option value="88">3 months</option>
            </select>
            <input type="submit" name="ac-submit" value="Add" class="submit-login" /> 
        </form>
    </div>
</body>
</html>

