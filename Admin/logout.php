<?php
session_start();
if(!isset($_SESSION['login'])){
    header('Location: login123.php');
}

//to destroy the session
//unset($_SESSION['username']); 

//session_destroy();
session_destroy();
header('Location: login123.php');

?>