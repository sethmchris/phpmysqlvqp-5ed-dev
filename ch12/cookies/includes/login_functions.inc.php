<?php

// Start defining the URL:
function redirect_user($page = 'index.php') {
  $url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']);

  // Remove any ending slashes from the URL
  $url = rtrim($url, '/\\');

  // Append the specific page to the URL
  $url .= '/' . $page;

  // Redirect the user and complete the function
  header("Location: $url");
  exit(); // Quit the script.
} // End of redirect_user function.

function check_login($dbc, $email = '', $pass = '') {
  $errors = []; // Initialize error array.
  if (empty($email)) {
    $errors[] = 'You forgot to enter your email address.';
  } else {
    $e = mysqli_real_escape_string($dbc, trim($email));
  } if (empty($pass)) {
    $errors[] = 'You forgot to enter your password.';
  } else {
    $p = mysqli_real_escape_string($dbc, trim($pass));
  }

  if (empty($errors)) { // If everything's okay
    $q = "SELECT user_id, first_name FROM users WHERE email='$e' AND pass=SHA2('$p', 512)";
    $r = @mysqli_query($dbc, $q);
  }

  // Check the results of the query
  if(mysqli_num_rows($r) == 1) {
    $row = mysqli_fetch_array($r, MYSQLI_ASSOC);
    return [true, $row];
  } else { // Not a match!
    $errors[ ] = 'The email address and password entered do not match those on file.';
  } // End of empty($errors) IF
  return [false, $errors];
} // End of check_login() function.