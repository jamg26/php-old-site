<?php
$con = '';
$mail = '';
require ('../htprivate/db.php');
include ("auth.php");
$file = file_get_contents('counter.txt');
$users = 'jamg09123/user.txt';
$limit = count(file($users));
if ($file < $limit) {
    $lines = file('jamg09123/user.txt');
    $u = $lines[$file];
    //selecting email from user
    $usrr = $_SESSION['username'];
    $query = "SELECT * FROM users WHERE username = '$usrr'";
    $result = $con->query($query);
    if (mysqli_query($con, $query)) {
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $em = $row['email'];
        } else {
            echo "0 results";
        }
    } else {
        echo 'DB FAILED';
    }
    //sending email
    $text = str_replace(':', "<br>Password: ", $u); //format email
    $msg = "Email: " . $text . "<br><br>Regards,<br> Admin.";
    file_put_contents('counter.txt', $file + 1);
    include_once ("mailer.php");
    $mail->setFrom('Admin@jamgph.com', 'JamgPH Admin');
    $mail->addAddress($em, 'Jamg');
    $mail->Subject = 'JamgPH Spotify Premium';
    $mail->msgHTML($msg);
    if (!$mail->send()) {
        //failed
        
    } else {
        // message sent
        
    }
    echo '<script>alert("Spotify Premium has been sent to your email!");window.location="/";</script>';
} else {
    echo '<script>window.location.href = "generated/error.php";</script>';
}
?>