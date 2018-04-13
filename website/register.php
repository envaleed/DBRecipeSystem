<?php


$_SESSION['email'] = $_POST['email'];
$_SESSION['first_name'] = $_POST['firstname'];
$_SESSION['last_name'] = $_POST['lastname'];

$first_name = $mysqli->escape_string($_POST['firstname']);
$last_name = $mysqli->escape_string($_POST['lastname']);
$email = $mysqli->escape_string($_POST['email']);
$password = $mysqli->escape_string($_POST['password']);
      

$result = $mysqli->query("SELECT * FROM user WHERE UserEmail='$email'") or die($mysqli->error());


if ( $result->num_rows > 0 ) {
    
    $_SESSION['message'] = 'User with this email already exists!';
    header("location: error.php");
    
}
else { 
    
    $sql = "INSERT INTO user (userID, userEmail, userFname,userLname,userPassword) VALUES ('','$email','$first_name','$last_name','$password')";


    if ( $mysqli->query($sql) ){

        $_SESSION['logged_in'] = true; 
        $_SESSION['message'] = "Your account has been created!";

        header("location: profile.php"); 

    }

    else {
        $_SESSION['message'] = 'Registration failed!';
        header("location: error.php");
    }

}