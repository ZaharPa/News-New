<?php
require 'vendor/autoload.php';

use scripts\class\Reader;
use scripts\Database;


if (!empty($_POST)){
    $name = htmlspecialchars($_POST['nameUser'], ENT_QUOTES, 'UTF-8');
    $email = filter_input(INPUT_POST, 'emailUser', FILTER_SANITIZE_EMAIL);
    if ($_POST['phoneUser'])
        $phone = htmlspecialchars($_POST['phoneUser'], ENT_QUOTES, 'UTF-8');
    if (strlen($_POST['passUser']) >= 8 && strlen($_POST['passUser']) <= 20) 
    {
        $password = trim($_POST['passUser']);
        $curUser = new Reader;
        $link = Database::getLink();
        
        if (!empty($_POST['phoneUser']))
            $curUser->reg_user($link, $name, $password, $email, $phone);
        else $curUser->reg_user($link, $name, $password, $email);
        $_SESSION['role'] = $curUser->get_role();
        $_SESSION['name'] = $curUser->get_name();
        if (isset($_SESSION['role']))
            header("Location: index.php");
    } else {
        echo '<script language="javascript">';
        echo 'alert("Пароль не вірний")';
        echo '</script>';
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
    	<meta charset="UTF-8" />
    	<title>New - Registration</title>
    	<link rel="icon" href="images/logo.jpg" type="image/x-icon" />
    	<meta http-equiv="cache-control" content="no-cache">
    	<meta http-equiv="expires" content="0">
    	<meta http-equiv="pragma" content="no-cache">
    	<link rel="stylesheet" href="styles/style.css" />
    </head>
    <body>
    	<div class="reg">
        	<p>REGISTRATION</p>
        	<p>Input your data</p>
        	<form action="registration.php" method="post">
        		<label>Name  </label> <input type="text" name="nameUser" required>
        		<br>
        		<label>Password</label> <input type="password" name="passUser" title="123" required>
        		<br>
        		<span class="passtiptext">Must be 8-20 characters long.</span>
        		<br>
        		<br>
        		<label>Email  </label> <input type="email" name="emailUser" required>
        		<br>
        		<label>Phone  </label> <input type="text" name="phoneUser">
        		<br>
        		<div class="subReg">
        			<input type="submit" name="subReg" value="Submit">
        		</div>
        	</form>
        </div>
    </body>
</html>