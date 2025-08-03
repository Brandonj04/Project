
<?php
// Start the session
session_start();
$_SESSION['logged_in'] = false;
$_SESSION['name'] = null;
$_SESSION['id'] =null;

$_SESSION['email'] = null;
$_SESSION['password'] =null;

header("Location: http://localhost:8000/home.php");
?>
