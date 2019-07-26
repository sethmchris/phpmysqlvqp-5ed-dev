<?php # Modified version of Script 12.1 login_page.inc.php
// This page prints any errors associated with loggin in and it creates the entire login page, including the form.

// Include the header:
$page_title = 'Login';
include('includes/header.html');

// Print any error messages, if they exist:
if (isset($errors) && !empty($errors)) {
  echo '<h1>Error!</h1>
  <p class="error">The following error(s) occured:<br>';
  foreach ($errors as $msg) {
    echo "- $msg<br>\n";
  }
  echo '</p><p>Please try again.</p>';
}

?>
<h1>Login</h1>
<form action="login.php" method="post"> 
  <p>Email Address: <input  type="email" name="email"  size="20" maxlength="60"> </p>
  <p>Password: <input  type="password" name="pass"  size="20" maxlength="20"></p>
  <!-- 5a. Add the field to the form in login_page.inc.php -->
  <p>Dark Mode: <input type="checkbox" name="darkmode" id="dark_mode"></p>
  <p><input type="submit"  name="submit" value="Login"></p>
</form>

<?php include('includes/footer.html'); ?>