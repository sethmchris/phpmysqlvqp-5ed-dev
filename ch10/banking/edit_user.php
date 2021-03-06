<?php # Script 10.3 - edit_user.php
// This page is for editing a user record.
// This page is accessed through view_users.php.

# 1b. Change the delete_user.php and edit_user.php pages so that they both display the user being affected in the browser window's title bar
require('../mysqli_connect_banking.php');
$q = mysqli_fetch_assoc(mysqli_query($dbc, "SELECT CONCAT(last_name, ', ', first_name) as name FROM customers WHERE customer_id=" . $_GET['id']));
$name = $q['name'];

$page_title = 'Edit Customer: ' . $name;
include('includes/header.html');
echo '<h1>Edit a Customer</h1>';

// Check for a valid user ID, through GET or POST:
if ( (isset($_GET['id'])) && (is_numeric($_GET['id'])) ) { // From view_users.php
	$id = $_GET['id'];
} elseif ( (isset($_POST['id'])) && (is_numeric($_POST['id'])) ) { // Form submission.
	$id = $_POST['id'];
} else { // No valid ID, kill the script.
	echo '<p class="error">This page has been accessed in error.</p>';
	include('includes/footer.html');
	exit();
}

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

	// // Check for an email address:
	// if (empty($_POST['email'])) {
	// 	$errors[] = 'You forgot to enter your email address.';
	// } else {
	// 	$e = mysqli_real_escape_string($dbc, trim($_POST['email']));
	// }

	// # 2a. Modify edit_user.php so that you can also change a user's password
	// // Check for a new password and match
	// // against the confirmed password:
	// if (!empty($_POST['pass1']) && (!empty($_POST['pass2']))) {
	// 	if ($_POST['pass1'] != $_POST['pass2']) {
	// 		$errors[] = 'Your new password did not match the confirmed password.';
	// 	} else {
	// 		$np = mysqli_real_escape_string($dbc, trim($_POST['pass1']));
	// 	}
	// } // 2b. If pass1 and pass2 are empty, then do nothing

	if (empty($errors)) { // If everything's OK.

		//  Test for unique email address:
		$q = "SELECT customer_id FROM customers WHERE customer_id != $id";
		$r = @mysqli_query($dbc, $q);
		if (mysqli_num_rows($r) == 0) {

			// Make the query:
			# 2c. If password values are submitted, update the password in the database as well
			// if (!empty($_POST['pass1']) && (!empty($_POST['pass2']))) {
			// 	$q = "UPDATE users SET first_name='$fn', last_name='$ln', email='$e', pass=SHA1('$np') WHERE user_id=$id LIMIT 1";
			// } else { // 2c. If these inputs are left blank, do not update the update the password in the database
			// 	$q = "UPDATE users SET first_name='$fn', last_name='$ln', email='$e' WHERE user_id=$id LIMIT 1";
			// }


				$q = "UPDATE users SET first_name='$fn', last_name='$ln' WHERE customer_id=$id LIMIT 1";
			
				$q = "UPDATE users SET first_name='$fn', last_name='$ln' WHERE customer_id=$id LIMIT 1";

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
$q = "SELECT first_name, last_name FROM users WHERE customer_id=$id";
$r = @mysqli_query($dbc, $q);

if (mysqli_num_rows($r) == 0) { // Valid user ID, show the form.

	// Get the user's information:
	$row = mysqli_fetch_array($r, MYSQLI_NUM);

	# 3. If you're up for the challenge, modify edit_user.php so that the form elements’ values come from $_POST, if set, and the database if not.

	# 3a. If UPDATE is succeful, then $row[] has the same value as $_POST[]
	$form_fn = isset($_POST['first_name']) ? $_POST['first_name'] : $row[0];
	$form_ln = isset($_POST['last_name']) ? $_POST['last_name'] : $row[1];
	$form_email = isset($_POST['customer_id']) ? $_POST['customer_id'] : $row[2];

	// Create the form:
	# 2d. Add password inputs to the form
	# 3b. Substitute database values with above variables to allow $_POST or database values
	echo '<form action="edit_user.php" method="post">
<p>First Name: <input type="text" name="first_name" size="15" maxlength="15" value="' . $form_fn . '"></p>
<p>Last Name: <input type="text" name="last_name" size="15" maxlength="30" value="' . $form_ln . '"></p>
<p>Email Address: <input type="email" name="email" size="20" maxlength="60" value="' . $form_email . '"> </p>
<p>New Password: <input type="password" name="pass1" size="10" maxlength="20" value="" ></p>
<p>Confirm New Password: <input type="password" name="pass2" size="10" maxlength="20" value="" ></p>
<p><input type="submit" name="submit" value="Submit"></p>
<input type="hidden" name="id" value="' . $id . '">
</form>';

} else { // Not a valid user ID.
	echo '<p class="error">This page has been accessed in error.</p>';
}

mysqli_close($dbc);

include('includes/footer.html');
?>