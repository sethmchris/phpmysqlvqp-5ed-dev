<?php # Modified version of script 12.1 login_page.inc.php
// This page prints any errors associated with loggin in and it creates the entire login page, including the form.

// Include the header:
$page_title = 'Login';
include('includes/header.html');

// Print any error messages, if they exist:
# 3. Add code to the handling of the $errors variable on the login page that uses a foreach loop if $errors is an array, or just prints the value of $errors otherwise.
if (is_array($errors)) {
  echo '<h1>Error!</h1>
  <p class="error">The following error(s) occured:<br>';
  foreach ($errors as $msg) {
    echo "- $msg<br>\n";
  }
} else {
  echo $errors;
}

?>
<h1>Login</h1>
<form action="login.php" method="post">
  <!-- 2. Make the login form sticky -->
  <p>Email Address: <input  type="email" name="email"  size="20" maxlength="60" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>"></p>

  <p>Password: <input  type="password" name="pass"  size="20" maxlength="20" value="<?php if (isset($_POST['pass'])) echo $_POST['pass']; ?>"></p>

  <p><input type="submit"  name="submit" value="Login"></p>
</form>

<?php include('includes/footer.html'); ?>