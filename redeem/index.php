<?php
    include('../admin/header.php');  
    $redeemError = "";

    if(isset($_POST['redeem-submit'])){
        $code = $_POST['redeem-code'];
        $code = trim($code);
        $pattern = '/[^a-zA-Z0-9\.@-]/';
        $code = preg_replace($pattern,"", $code);
        $code = strtoupper($code);

        include('../admin/connection.php');
        $sql = "Select * from `keys` WHERE value = '$code'";
        $qry = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($qry);
        if($count == 0 || empty($code)){
            $redeemError =  "Code not valid! <a href = 'https://www.instagram.com/hamroflixnepal/'>Click here</a> to purchase a code";
        }
        else{
            $row = mysqli_fetch_assoc($qry);
            $cid = $row['customerId'];
            
            if(!($cid == null)){
                $redeemError =  "The code has already been redemeed. <a href = '../my-account'>Click here</a> to view your account";
            }
            else{
                session_start();
                $_SESSION['redeem'] = $code;
                Header('Location:redeem-terms.php');
            }   
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redeem Your Code</title>
</head>
<body>
    <div class="login">
        <h2>Redeem Your Code</h2>
        <div class="line"></div>
        <div id="login-error"><?php echo $redeemError ?></div>
        <form method="POST" action="" class="login-form">
            <input type="text" name="redeem-code" id="login-username" placeholder="Enter your code" required="required">
            <input type="submit" name="redeem-submit" value="Redeem" class="submit-login" />
        </form>
    </div>
</body>
</html>


