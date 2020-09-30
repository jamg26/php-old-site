<?php
// include auth.php file on all secure pages
include ("auth.php");
?>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="utf-8">
	<title>Contact | Jamg</title>
	<link rel="stylesheet" href="css/style.css" />
</head>
<div class="topnav">
	<a href="/">Home</a>
	<a href="/softwares.php">Softwares</a>
	<a href="/movie.php">Movies</a>
	<a href="/spotify.php">Spotify</a>
	<a class="active" href="/contact.php">Contact</a>
	<a href="/logout.php">Logout</a>
</div>

<?php
$add1 = rand(1, 10);
$add2 = rand(1, 10);
$succ = '';
$fail = '';
if (isset($_POST['comment'])) {
    $add = $_POST['fn'] + $_POST['sn'];
    if ($_POST['sec'] == $add) {
        $format = 'Username: <b>' . $_SESSION['username'] . '</b><br />Message:<br /><i>' . @$_POST["comment"] . '</i>';
        include_once ("mailto.php");
        if (!empty($_POST['comment'])) {
            mailto("Admin@jamgph.com", "JamgPH Admin", 'jammmg26@gmail.com', 'jamg', "JamgPH Message From User", $format);
            $succ = 'Message sent!';
        } else {
            // comment empty
            $fail = 'Comment cannot be empty';
        }
    } else {
        // invalid capthca
        $fail = 'Invalid CAPTCHA';
    }
} else {
}
?>
<html>
<form method="post" style="margin:30px">
		<h2>Contact Us</h2>
		<font color="green"><?php echo $succ;?></font>
		<font color="red"><?php echo $fail; ?></font><br />
		<textarea name="comment" rows="5" cols="40" placeholder="Message . . ."></textarea>
		<br />
		<input class="captcha" name="sec" placeholder="<?php echo $add1 . " + " . $add2; ?> = ?" size="4" required />
		<br /><font size="1">CAPTCHA</font>
		<input name="fn" type="hidden" value="<?php echo $add1; ?>" />
		<input name="sn" type="hidden" value="<?php echo $add2; ?>" />
		<br />
		<input type="submit" name="submit" value="Submit"> 
</form>
</html>