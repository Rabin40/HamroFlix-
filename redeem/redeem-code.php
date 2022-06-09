<?php
    include('../admin/header.php');

    session_start();
    if(!isset($_SESSION['redeem'])){
        header('Location: .');
    }

    $redeemError = "";
    if(isset($_POST['redeem-submit'])){
        $fname = $_POST['redeem-fname'];
        $pattern = '/[^a-zA-Z]/';
        $fname = preg_replace($pattern,"", $fname);
        
        
        $phone = $_POST['redeem-phone'];
        $pattern = '/[^0-9]/';
        $phone = preg_replace($pattern,"", $phone);

        include('../admin/connection.php');
        $sql = "Select * from `customer` where name = '$fname' && phone = '$phone' ";
        $qry = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($qry);

        if($count == 0){
            $sql = "Insert into `customer` (name, phone) VALUES ('$fname', '$phone')";
            $qry = mysqli_query($conn, $sql);            
        }

        $sql = "Select * from `customer` where name = '$fname' && phone = '$phone' ";
        $qry = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($qry);
        $cid = $row['id'];
        



        $code = $_SESSION['redeem'];
        $sql = "Select * from `keys` where value = '$code' ";
        $qry = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($qry);
        $aid = $row['accountId'];
        echo $aid;

        $sql = "Select * from `accounts` where id ='$aid' ";
        $qry = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($qry);
        $duration = $row['edate'];


        $sql = "Update `keys` SET customerId = '$cid', redeemdate=CURRENT_DATE(), endDate = '$duration' where value = '$code' ";
        $qry = mysqli_query($conn, $sql);

        unset($_SESSION['redeem']);
        $_SESSION['account'] = $cid;
        header('Location: ../my-account');
        
    }

    

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redeem Code</title>
    <link rel="stylesheet" href="../styles/styles.css">
</head>
<body>

<div class="login">
        <h2>Provide Your Info</h2>
        <br>
        <p>The name and mobile number will be linked to your account and will act as your login credentials</p>
        <div class="line"></div>
        <div id="login-error" style="color:red"><?php echo $redeemError ?></div>
        <br>
        <form method="POST" action="" class="login-form">
            <p>Enter only your First Name :</p>
            <input type="text" name="redeem-fname" id="login-username" placeholder="Your First Name" onkeypress="return event.charCode != 32" required>
            <br>
            <p>Your Mobile Number: 98xxxxxxxx</p>
            <input type="tel" name="redeem-phone" id="login-username" placeholder="Your Mobile Number" required pattern="[98]{2}[0-9]{8}">
            <br>
            <input type="submit" name="redeem-submit" value="Link my Account" class="submit-login" />
            <br>
    </form>
        <p>Multiple accounts can be linked to same name and phone number. </p><br/>
        <p>You will be notified via SMS to the given number if there is any changes made to the account.</p>
    </div>

</body>
</html>