<?php # Script 10.3 - edit_user.php
// This page is for editing a user record.
// This page is accessed through view_users.php.

// Removed for Pursue 1.
// $page_title = 'Edit a User';
// include('includes/header.html');
// echo '<h1>Edit a User</h1>';

// Check for a valid user ID, through GET or POST:
if ( (isset($_GET['id'])) && (is_numeric($_GET['id'])) ) { // From view_users.php
	$id = $_GET['id'];
} elseif ( (isset($_POST['id'])) && (is_numeric($_POST['id'])) ) { // Form submission.
	$id = $_POST['id'];
} else { // No valid ID, kill the script.
	include('includes/header.html'); # 1b. Include header since the code has moved down
	echo '<h1>Edit a User</h1>'; # 1c. Include h1 since the code has moved down
	echo '<p class="error">This page has been accessed in error.</p>';
	include('includes/footer.html');
	exit();
}

require('../mysqli_connect.php');

# 1a. Change the delete_user.php and edit_user.php pages so that they both display the user being affected in the browser window's title bar

// Retrieve the user's information:
$q = "SELECT CONCAT(last_name, ', ', first_name) FROM users WHERE user_id=$id";
$r = @mysqli_query($dbc, $q);

if (mysqli_num_rows($r) == 1) { // Valid user ID, show the form.

	// Get the user's information:
	$row = mysqli_fetch_array($r, MYSQLI_NUM);
	$page_title = 'Edit a User - ' . $row[0]; // Show the user's information in the browser window's title bar
} else {
$page_title = 'Edit a User';
}
include('includes/header.html');
echo '<h1>Edit a User</h1>';

// Check if the form has been submitted:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	$errors = [];

	// Check for a first name:
	if (empty($_POST['first_name'])) {
		$errors[] = 'You forgot to enter your first name.';
	} else {
		$fn = mysqli_real_escape_string($dbc, trim($_POST['first_name']));
	}

	// Check for a last name:
	if (empty($_POST['last_name'])) {
		$errors[] = 'You forgot to enter your last name.';
	} else {
		$ln = mysqli_real_escape_string($dbc, trim($_POST['last_name']));
	}

	// Check for an email address:
	if (empty($_POST['email'])) {
		$errors[] = 'You forgot to enter your email address.';
	} else {
		$e = mysqli_real_escape_string($dbc, trim($_POST['email']));
	}

	# 2a. Modify edit_user.php so that you can also change a user's password
	// Check for a new password and match
	// against the confirmed password:
	if (!empty($_POST['pass1']) && (!empty($_POST['pass2']))) {
		if ($_POST['pass1'] != $_POST['pass2']) {
			$errors[] = 'Your new password did not match the confirmed password.';
		} else {
			$np = mysqli_real_escape_string($dbc, trim($_POST['pass1']));
		}
	} // 2b. If pass1 and pass2 are empty, then do nothing

	if (empty($errors)) { // If everything's OK.

		//  Test for unique email address:
		$q = "SELECT user_id FROM users WHERE email='$e' AND user_id != $id";
		$r = @mysqli_query($dbc, $q);
		if (mysqli_num_rows($r) == 0) {

			// Make the query:
			# 2c. If password values are submitted, update the password in the database as well
			if (!empty($_POST['pass1']) && (!empty($_POST['pass2']))) {
				$q = "UPDATE users SET first_name='$fn', last_name='$ln', email='$e', pass=SHA1('$np') WHERE user_id=$id LIMIT 1";
			} else { // 2c. If these inputs are left blank, do not update the update the password in the database
				$q = "UPDATE users SET first_name='$fn', last_name='$ln', email='$e' WHERE user_id=$id LIMIT 1";
			}
			$r = @mysqli_query($dbc, $q);
			if (mysqli_affected_rows($dbc) == 1) { // If it ran OK.

				// Print a message:
				echo '<p>The user has been edited.</p>';

			} else { // If it did not run OK.
				echo '<p class="error">The user could not be edited due to a system error. We apologize for any inconvenience.</p>'; // Public message.
				echo '<p>' . mysqli_error($dbc) . '<br>Query: ' . $q . '</p>'; // Debugging message.
			}

		} else { // Already registered.
			echo '<p class="error">The email address has already been registered.</p>';
		}

	} else { // Report the errors.

		echo '<p class="error">The following error(s) occurred:<br>';
		foreach ($errors as $msg) { // Print each error.
			echo " - $msg<br>\n";
		}
		echo '</p><p>Please try again.</p>';

	} // End of if (empty($errors)) IF.

} // End of submit conditional.

// Always show the form...

// Retrieve the user's information:
$q = "SELECT first_name, last_name, email FROM users WHERE user_id=$id";
$r = @mysqli_query($dbc, $q);

if (mysqli_num_rows($r) == 1) { // Valid user ID, show the form.

	// Get the user's information:
	$row = mysqli_fetch_array($r, MYSQLI_NUM);

	// Create the form:
	# 2d. Add password inputs to the form
	echo '<form action="edit_user.php" method="post">
<p>First Name: <input type="text" name="first_name" size="15" maxlength="15" value="' . $row[0] . '"></p>
<p>Last Name: <input type="text" name="last_name" size="15" maxlength="30" value="' . $row[1] . '"></p>
<p>Email Address: <input type="email" name="email" size="20" maxlength="60" value="' . $row[2] . '"> </p>
<p>New Password: <input type="password" name="pass1" size="10" maxlength="20" value="' . $row[3] . 
'" ></p>
<p>Confirm New Password: <input type="password" name="pass2" size="10" maxlength="20" value="' . $row[4] . '" ></p>
<p><input type="submit" name="submit" value="Submit"></p>
<input type="hidden" name="id" value="' . $id . '">
</form>';

} else { // Not a valid user ID.
	echo '<p class="error">This page has been accessed in error.</p>';
}

mysqli_close($dbc);

include('includes/footer.html');
?>