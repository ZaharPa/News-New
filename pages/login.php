<?php
use scripts\class\Reader;
use scripts\Database;


if (!empty($_POST)) {
    $email = filter_input(INPUT_POST, 'emailUser', FILTER_SANITIZE_EMAIL);
    $password = trim($_POST['passUser']);
    $curUser = new Reader;
    $link = Database::getLink();
    
    if($curUser->login_user($link, $email, $password))
    {
        $_SESSION['role'] = $curUser->get_role();
        $_SESSION['name'] = $curUser->get_name();
        header("Location: index.php");
    } else {
        echo '<script language="javascript">';
        echo 'alert("Невірні дані")';
        echo '</script>';
    }
}
?>


<!DOCTYPE html>
<html>
    <head>
    <meta charset="UTF-8" />
    <link rel="icon" href="images/logo.jpg" type="image/x-icon" />
    <title>New - Login</title>
    <meta http-equiv="cache-control" content="no-cache">
    <meta http-equiv="expires" content="0">
    <meta http-equiv="pragma" content="no-cache">
    <link rel="stylesheet" href="styles/style.css" />
    </head>
    <body>
    <div class="log">
    	<p>LOGIN</p>
    	<p>Input your date</p>
    	<form action="index.php?page=login" method="post">
    		<label>Email</label> 
    		<br>
    		<input type="email" name="emailUser" required>
    		<br>
    		<label>Password</label>
    		<br>
    		<input type="password" name="passUser" required>
    		<br>
    		<div class="subReg">
    			<input type="submit" name="subReg" value="Submit">
    		</div>
    	</form>
    </div>
    </body>
</html>
