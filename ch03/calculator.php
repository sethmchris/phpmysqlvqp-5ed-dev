<?php

# 6a. As a more advanced trick, rewrite calculator.php so that the create_radio() function call is in the script only once but still creates three radio buttons. Hint: Use a loop.

// This function creates radio buttons by iterating through an array of values.
// The function takes two arguments: the values array and the name.
// The function also makes the button "sticky".
function create_radio($values = array('3.50', '4.00', '4.50'), $name = 'gallon_price') {

	// Start the element:
	foreach ($values as $value) {
		echo '<input type="radio" name="' . $name .'" value="' . $value . '"';

		// Check for stickiness:
		if (isset($_POST[$name]) && ($_POST[$name] == $value)) {
			echo ' checked="checked"';
		}

	// Complete the element:
	echo "> $value ";
	} // End of foreach loop.

} // End of create_radio() function.

// This function calculates the cost of the trip.
// The function takes three arguments: the distance, the fuel efficiency, and the price per gallon.
// The function returns the total cost.
function calculate_trip_cost($miles, $mpg, $ppg) {

	// Get the number of gallons:
	$gallons = $miles/$mpg;

	// Get the cost of those gallons:
	$dollars = $gallons * $ppg;

	// Return the formatted cost:
	return number_format($dollars, 2);

} // End of calculate_trip_cost() function.

$page_title = 'Trip Cost Calculator';
include('includes/header-calc.html');

// Check for form submission:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  // Minimal form validation:
  # 4b. Add the $_POST value of average_speed
	if (isset($_POST['distance'], $_POST['gallon_price'], $_POST['efficiency'], $_POST['average_speed']) &&
	 is_numeric($_POST['distance']) && is_numeric($_POST['gallon_price']) && is_numeric($_POST['efficiency']) && is_numeric($_POST['average_speed']) ) {

		// Calculate the results:
		$cost = calculate_trip_cost($_POST['distance'], $_POST['efficiency'], $_POST['gallon_price'], $_POST['average_speed']);
		# 3a. Change calculator.php so that it uses a constant in lieu of the hard-coded average speed of 65. (As written, the average speed is a “magic number”—a value used in a script without explanation.)
		// $average_speed = 65; // The average miles per hour as suggested by the book
    // $hours = $_POST['distance']/$average_speed;
    
    # 4c. Divide by the $_POST value of average_speed instead of the constant or hard-coded value
		$hours = $_POST['distance']/$_POST['average_speed'];

    # 4d. Print the $_POST value of average_speed
		// Print the results:
		echo '<div class="page-header"><h1>Total Estimated Cost</h1></div>
		<p>The total cost of driving ' . $_POST['distance'] . ' miles, averaging ' . $_POST['efficiency'] . ' miles per gallon, and paying an average of $' . $_POST['gallon_price'] . ' per gallon, is $' . $cost . '. If you drive at an average of ' . $_POST['average_speed'] . ' miles per hour, the trip will take approximately ' . number_format($hours, 2) . ' hours.</p>';

	} else { // Invalid submitted values.
		echo '<div class="page-header"><h1>Error!</h1></div>
		<p class="text-danger">Please enter a valid distance, price per gallon, and fuel efficiency.</p>';
	}

} // End of main submission IF.

// Leave the PHP section and create the HTML form:
?>

<div class="page-header"><h1>Trip Cost Calculator</h1></div>
<form action="calculator.php" method="post">
	<p>Distance (in miles): <input type="number" name="distance" value="<?php if (isset($_POST['distance'])) echo $_POST['distance']; ?>"></p>
	<p>Ave. Price Per Gallon:
	<?php
	create_radio();
	?>
	</p>
	<p>Fuel Efficiency: <select name="efficiency">
		<option value="10"<?php if (isset($_POST['efficiency']) && ($_POST['efficiency'] == '10')) echo ' selected="selected"'; ?>>Terrible</option>
		<option value="20"<?php if (isset($_POST['efficiency']) && ($_POST['efficiency'] == '20')) echo ' selected="selected"'; ?>>Decent</option>
		<option value="30"<?php if (isset($_POST['efficiency']) && ($_POST['efficiency'] == '30')) echo ' selected="selected"'; ?>>Very Good</option>
		<option value="50"<?php if (isset($_POST['efficiency']) && ($_POST['efficiency'] == '50')) echo ' selected="selected"'; ?>>Outstanding</option>
	</select></p>
  <!-- 4a. Better yet, modify calculator.php so that the user can enter the average speed or select it from a list of options. (Add input to the HTML)-->
  <p>Average Speed (mph): <input type="number" name="average_speed" value="<?php if (isset($_POST['avgerage_speed'])) echo $_POST['average_speed']; ?>"></p>
	<p><input type="submit" name="submit" value="Calculate!"></p>
</form>

<?php include('includes/footer-calc.html'); ?>