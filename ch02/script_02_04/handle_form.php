<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Form Feedback</title>
	<style type="text/css" title="text/css" media="all">
	.error {
		font-weight: bold;
		color: #C00;
	}
	</style>
</head>
<body>
<?php # Script 2.4 - handle_form.php #3

// Validate the name:
if (!empty($_REQUEST['name'])) {
	$name = $_REQUEST['name'];
} else {
	$name = NULL;
	echo '<p class="error">You forgot to enter your name!</p>';
}

// Validate the email:
if (!empty($_REQUEST['email'])) {
	$email = $_REQUEST['email'];
} else {
	$email = NULL;
	echo '<p class="error">You forgot to enter your email address!</p>';
}

// Validate the comments:
if (!empty($_REQUEST['comments'])) {
	$comments = $_REQUEST['comments'];
} else {
	$comments = NULL;
	echo '<p class="error">You forgot to enter your comments!</p>';
}

// 3a. Rewrite the gender conditional in handle_form.php (Script 2.4) as one conditional instead of two nested ones. Hint: You’ll need to use the AND operator.

// Validate the gender:
$gender = $_REQUEST['gender'];

if (isset($_REQUEST['gender']) && $gender == 'M') { // Gender is set and value is equal to M
	$greeting = '<p><strong>Good day, Sir!</strong></p>';
} elseif (isset($_REQUEST['gender']) && $gender == 'F') { // Gender is set and value is equal to F
	$greeting = '<p><strong>Good day, Madam!</strong></p>';
} elseif (isset($_REQUEST['gender']) && $gender = NULL ){ // Unacceptable value.
	echo '<p class="error">Gender should be either "M" or "F"!</p>';
} else { // $_REQUEST['gender'] is not set.
	$gender = NULL;
	echo '<p class="error">You forgot to select your gender!</p>';
}

// If everything is OK, print the message:
if ($name && $email && $gender && $comments) {

	echo "<p>Thank you, <strong>$name</strong>, for the following comments:</p>
	<pre>$comments</pre>
	<p>We will reply to you at <em>$email</em>.</p>\n";

	echo $greeting;

} else { // Missing form value.
	echo '<p class="error">Please go back and fill out the form again.</p>';
}

?>
</body>
</html>