<?php
session_start();
if(!isset($_SESSION['login'])){
    header('Location: login123.php');
}
include('header.php');

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    
    <div class="container">
    <h2>Hello, <?php echo $_SESSION['login'] ?></h2>
    <h3>Welcome to admin panel. You can add, update, or delete account. </h3>

    <div class="tasks">
        <a class="admin-links"  href="add-account.php">Add Account</a>
        <a class="admin-links" href="">Update Account</a>
        <a class="admin-links" href="">Search Account</a>
        <a class="admin-links" href="view-all-accounts.php">View All Account</a>
        <a class="admin-links" href="logout.php">Logout</a>
    </div>


    </div>
</body>
</html>