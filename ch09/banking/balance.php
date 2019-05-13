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

	// Check for a deposit or withdrawl amount:
	if (empty($_POST['add']) && empty($_POST['subtract'])) {
		$errors[] = 'You didn\'t enter a deposit or withdrawl amount';
	} 

  //
	// Check that input is numeric
	//
	
	// elseif (!is_numeric($_POST['add']) || !is_numeric($_POST['subtract'])) { 
	// 	$errors[] = 'You didn\'t enter a valid amount';
	// } 
	else {
		$b = mysqli_real_escape_string($dbc, trim($_POST['add']));
		$b = mysqli_real_escape_string($dbc, trim($_POST['subtract']));
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

			//
			// Add or subtract balance, don't replace balance
			//

			$q = "UPDATE accounts SET balance=$b WHERE customer_id=$row[0]";
			$r = @mysqli_query($dbc, $q);

			if (mysqli_affected_rows($dbc) == 1) { // If it ran OK.

				// Print a message.
				echo '<h1>Thank you!</h1>
				<p>Your balance has been updated.</p><p><br></p>';

			} else { // If it did not run OK.

				// Public message:
				echo '<h1>System Error</h1>
				<p class="error">Your balance could not be changed due to a system error. We apologize for any inconvenience.</p>';

				// Debugging message:
				echo '<p>' . mysqli_error($dbc) . '<br><br>Query: ' . $q . '</p>';

			}

			mysqli_close($dbc); // Close the database connection.

			// Include the footer and quit the script (to not show the form).
			include('includes/footer.html');
			exit();

		} else { // Invalid email address/password combination.
			echo '<h1>Error!</h1>
			<p class="error">The customer_id does not match any of those on file.</p>';
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
<form action="balance.php" method="post">
	<p>Customer ID: <input type="text" name="customer_id" size="20" maxlength="10" value="<?php if (isset($_POST['customer_id'])) echo $_POST['customer_id']; ?>" ></p>
	<p>Amount to Deposit: <input type="number" name="add" size="10" maxlength="10" value="<?php if (isset($_POST['add'])) echo $_POST['add']; ?>" ></p>
	<p>Amount to Withdraw: <input type="number" name="subtract" size="10" maxlength="10" value="<?php if (isset($_POST['subtract'])) echo $_POST['subtract']; ?>" ></p>
	<p>Account Type: 
	<select name="type">
		<option value="checking"<?php if (isset($_POST['type']) && ($_POST['type'] == 'Checking')) echo ' selected="selected"'; ?>>Checking</option>
		<option value="savings"<?php if (isset($_POST['type']) && ($_POST['type'] == 'Savings')) echo ' selected="selected"'; ?>>Savings</option>
	</select>
	<p><input type="submit" name="submit" value="Change Balance"></p>
</form>
<?php include('includes/footer.html'); ?>