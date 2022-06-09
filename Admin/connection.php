<?php
define("HOST", "localhost");
define("USER","hemantas_hamroflix");
define("PASSWORD", "hamroflix12@");
define("DB", "hemantas_hamroflix");


$conn = mysqli_connect(HOST, USER, PASSWORD, DB);
if(!$conn){
    echo "Error! Database connection failed";
}

?>