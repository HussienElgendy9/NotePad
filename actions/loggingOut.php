<?php
session_start();
session_unset();
session_destroy();
$_SESSION['Message'] = 'Logged Out';
header('Location:../login.php');
