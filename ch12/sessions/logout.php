<?php # Modified version of Script 12.6 - logout.php
// This page lets the user logout.

session_start(); // Access the existing session.

// If no cookie is present, redirect the user:
if (!isset($_SESSION['user_id'])) {

  require('includes/login_functions.inc.php');
  redirect_user();

} else { // Delete the session
  $_SESSION = [];
  session_destroy();
  setcookie('first_name', '', time()-3600, '/', '', 0, 0);
}

$page_title = 'Logged Out!';
include('includes/header.html');

echo "<h1>Logged Out!</h1>
<p>You are now logged out!</p>";

include('includes/footer.html');
?>