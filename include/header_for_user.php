<?php ?>

<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="UTF-8" />
        <title>New - <?php echo $title?></title>
        <link rel="icon" href="images/logo.jpg" type="image/x-icon" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="cache-control" content="no-cache">
        <meta http-equiv="expires" content="0">
        <meta http-equiv="pragma" content="no-cache">
        <link rel="stylesheet" href="styles/style.css" />
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
                <li><a href="index.php?page=newsOfDay">News of a day</a></li>
                <li><a href="index.php?page=aboutUs">Support</a></li>
                <?php if (isset($_SESSION['role']) && ($_SESSION['role'] === 'admin')) {?>
                	<li><a href="index.php?page=admin">Admin panel</a></li>
                <?php }?>
                <?php if (!isset($_SESSION['role'])) { ?>
                    <li><a href="index.php?page=login">Login</a></li>
                    <li><a href="index.php?page=register">Register</a></li>
                <?php } else { ?>
                    <li><a href="index.php?logOut">LogOut</a></li>
                <?php } ?>
            </ul>
        </nav>
        <script>
    document.getElementById('menuToggle').addEventListener('click', function() {
        var menu = document.getElementById('navMenu');
        var toggle = document.getElementById('menuToggle');
        
        menu.classList.toggle('active');
        toggle.classList.toggle('active');
    });
</script>