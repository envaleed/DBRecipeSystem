<?php

$email = $mysqli->escape_string($_POST['email']);
$result = $mysqli->query("SELECT * FROM user WHERE userEmail='$email'");

if ( $result->num_rows == 0 ){ 
    $_SESSION['message'] = "User with that email doesn't exist!";
    header("location: error.php");
}
else { 
    $user = $result->fetch_assoc();

    if ( ($_POST['password'] == $user['userPassword']) ) {
        
        $_SESSION['email'] = $user['userEmail'];
        $_SESSION['first_name'] = $user['userFname'];
        $_SESSION['last_name'] = $user['userLname'];
        
        $_SESSION['logged_in'] = true;

        header("location: profile.php");
    }
    else {
        $_SESSION['message'] = "You have entered wrong password, try again!";
        header("location: error.php");
    }
}

