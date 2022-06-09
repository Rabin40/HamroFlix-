<?php
    session_start();
    if(isset($_SESSION['account'])){
        session_abort();
        include('view-my-account.php');
    }
    else{
        session_abort();
        include('customer-login.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Account</title>
</head>
<body>
    
</body>
</html>
