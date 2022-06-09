<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HamroFlix Login</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php
        $loginError = "";
        session_start();
        if(isset($_SESSION['login'])){
            header('Location: admin-panel.php');
        }

        include('header.php');
        
        if(isset($_POST['login-submit'])){

            
            $username = $_POST['login-username'];
            $pattern = '/[^a-zA-Z0-9]+/';
            $username = preg_replace($pattern,"", $username);

            $password = md5($_POST['login-password']);

            $pass = md5($password);
            $pass1 = md5($pass);
            
            include('connection.php');
            $sql = "select * from `user-admin` WHERE username='$username'  && password='$pass1' ";



           
            $qry = mysqli_query($conn, $sql);

            $count = mysqli_num_rows($qry);


            if($count == 1){
                $_SESSION['login'] = $username;
                header("Location: admin-panel.php");
            }
            else{
                $loginError = "User not found!";
            }
        }


    ?>

    <div class="login">
        <h2>Login</h2>
        <div class="line"></div>
        <div id="login-error"><?php echo $loginError ?></div>
        <form method="POST" action="" class="login-form">
            <input type="text" name="login-username" id="login-username" placeholder="Username">
            <input type="password" name="login-password" id="login-password" placeholder="Password">
            <input type="submit" name="login-submit" value="Login" class="submit-login" />
        </form>
    </div>
</body>
</html>