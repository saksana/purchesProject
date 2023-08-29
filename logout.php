<?php
session_start();
unset($_SESSION['userid']);
unset($_SESSION['fullname']);
unset($_SESSION['username']);
header("Location: userhome.php");
?>