<?php # Modified version of Script 12.3 - login.php
// This page processes the login form submission.
// Upon successful login, the user is redirected.
// Two included files are necessary.
// Send NOTHING to the web browser prior to the setcookie() lines!

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  require('includes/login_functions.inc.php');
  require('../mysqli_connect.php');

  // Validate the form data
  list($check, $data) = check_login($dbc, $_POST['email'], $_POST['pass']);

  // If the user entered the correct information, log them in:
  if ($check) { // OK!
    setcookie('user_id', $data['user_id'], time()+3600, '/', '', 0, 0);
    setcookie('first_name', $data['first_name'], time()+3600, '/', '', 0, 0);
    # 5b. Set the cookie to the $_POST value in login.php
    setcookie('dark_mode', $_POST['dark_mode'], time()+3600, '/', '', 0, 0);
  
    // Redirect the user to another page 
    redirect_user('loggedin.php');
  } else {
    $errors = $data;
  } // end of $check IF
  mysqli_close($dbc);
}
include('includes/login_page.inc.php');
?>