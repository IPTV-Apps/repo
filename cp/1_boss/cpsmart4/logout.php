<?php
session_start();
session_destroy();
setcookie("auth","");
$_SESSION['loggedin'] = false;
header("location: index.php");
exit;
