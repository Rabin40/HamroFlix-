<?php
    include('../admin/header.php');
    session_start();
    if(!isset($_SESSION['redeem'])){
        header('Location: .');
    }
    $message = "1) I agree that i will watch only at 1 device at a time. <br/>
                2) I agree that i will not change any of the account details. <br/>
                3) I agree that i will not share the account details to other person.";


    echo "<div class=\"login\">
        <h2>Agree to Terms</h2>
        <p>You must agree to our terms to proceed</p>
        <div class=\"line\"></div>
        <h3>$message</h3>      
        <br/>
        <p>*Violating our terms may lead to ban you from the account without warning. </p>
        <br/>
        <button onclick=\"window.location.href='redeem-code.php'\" class=\"submit-login\">I agree</button>
       </div>";  
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redeem Terms</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

</body>
</html>

