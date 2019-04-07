<?php

// This function creates radio buttons by iterating through an array of values.
// The function takes two arguments: the values array and the name.
// The function also makes the button "sticky".
function create_radio($values = array('16', '24'), $name = 'pace') {

	// Start the element:
	foreach ($values as $value) {
		echo '<input type="radio" name="' . $name .'" value="' . $value . '"';

		// Check for stickiness:
		if (isset($_POST[$name]) && ($_POST[$name] == $value)) {
			echo ' checked="checked"';
		}

	// Complete the element:
	echo "> $value hrs/week ";
	} // End of foreach loop.

} // End of create_radio() function.

// This function calculates the student's progress percentage.
// The function takes three arguments: the hours completed so far, the hours corresponding with their block week, and the minmum required hours.
// The function returns the progress percentage.
function calculate_student_progress($completed_hours, $total_hours, $pace) {

	// Get the default progress percentage:
	$progress = $completed_hours/$total_hours;
	// echo number_format($progress, 2);

	if ($_POST['pace'] == 16) {
		// Return the formatted progress as a percentage:
		return number_format($progress, 2) * 100;
	} else {
		// Get adjusted progress for this pace:
		$adjusted_progress = $progress / 1.5;

		// Return the formatted progress as a percentage:
		return number_format($adjusted_progress, 2) * 100;
		}
} // End of calculate_student_progress() function.

$page_title = 'Student Progress Calculator';
include('includes/header-progress.html');

// Check for form submission:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  // Minimal form validation:
	if (isset($_POST['completed_hours'], $_POST['total_hours'], $_POST['pace'], $_POST['instructor'], $_POST['student']) &&
	 is_numeric($_POST['completed_hours']) && is_numeric($_POST['total_hours']) && is_numeric($_POST['pace'])) {

		// Calculate the results:
		$student_progress = calculate_student_progress($_POST['completed_hours'],  $_POST['total_hours'], $_POST['pace']);

		// Print the results:
		echo '<div class="page-header"><h1>Estimated Progress Percentage</h1></div>
		<p>The progress percentage for ' . $_POST['student'] . ' who has completed ' . $_POST['completed_hours'] . ' hours, at a pace of ' . $_POST['pace'] . ' hours per week, and ' . $_POST['total_hours'] . ' hours into their block is <strong>' . $student_progress . '%</strong>.</p>';

		// 2c. Print the results
		echo '<p>Additional Comments: ' . $_POST['comments'] . ',';
		if (isset($_POST['register'])) {
			echo ' student needs to register for a new block</p>';
		}
		
		// 2d. If a student decides to include a set of multiple checkboxes, print the results using a loop
		echo '<p>Additional Notifications:<br />';
		if (isset($_POST['notification'])) {
			foreach ($_POST['notification'] as $notified) {
				echo $notified . '<br />';
			}
		} else {
			echo "None";
		}

	} else { // Invalid submitted values.
		echo '<div class="page-header"><h1>Error!</h1></div>
		<p class="text-danger">Please enter a valid entry for completed hours, total hours, and pace.</p>';
	}

} // End of main submission IF.

// Leave the PHP section and create the HTML form:
?>

<div class="page-header"><h1>Student Progress Calculator</h1></div>
<form action="progress.php" method="post">
	<p>Completed Hours <input type="number" name="completed_hours" value="<?php if (isset($_POST['completed_hours'])) echo $_POST['completed_hours']; ?>"></p>
	<p>Total Hours: <input type="number" name="total_hours" value="<?php if (isset($_POST['total_hours'])) echo $_POST['total_hours']; ?>"></p>
	<p>Pace: 
	<?php
	create_radio();
	?>
	</p>

	<p>Instructor: <select name="instructor">
		<option value="Joseph"<?php if (isset($_POST['instructor']) && ($_POST['instructor'] == 'Joseph')) echo ' selected="selected"'; ?>>Joseph</option>
		<option value="Sydney"<?php if (isset($_POST['instructor']) && ($_POST['instructor'] == 'Sydney')) echo ' selected="selected"'; ?>>Sydney</option>
		<option value="Max"<?php if (isset($_POST['instructor']) && ($_POST['instructor'] == 'Max')) echo ' selected="selected"'; ?>>Max</option>
		<option value="Jane"<?php if (isset($_POST['instructor']) && ($_POST['instructor'] == 'Jane')) echo ' selected="selected"'; ?>>Jane</option>
	</select></p>
	<p>Student Name: <input type="text" name="student" value="<?php if (isset($_POST['student'])) echo $_POST['student']; ?>"></p>

	<!-- 2a. Create a new form and give it the ability to be “sticky.” Have the form use a textarea and a check box. -->
	<textarea name="comments" rows="10"><?php echo($_POST['comments']); ?></textarea>
	
	<p>
	<input type="checkbox" name="register" value="yes"<?php if (isset($_POST['register']) && ($_POST['register'] == 'yes')) echo ' checked="checked"'; ?>> Student needs to register for a new block 
	</p><br />

	<!-- 2b. If a student decides to include a set of multiple checkboxes, they will need to use the in_array() function to make it sticky, which is not covered in the text. -->
	<p>Did any of the following take place?<br />
	<input type="checkbox" name="notification[]" value="block"<?php if (isset($_POST['notification']) && in_array('block', $_POST['notification'])) echo ' checked="checked"'; ?>> Student was notified of upcoming block end date<br />
	<input type="checkbox" name="notification[]" value="advisor"<?php if (isset($_POST['notification']) && in_array('advisor', $_POST['notification'])) echo ' checked="checked"'; ?>> Student was notified to meet with an advisor<br />
	<input type="checkbox" name="notification[]" value="cashier"<?php if (isset($_POST['notification']) && in_array('cashier', $_POST['notification'])) echo ' checked="checked"'; ?>> Student was notified to meet with a cashier<br />
	</p>

	<p><input type="submit" name="submit" value="Calculate!"></p>
</form>

<?php include('includes/footer-progress.html'); ?>