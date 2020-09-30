<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="utf-8">
	<title>Reset Password | Jamg</title>
	<link rel="stylesheet" href="css/style.css" />
	<script src='https://www.google.com/recaptcha/api.js'></script>
</head>
<?php
$con = $success_message = $error_message = '';
require("../htprivate/db.php");
if (!isset($_SESSION)) {
    session_start();
}

$kee         = @$_SESSION['key'];
$uss         = @$_SESSION['us'];
$link        = 'https://jamgph.com/reset_password.php?name=' . $uss . '&key=' . $kee;
$actual_link = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
if ($link != $actual_link) {
    exit("<font color='red' size='20'>Invalid Session</font>");
}


if (isset($_POST["reset-password"])) {
    $sql = "UPDATE `jamg`.`users` SET `password` = '" . md5($_POST["member_password"]) . "' WHERE `users`.`username` = '" . $_GET["name"] . "'";
    mysqli_query($con, $sql);
    session_destroy();
    $success_message = 'Password successfully changed.';
}

?>

<script>
function validate_password_reset() {
	if((document.getElementById("member_password").value == "") && (document.getElementById("confirm_password").value == "")) {
		document.getElementById("validation-message").innerHTML = "<font color='red'>Please enter new password!</font>"
		return false;
	}
	if(document.getElementById("member_password").value  != document.getElementById("confirm_password").value) {
		document.getElementById("validation-message").innerHTML = "<font color='red'>Both password should be same!</font>"
		return false;
	}
	
	return true;
}
</script>
<div class="form">
<form name="frmReset" id="frmReset" method="post" onSubmit="return validate_password_reset();">
<br><h1>Reset Password</h1>
	<font color="green"><?php echo $success_message; ?></font>
	<font color="red"><?php echo $error_message; ?></font>
	<div class="field-group">
		<input type="password" name="member_password" id="member_password" class="input-field" placeholder="Password"></div>
	
	
	<div class="field-group">
		<input type="password" name="confirm_password" id="confirm_password" class="input-field"  placeholder="Re-enter Password"></div>
	
	
	<div class="field-group">
		<input type="submit" name="reset-password" id="reset-password" value="Reset Password" class="form-submit-button"></div>
	
	
</form>
</div>