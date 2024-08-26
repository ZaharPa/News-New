<?php
if (isset($_SESSION['role']) && ($_SESSION['role'] === 'admin'))
{  
    ?>


<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="UTF-8" />
		<title>NEW -<?php echo $title?></title>
		<link rel="icon" href="images/logo.jpg" type="image/x-icon" />
		<meta http-equiv="cache-control" content="no-cache">
		<meta http-equiv="expires" content="0">
		<meta http-equiv="pragma" content="no-cache">
		<link rel="stylesheet" href="styles/style.css">
	</head>
	<body>
		<nav>
        	<div class="menu-toggle" id="menuToggle">
            	<span class="bar"></span>
            	<span class="bar"></span>
            	<span class="bar"></span>
  	  		</div>
            <ul id="navMenu">
				<li><img src="images/logo.jpg" alt="logo New" height="50px" /></li>
				<li><a href="index.php?page=home">Main</a></li>
				<li><a href="index.php?page=admin">Admin Panel</a></li>
				<li><a href="index.php?page=addNews">Add News</a></li>
				<li><a href="#">Statistic</a></li>
				<li><a href="index.php?logOut">LogOut</a></li>
			</ul>
		</nav>
<?php }?>