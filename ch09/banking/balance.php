<?php # Script 9.7 - Modified version of password.php
// This page lets a user change their password.

$page_title = 'Change Account Balance';
include('includes/header.html');

// Check for form submission:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	require('../mysqli_connect2.php'); // Connect to the db.

	$errors = []; // Initialize an error array.

	// Check for a customer ID
	if (empty($_POST['customer_id'])) {
		$errors[] = 'You forgot to enter your customer ID';
	} else {
		$id = mysqli_real_escape_string($dbc, trim($_POST['customer_id']));
	}

	// Check for the current password:
	if (empty($_POST['pass'])) {
		$errors[] = 'You forgot to enter your current password.';
	} else {
		$p = mysqli_real_escape_string($dbc, trim($_POST['pass']));
	}

	// Check for a new password and match
	// against the confirmed password:
	if (!empty($_POST['pass1'])) {
		if ($_POST['pass1'] != $_POST['pass2']) {
			$errors[] = 'Your new password did not match the confirmed password.';
		} else {
			$np = mysqli_real_escape_string($dbc, trim($_POST['pass1']));
		}
	} else {
		$errors[] = 'You forgot to enter your new password.';
	}

	if (empty($errors)) { // If everything's OK.

		// Check that they've entered the right customer_id combination:
		$q = "SELECT customer_id FROM accounts WHERE (customer_id='$id')";
		$r = @mysqli_query($dbc, $q);
		$num = @mysqli_num_rows($r);
		if ($num == 1) { // Match was made.

			// Get the user_id:
			$row = mysqli_fetch_array($r, MYSQLI_NUM);

			// Make the UPDATE query:
			$q = "UPDATE users SET pass=SHA2('$np', 512) WHERE user_id=$row[0]";
			$r = @mysqli_query($dbc, $q);

			if (mysqli_affected_rows($dbc) == 1) { // If it ran OK.

				// Print a message.
				echo '<h1>Thank you!</h1>
				<p>Your password has been updated. In Chapter 12 you will actually be able to log in!</p><p><br></p>';

			} else { // If it did not run OK.

				// Public message:
				echo '<h1>System Error</h1>
				<p class="error">Your password could not be changed due to a system error. We apologize for any inconvenience.</p>';

				// Debugging message:
				echo '<p>' . mysqli_error($dbc) . '<br><br>Query: ' . $q . '</p>';

			}

			mysqli_close($dbc); // Close the database connection.

			// Include the footer and quit the script (to not show the form).
			include('includes/footer.html');
			exit();

		} else { // Invalid email address/password combination.
			echo '<h1>Error!</h1>
			<p class="error">The email address and password do not match those on file.</p>';
		}

	} else { // Report the errors.

		echo '<h1>Error!</h1>
		<p class="error">The following error(s) occurred:<br>';
		foreach ($errors as $msg) { // Print each error.
			echo " - $msg<br>\n";
		}
		echo '</p><p>Please try again.</p><p><br></p>';

	} // End of if (empty($errors)) IF.

	mysqli_close($dbc); // Close the database connection.

} // End of the main Submit conditional.
?>
<h1>Change Your Password</h1>
<form action="password.php" method="post">
	<p>Customer ID: <input type="text" name="customer_id" size="20" maxlength="10" value="<?php if (isset($_POST['customer_id'])) echo $_POST['customer_id']; ?>" > </p>
	<p>Amount to Add: <input type="text" name="balance" size="10" maxlength="10" value="<?php if (isset($_POST['balance'])) echo $_POST['balance']; ?>" ></p>
	<p>Account Type: 
	<select name="type">
		<option value="checking"<?php if (isset($_POST['type']) && ($_POST['type'] == 'Checking')) echo ' selected="selected"'; ?>>Checking</option>
		<option value="savings"<?php if (isset($_POST['type']) && ($_POST['type'] == 'Savings')) echo ' selected="selected"'; ?>>Savings</option>
	</select>
	<p><input type="submit" name="submit" value="Change Balance"></p>
</form>
<?php include('includes/footer.html'); ?>