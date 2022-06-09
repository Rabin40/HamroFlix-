<?php
    include('../admin/header.php');
    $error = "";

    session_start();
    if(isset($_SESSION['account'])){
        header('Location: .');
    }

    if(isset($_POST['login-submit'])){
        $fname = $_POST['login-fname'];
        $pattern = '/[^a-zA-Z]/';
        $fname = preg_replace($pattern,"", $fname);
        
        
        $phone = $_POST['login-phone'];
        $pattern = '/[^0-9]/';
        $phone = preg_replace($pattern,"", $phone);

        include('../admin/connection.php');
        $sql = "Select * from `customer` where name = '$fname' && phone = '$phone' ";
        $qry = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($qry);

        if($count == 0){
            $error = "No account linked with mentioned name and phone. <a href = 'https://www.instagram.com/hamroflixnepal/'>Click here</a> to purchase new account";
        }
        else{
            $row = mysqli_fetch_assoc($qry);
            $cid = $row['id'];
            session_start();
            $_SESSION['account'] = $cid;
            header('location: .');
        }    
    }




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Account</title>
    <link rel="stylesheet" href="../styles/styles.css">
</head>
<body>
<div class="login">
        <h2>Enter Your Info</h2>
        <br>
        <p>The accounts linked with the given name and mobile number will be shown.</p>
        <div class="line"></div>
        <div id="login-error"><?php echo $error ?></div>
        <br>
        <form method="POST" action="" class="login-form">
            <p>Enter only your First Name :</p>
            <input type="text" name="login-fname" id="login-username" placeholder="Your First Name" onkeypress="return event.charCode != 32" required>
            <br>
            <p>Your Mobile Number: 98xxxxxxxx</p>
            <input type="tel" name="login-phone" id="login-username" placeholder="Your Mobile Number" required pattern="[98]{2}[0-9]{8}">
            <br>
            <input type="submit" name="login-submit" value="Get my Account" class="submit-login" />
            <br>
    </form>
        <p>Multiple accounts will be shown if same name and phone number is linked multiple times. </p><br/>
        <p><a href = 'https://www.instagram.com/hamroflixnepal/'>Click here</a> to purchase new account</p>
</div> 
</body>
</html>