<?php 
session_start();
if (isset($_SESSION["username"])) {
    header("Location: index.php");
    exit();
}
//logging in
require_once("php/loginRequest.php");
if (isset($_POST['username'])) {
    if(login($_POST['username'], $_POST['password'])) {
        //success login
        header("Location: index.php");
    } else {
        
    } 
} 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>JamgPH | Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
</head>

<body>
<!-- start border style -->
<div id="loginContainer" class="container">
	<div class="row-full loginPadding shadow bg-white rounded">	
	<div class="col-md">
<!-- end border style / begin login form -->
		<h1>Login</h1>
		<form action="" name="Login" method="POST" >
		<div id="fLogin" class="alert alert-danger" role="alert">This is a danger alert with <a href="#" class="alert-link">an example link</a>. Give it a click if you like.</div>
		  	<div class="form-group">
	    		<label for="inputUser"><i class="fas fa-user fa-sm"></i> Username</label>
    			<input name="username" type="text" class="form-control" id="username" placeholder="Enter username">
    		</div>
		  	<div class="form-group">
	    		<label for="inputUser"><i class="fas fa-key fa-sm"></i> Password</label>
    			<input name="password" type="password" class="form-control" id="password" placeholder="Enter password">
    			
    		</div>
    		
    		<button id="loginButton" name="submit" type="submit" class="btn btn-dark" value="Login">Login</button>
	  	</form>
	 </div>
	</div> <!-- loginPadding -->
</div> <!-- flex container -->


<!-- Javascript begin -->
<script>
$(document).ready(function() {
	$("#loginButton").click(function() {
		$(this).hide();
	});
	
});
</script>


</body>
</html>



