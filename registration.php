<?php
session_start();
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
		<title>Registration</title>
		<link rel="stylesheet" href="css/style.css" />
		<script src='https://www.google.com/recaptcha/api.js'></script>
	</head>
	
	
	<body>
		
		<?php
{ // disable register
    $disreg = 0;
    if ($disreg == 1) {
        header('Location:err/reg/index.html');
    }
}
$con = '';
require('../htprivate/db.php');
$add1         = rand(1, 10);
$add2         = rand(1, 10);
$fn           = @$_POST['fn'];
$sn           = @$_POST['sn'];
$add          = $fn + $sn;
$pwMismatched = ''; //error
$dupInfo      = ''; //error
$invCaptcha   = ''; //error
$succ         = ''; //success
if (@$_POST['sec'] == $add) {
    if (isset($_REQUEST['username'])) {
        // removes backslashes
        $username  = stripslashes($_REQUEST['username']);
        //escapes special characters in a string
        $username  = mysqli_real_escape_string($con, $username);
        $email     = stripslashes($_REQUEST['email']);
        $email     = mysqli_real_escape_string($con, $email);
        $password  = stripslashes($_REQUEST['password']);
        $password  = mysqli_real_escape_string($con, $password);
        $trn_date  = date("Y-m-d H:i:s");
        $query     = "INSERT into `users` (username, password, email, trn_date)
					VALUES ('$username', '" . md5($password) . "', '$email', '$trn_date')";
        $password2 = $_REQUEST['password2'];
        
        if ($password == $password2) {
            
            $mail     = $_POST['email'];
            $user     = $_POST['username'];
            $a        = "SELECT * FROM users WHERE email = '$mail' OR username = '$user'";
            $res      = mysqli_query($con, $a);
            $num_rows = mysqli_num_rows($res);
            
            
            if ($num_rows) { // already in use?
                //duplicate id email
                $dupInfo = 'Duplicate email or password!';
                
            } else {
                //email is alright and no error
                //users is alright and no error
                $result = mysqli_query($con, $query);
                if ($result) {
                    $succ = 'Success! Please <a href="/">Login</a>';
                    $msg  = 'Hi <b>' . $_POST["username"] . '</b> thanks for creating your account. Have a good day!';
                    include_once("mailer.php");
                    $mail->setFrom('Admin@jamgph.com', 'JamgPH Admin');
                    //Set an alternative reply-to address
                    $mail->addReplyTo('Admin@jamgph.com', 'JamgPH Admin');
                    //Set who the message is to be sent to
                    $mail->addAddress($_POST['email'], 'Jamg');
                    //Set the subject line
                    $mail->Subject = 'Welcome';
                    //Read an HTML message body from an external file, convert referenced images to embedded,
                    $mail->msgHTML($msg);
                    //send the message, check for errors
                    if (!$mail->send()) {
                        // sending failed
                    } else {
                        // message sent
                    }
                    
                } else {
                }
            }
            
            
        } else {
            //if password not matched 
            $pwMismatched = 'Password mismatched!';
        }
        
    }
} else {
    $invCaptcha = 'Invalid CAPTCHA!';
}

?>
				<!-- FORM GOES HERE -->
				<div class="form">
					<h1>Registration</h1>
					<form name="registration" action="" method="post">
						<font color="red"><?php echo $dupInfo . $invCaptcha . $pwMismatched; ?></font>
						<font color="green"><?php echo $succ; ?></font>
			            <input type="text" name="username" placeholder="Username" required />
						<input type="email" name="email" placeholder="Email" required />
						<input type="password" name="password" placeholder="Password" required />
						<input type="password" name="password2" placeholder="Re-type Password" required />
						<input type="text" name="sec" placeholder="<?php echo $add1 . " + " . $add2; ?> = ?" required />
						<input name="fn" type="hidden" value="<?php echo $add1; ?>" />
						<input name="sn" type="hidden" value="<?php echo $add2; ?>" />
						<br>
						<input type="submit" name="submit" value="Register" /><br><br>
						<a href="/">Back</a>
					</form>
				</div>
				<?php ?>
	</body>
</html>