<?php # Modified version of Script 12.12 - login.php #4
// This page processes the login form submission.
// The script now stores the HTTP_USER_AGENT value for added security

// Check if the form has been submitted:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  // Need two helper files:
  require('includes/login_functions.inc.php');
  require('../mysqli_connect.php');

  // Check the login
  list($check, $data) = check_login($dbc, $_POST['email'], $_POST['pass']);

  if ($check) { // OK!

    // Set the session data:
    session_start();
    $_SESSION['user_id'] = $data['user_id'];
    $_SESSION['first_name'] = $data['first_name'];

    // Store the HTTP_USER_AGENT:
    $_SESSION['agent'] = sha1($_SERVER['HTTP_USER_AGENT']);
  
    # 4. Modify the redirect_user() function so that it can be used to redirect the user to a page within another directory.
    # 4a. Redirect user to new direcory that contains a basic page
    redirect_user('profile/index.php');

  } else { // Unsuccessful!

    // Assign $data to $errors for login_page.inc.php
    $errors = $data;
  }

  mysqli_close($dbc); // Close the database connection

} // End of the main submit conditional

// Create the page:
include('includes/login_page.inc.php');
?>