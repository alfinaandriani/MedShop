<?php

session_start();
session_destroy();
header("Location: login_cust.php");

// Delete cookie
setcookie('username', '', time() - 3600);
setcookie('key', '', time() - 3600);
