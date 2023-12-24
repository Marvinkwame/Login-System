<?php

require_once 'includes/config_session.inc.php';
require_once 'includes/signup_view.inc.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<h3>Login</h3>


<form action="includes/login.inc.php" method="POST">
    <input type="text" name="username" placeholder="username" >
    <input type="password" name="password" placeholder="password" >
    <button>Login</button>
</form>


<h3>Sign Up</h3>


<form action="includes/signup.inc.php" method="POST">
    <?php
    signup_input();
    ?>
    <button>Signup</button>
</form>

<?php
check_signups_errors();

?>
    
</body>
</html>