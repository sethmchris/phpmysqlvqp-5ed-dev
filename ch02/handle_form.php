<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Form Feedback</title>
</head>
<body>
<?php 
// 2. Create a new form that takes some input from the user (perhaps base it on a form you know you’ll need for one of your projects). Then create the PHP script that validates the form data and reports upon the results.

  // Create a shorthand for the form data:
  $studentName = $_REQUEST['student-name'];
  $instructorName = $_REQUEST['instructor-name'];
  $date = $_REQUEST['date'];
  $comments = $_REQUEST['comments'];

  // Create the $instructorName variable:
	if (isset($_REQUEST['instructor-name'])) {
		$instructorName = $_REQUEST['instructor-name'];
	} else {
		$instructorName = NULL;
	}

  // Print the submitted information:
  echo "<p>Thank you for the comments regarding the following student:<strong> $studentName</strong></p><pre>$comments</pre> <p>Submission date:<em>$date</em></p>\n";

  // Print a message addressed to the instructor:
  echo "<p><strong>Good day, $instructorName!</strong></p>";
?>
</body>
</html>