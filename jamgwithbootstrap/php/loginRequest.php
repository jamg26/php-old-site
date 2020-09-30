<?php
function login($user, $pass) {
    $con = '';
    require ('../../htprivate/db.php');
    // removes backslashes
    $username = stripslashes($user);
    //escapes special characters in a string
    $username = mysqli_real_escape_string($con, $username);
    $password = stripslashes($pass);
    $password = mysqli_real_escape_string($con, $password);
    //Checking is user existing in the database or not
    $query = "SELECT * FROM `users` WHERE username='$username' and password='" . md5($password) . "'";
    $result = mysqli_query($con, $query) or die(mysql_error());
    $rows = mysqli_num_rows($result);
    if ($rows == 1) {
        $_SESSION['username'] = $username;
        return true;
    } else {
        return false;
    }
}
?>