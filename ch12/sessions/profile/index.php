<?php # Modified version of Script 12.13 - loggedin.php #3
// The user is redirected here from login.php

session_start();

// If no session is present, redirect the user:
// Also vvalidate the HTTP_USER_AGENT
if (!isset($_SESSION['agent']) OR ($_SESSION['agent'] != md5($_SERVER['HTTP_USER_AGENT']) )) {

  // Need the functions:
  require('../includes/login_functions.inc.php');
  // redirect_user();

}
  // Set the page title and include the HTML header
  $page_title = 'Profile';
  include('includes/header.html'); // Include modified version of header.html 

  // Print a customized message:
  echo "<h1>Logged In!</h1>
  <p>Welcome to your profile, {$_SESSION['first_name']}!</p>
  <p><a href=\"../logout.php\">Logout</a></p>";

  include('../includes/footer.html');
  ?>