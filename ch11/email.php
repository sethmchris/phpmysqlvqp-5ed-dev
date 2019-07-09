<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Instructor Contact Form</title>
</head>
<body>
<h1>Instructor Contact Form</h1>
<?php # Script 11.1 - modified version of email.php
# 1. Create a more custom contact form. Have the PHP script also send a more custom email, including any other data requested by the form.

// Check for form submission:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	// Minimal form validation:
	if (!empty($_POST['student']) && !empty($_POST['email']) && !empty($_POST['instructor']) && !empty($_POST['comments']) ) {

		// Create the body:
		$body = "Hi {$_POST['instructor']}, {$_POST['student']} has contacted you. \n\nDate: {$_POST['date']}\n\nComments: {$_POST['comments']}\n\n";

		// Make it no longer than 70 characters long:
		$body = wordwrap($body, 70);

		// Send the email:
		mail('test@schristiansen.colutah.org', 'Contact Form Submission', $body, "From: {$_POST['email']}");

		// Print a message:
		echo '<p><em>Thank you for contacting an instructor. We will reply within 24 hours.</em></p>';

		// Clear $_POST (so that the form's not sticky):
		$_POST = [];

	} else {
		echo '<p style="font-weight: bold; color: #C00">Please fill out the form completely.</p>';
	}

} // End of main isset() IF.

// Create the HTML form:
?>
<!-- <p>Please fill out this form to contact me.</p>
<form action="email.php" method="post">
	<p>Name: <input type="text" name="name" size="30" maxlength="60" value="<?php if (isset($_POST['name'])) echo $_POST['name']; ?>"></p>
	<p>Email Address: <input type="email" name="email" size="30" maxlength="80" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>"></p>
	<p>Comments: <textarea name="comments" rows="5" cols="30"><?php if (isset($_POST['comments'])) echo $_POST['comments']; ?></textarea></p>
	<p><input type="submit" name="submit" value="Send!"></p>
</form> -->
<form action="email.php" method="post">

	<fieldset><legend>Enter your information in the form below:</legend>

	<p>Student Name: <input type="text" name="student" size="30" maxlength="60" value="<?php if (isset($_POST['student'])) echo $_POST['student']; ?>"></p>

	<p>Email Address: <input type="email" name="email" size="30" maxlength="80" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>"></p>
	
	<p>Instructor: <select name="instructor">
		<option value="Joseph"<?php if (isset($_POST['instructor']) && ($_POST['instructor'] == 'Joseph')) echo ' selected="selected"'; ?>>Joseph</option>
		<option value="Sydney"<?php if (isset($_POST['instructor']) && ($_POST['instructor'] == 'Sydney')) echo ' selected="selected"'; ?>>Sydney</option>
		<option value="Max"<?php if (isset($_POST['instructor']) && ($_POST['instructor'] == 'Max')) echo ' selected="selected"'; ?>>Max</option>
		<option value="Jane"<?php if (isset($_POST['instructor']) && ($_POST['instructor'] == 'Jane')) echo ' selected="selected"'; ?>>Jane</option>
	</select></p>

	<p><label>Date: <input type="date" name="date"></label></p>

	<p>Comments: <textarea name="comments" rows="5" cols="30"><?php if (isset($_POST['comments'])) echo $_POST['comments']; ?></textarea></p>
	</fieldset>

	<p><input type="submit" name="submit" value="Send!"></p>

</form>
</body>
</html>