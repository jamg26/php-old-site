<?php
//include auth.php file on all secure pages
include ("auth.php");
?>
<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/style.css" />
    <meta charset="utf-8">
    <title>Home | Jamg
    </title>
  </head>
  <div class="topnav">
    <a class="active" href="/">Home
    </a>
    <a href="/softwares.php">Softwares
    </a>
    <a href="/movie.php">Movies
    </a>
    <a href="/spotify.php">Spotify
    </a>
    <a href="/contact.php">Contact
    </a>
    <a href="/logout.php">Logout
    </a>
  </div>
  <p style="margin:30px">Hello 
    <?php echo $_SESSION['username']; ?>,
  </p>
  <p style="margin:30px">This website is for educational purposes only. If you have questions or concern 
    <a href="contact.php">Contact Us
    </a>
  </p>
</html>
