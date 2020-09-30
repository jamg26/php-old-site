<?php
session_start();
$mail = '';
include_once ("mailer.php");
if (isset($_SESSION["username"])) {
    header("Location: /");
    exit();
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta charset="utf-8">
		<title>Login | Jamg</title>
		<link rel="stylesheet" href="css/style.css" />
		<link rel="stylesheet" href="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css">
		<link href="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.min.css" rel="stylesheet">
		<script src='https://www.google.com/recaptcha/api.js'></script>
	</head>
	<body>
	<script src="https://www.google.com/recaptcha/api.js" async defer></script>
	<?php
$con = '';
require ('../htprivate/db.php');
$add1 = rand(1, 10);
$add2 = rand(1, 10);
$fn = @$_POST['fn'];
$sn = @$_POST['sn'];
$add = $fn + $sn;
$inv = '';
$invcaptcha = '';
if (@$_POST['sec'] == $add) {
    if (isset($_POST['username'])) {
        // removes backslashes
        $username = stripslashes($_REQUEST['username']);
        //escapes special characters in a string
        $username = mysqli_real_escape_string($con, $username);
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($con, $password);
        //Checking is user existing in the database or not
        $query = "SELECT * FROM `users` WHERE username='$username'
							and password='" . md5($password) . "'";
        $result = mysqli_query($con, $query) or die(mysql_error());
        $rows = mysqli_num_rows($result);
        if ($rows == 1) {
            $_SESSION['username'] = $username;
            // Redirect user to index.php
            header("Location: /");
            $mail->setFrom('Admin@jamgph.com', 'JamgPH Admin');
            //Set an alternative reply-to address
            $mail->addReplyTo('Admin@jamgph.com', 'JamgPH Admin');
            //Set who the message is to be sent to
            $mail->addAddress('jammmg26@gmail.com', 'Jamg');
            //Set the subject line
            $mail->Subject = 'JamgPH Login logs';
            //Read an HTML message body from an external file, convert referenced images to embedded,
            $mail->msgHTML($_SESSION['username'] . " has logged in.");
            //send the message, check for errors
            if (!$mail->send()) {
                // sending failed
                
            } else {
                // message sent
                
            }
        } else {
            $inv = 'Invalid username or password';
        }
    } else {
    }
} else {
    //captcha false
    $invcaptcha = 'Invalid CAPTCHA';
}
?>
		 
			<div class="form">
				<div id="login"><h1>Log In</h1></div>
				<form action="" method="POST" name="login">
					<font color="red"><?php echo $inv . $invcaptcha; ?></font>
					<input type="text" name="username" placeholder="Username" required >
					<input type="password" name="password" placeholder="Password" required >
					<input type="text" name="sec" placeholder="<?php echo $add1 . " + " . $add2; ?> = ?" required />
					<input name="fn" type="hidden" value="<?php echo $add1; ?>" />
					<input name="sn" type="hidden" value="<?php echo $add2; ?>" />
					<br><font size="2">Forgot password? <a href='forgot.php'>Reset Password</a></font><br>
					<input name="submit" type="submit" value="Login" />
				</form>
				
				<br>	
				<button class="btn" onclick="window.location.href='registration.php'"><div>Register</div></button><br>
				</div>
	</body>
</html>