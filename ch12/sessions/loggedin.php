<?php # Modified version of Script 12.4 - loggedin.php
// The user is redirected here from login.php

session_start();

// If no session is present, redirect the user:
if (!isset($_SESSION['user_id'])) {

  require('includes/login_functions.inc.php');
  redirect_user();

}
  // Include the page header
  $page_title = 'Logged In!';
  include('includes/header.html');

  // Welcome the user, referencing the cookie
  echo "<h1>Logged In!</h1>
  <p>You are now logged in, {$_SESSION['first_name']}!</p>
  <p><a href=\"logout.php\">Logout</a></p>";

  include('includes/footer.html');
  ?>