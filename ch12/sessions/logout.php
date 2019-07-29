<?php # Modified version of Script 12.11 - logout.php #2
// This page lets the user logout.

session_start(); // Access the existing session.
# 6. Change the code in logout.php (Script 12.11) so that it uses the session_name() function to dynamically set the name value of the session cookie being deleted.
$sessionID = 'Session ' . $_SESSION['user_id']; // 6a. Declare a variable that includes a unique value to make it "dynamic"

// If no cookie is present, redirect the user:
if (!isset($_SESSION['user_id'])) {

  // Need the functions:
  require('includes/login_functions.inc.php');
  redirect_user();

} else { // Cancel the session
  $_SESSION = []; // Clear the variables
  session_destroy(); // Destroy the session itself
  # 6b. Use the variable you created as the argument for the session_name() function
  setcookie(session_name($sessionID), '', time()-3600, '/', '', 0, 0); // Destroy the cookie}
  # 6c. Since the session is being deleted, you probably won't see its name in the developer tools... try echoing out the value to check your work!
  echo session_name($sessionID);
}
// Set the page title and include the HTML header:
$page_title = 'Logged Out!';
include('includes/header.html');

// Print a customized message
echo "<h1>Logged Out!</h1>
<p>You are now logged out!</p>";

include('includes/footer.html');
?>