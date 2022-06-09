<?php
    session_start();
    if(!isset($_SESSION['account'])){
        header('Location: .');
    }

    include('../admin/header.php');
    $cid = $_SESSION['account'];
    $sql = "Select * from `keys` where customerId = $cid ORDER BY id DESC";
    include('../admin/connection.php');
    $qry = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($qry);
    
    
    
    $sqll = "Select * from `customer` where id = $cid ";
    $qryy = mysqli_query($conn, $sqll);
    $roww = mysqli_fetch_assoc($qryy);
    $name = $roww['name'];
    $phone = $roww['phone'];



    echo "<div class=\"login\" style=\"width: 950px\" >
    <h2>My Accounts</h2>
    <div class=\"line\"></div>
    <h3>Name: $name</h3>
    <h3>Phone: $phone</h3>

    
    <p>$count account found</p>

    <table border=1 cellspacing=0 style=\"font-size: 20px\" >
        <tr>
            <th style=\"width: 300px; padding:5px\">Email</th>
            <th style=\"width: 200px; padding:5px\">Password</th>
            <th style=\"width: 150px; padding:5px\">Allocated Profile</th>
            <th style=\"width: 120px; padding:5px\">Profile Pin</th>
            <th style=\"width: 150px; padding:5px\">End Date</th>
        <tr/>";
        while($row = mysqli_fetch_assoc($qry)){
            $aid = $row['accountId'];
            $sql1 = "Select * from `accounts` WHERE id = $aid";
            $qry1 = mysqli_query($conn, $sql1);
            $row1 = mysqli_fetch_assoc($qry1);
            $email = $row1['email'];
            $password = $row1['password'];
            $profileName = $row['value'];

            if($profileName[0] == "R"){
                $profileName = "Red";
            }
            elseif($profileName[0] == "B"){
                $profileName = "Blue";
            }
            elseif($profileName[0] == "Y"){
                $profileName = "Yellow";
            }
            elseif($profileName[0] == "G"){
                $profileName = "Green";
            }
            elseif($profileName[0] == "P"){
                $profileName = "Pink";
            }

            


            
            $profilePin = $row['pin'];

            $accExpDate = $row['endDate'];
            $todaydate = date("Y-m-d");
            
            
            if($accExpDate >= $todaydate ){
                $date = $accExpDate;
            }
            else{
                $date = "Expired on ".$accExpDate;
            }
            
            


            echo "
                <tr>
                    <td style=\"width: 300px; padding:5px\">$email</td>
                    <td style=\"width: 200px; padding:5px\">$password</td>
                    <td style=\"width: 150px; padding:5px\">$profileName</td>
                    <td style=\"width: 120px; padding:5px\">$profilePin</td>
                    <td style=\"width: 150px; padding:5px\">$date</td>
                </tr>
            ";
        }
echo "

    </table>

    <br><br>

    <h4>Go to netflix.com or download the netflix app to start watching.</h4>
    <br><br>
    <h4>Getting Troubles? Contact us first, our admin will provide you best possible solution</h4>
    <br><br>
    <h4>For each account, a profile (either red,blue, yellow or green) has been allocated to you. Make sure you use only your profile.</h4>
    <p>Trying to access others profile will lead to violating our rule and you may get banned</p>
    <p>Also remember, you are not allowed to change any of the account details</p>
    <br><br>
    <h4>You will be notified via SMS each time whenever there is change in account password.</h4>
    <br><br>
    <button onclick=\"window.location.href='view-another.php'\" class=\"view-another\">View Another</button>
</div> ";



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
    
</body>
</html>