<?php
require ("../htprivate/db.php");
$add1 = rand(1, 10);
$add2 = rand(1, 10);
$fn = @$_POST['fn'];
$sn = @$_POST['sn'];
$add = $fn + $sn;
$con = '';
$er = '';
$suc = '';
$info = 'Enter username or email';
require ('../htprivate/db.php');
if (@$_POST['sec'] == $add) {
    if (!empty($_POST["forgot-password"])) {
        $condition = "";
        if (!empty($_POST["user-login-name"])) $condition = " username = '" . $_POST["user-login-name"] . "'";
        if (!empty($_POST["user-email"])) {
            if (!empty($condition)) {
                $condition = " and ";
            }
            $condition = " email = '" . $_POST["user-email"] . "'";
        }
        if (!empty($condition)) {
            $condition = " where " . $condition;
        }
        $sql = "Select * from users " . $condition;
        $result = mysqli_query($con, $sql);
        $user = mysqli_fetch_array($result);
        if (!empty($user)) {
            // sending key to email
            if (!isset($_SESSION)) {
                session_start();
            }
            $ke = rand(100000000, 999999999);
            $_SESSION['key'] = $ke;
            $usr = $user["username"];
            $_SESSION['us'] = $usr;
            $emailBody = "<div>Good day " . $user["username"] . ",<br><p>Click this link to recover your password<br><a href='https://jamgph.com/reset_password.php?name=" . $user["username"] . "&key=" . $_SESSION['key'] . "'>https://jamgph.com/reset_password.php?name=" . $user["username"] . "&key=" . $_SESSION['key'] . "</a><br><br></p>Regards,<br> Admin.</div>";
            include_once ("mailto.php");
            mailto("Admin@jamgph.com", "JamgPH Admin", $user['email'], $user['username'], "JamgPH Reset Password", $emailBody);
            $suc = 'Please check your email and click the link!';
            $info = '';
        } else {
            $er = 'No username or email found!';
            $info = '';
        }
    }
} else {
    $er = 'Invalid Captcha!';
    $info = '';
}
?>



<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="utf-8">
	<title>Forgot Password | Jamg</title>
	<link rel="stylesheet" href="css/style.css" />
	<script src='https://www.google.com/recaptcha/api.js'></script>
</head>
<div class="form">
<form name="frmForgot" id="frmForgot" method="post" onSubmit="return validate_forgot();">

<br><h1>Forgot Password?</h1>
	<font color="red"><?php echo $er; ?></font>
	<font color="green"><?php echo $suc; ?></font>
	<font color="black"><?php echo $info; ?></font>
	
	<input type="text" name="user-login-name" id="user-login-name" class="input-field" placeholder="Username">
	<input type="text" name="user-email" id="user-email" class="input-field" placeholder="Email">
	<input type="text" name="sec" placeholder="<?php echo $add1 . " + " . $add2; ?> = ?" required />
	
	
	<input name="fn" type="hidden" value="<?php echo $add1; ?>" />
	<input name="sn" type="hidden" value="<?php echo $add2; ?>" />
	<div class="field-group">
		<div><input type="submit" name="forgot-password" id="forgot-password" value="Submit" class="form-submit-button"></div>
		<br><a href="/">Back</a>
	</div>	
</form>
</div>

