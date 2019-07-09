<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Student Progress Calculator</title>
</head>
<body>
<h1>Student Progress Calculator</h1>
<?php # Script 11.1 - modified version of email.php

// Check for form submission:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	// Minimal form validation:
	if (!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['comments']) ) {

		// Create the body:
		$body = "Name: {$_POST['name']}\n\nComments: {$_POST['comments']}";

		// Make it no longer than 70 characters long:
		$body = wordwrap($body, 70);

		// Send the email:
		mail('test@schristiansen.colutah.org', 'Contact Form Submission', $body, "From: {$_POST['email']}");

		// Print a message:
		echo '<p><em>Thank you for contacting me. I will reply some day.</em></p>';

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

	<p><label>Student Name: <input type="text" name="student-name" size="20" maxlength="40"></label></p>
	<p><label>Instructor Name: 
		<select name="instructor-name">
			<option value="">--</option>
			<option value="john">John</option>
			<option value="juan">Juan</option>
			<option value="don">Don</option>
			<option value="james">James</option>
		</select>
		</label></p>
	<p><label>Date: <input type="date" name="date"></label></p>

	<p><label>Comments: <textarea name="comments" rows="3" cols="40"></textarea></label></p>

	</fieldset>

	<p align="center"><input type="submit" name="submit" value="Submit My Information"></p>

</form>
</body>
</html>