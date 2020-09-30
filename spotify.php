<?php
include("auth.php");
?>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/style.css" />
	<title>Premium Generator | Jamg</title>
</head>
<div class="topnav">
	<a href="/">Home</a>
	<a href="/softwares.php">Softwares</a>
	<a href="/movie.php">Movies</a>
	<a class="active" href="/spotify.php">Spotify</a>
	<a href="/contact.php">Contact</a>
	<a href="/logout.php">Logout</a>
</div>
<body>
	<div style="margin:30px">
		<p id="info"> As of <?php
echo date("m-d-Y");
?><br></p>
		Click generate to request one <br>
				<script type="text/javascript">
					var ss = 31;
					var fs = require('fs');
					function countdown() {
						ss = ss-1;
						document.getElementById('gen').style.visibility = 'hidden';
						document.getElementById('cdInfo').style.visibility = 'visible';
						if (ss<0) {
							window.location.replace('gen.php');
						}
						else {
							document.getElementById("countdown").innerHTML=ss;
							window.setTimeout("countdown()", 1000);
						}
					}
				</script>
					<br>
					<button onclick="countdown(); " id="gen">Generate</button>
					 <table style="text-align:center;">
						<tr><td id="cdInfo">Generating premium account <h2 id="countdown"></h2></td></tr>
					</table>
					<script type="text/javascript">document.getElementById('cdInfo').style.visibility = 'hidden';</script>
		
	</div>
</body>