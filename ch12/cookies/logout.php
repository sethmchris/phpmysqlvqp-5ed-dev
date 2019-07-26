<?php # Modifiied version of Script 12.6 - logout.php
// This page lets the user logout.

// If no cookie is present, redirect the user:
if (!isset($_COOKIE['user_id'])) {

  require('includes/login_functions.inc.php');
  redirect_user();

} else { // Delete the cookies:
  setcookie('user_id', $data['user_id'], time()-3600, '/', '', 0, 0);
  setcookie('first_name', $data['user_id'], time()-3600, '/', '', 0, 0);
  setcookie('dark_mode', $_POST['darkmode'], time()-3600, '/', '', 0, 0);
}

$page_title = 'Logged Out!';
include('includes/header.html');

echo "<h1>Logged Out!</h1>
<p>You are now logged out, {$_COOKIE['first_name']}!</p>";

include('includes/footer.html');
?>