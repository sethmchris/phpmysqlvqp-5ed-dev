<?php # Modified version of Script 9.6 - view_users.php #2
// This script retrieves all the records from the customers table.

$page_title = 'View the Current Customers';
include('includes/header.html');

// Page header:
echo '<h1>Customers</h1>';

require('../mysqli_connect2.php'); // Connect to the db.

// Make the query:
$q = "SELECT CONCAT(last_name, ', ', first_name) AS name FROM customers ORDER BY last_name ASC";
$r = @mysqli_query($dbc, $q); // Run the query.

// $num = mysqli_num_rows($r);

if ($r) { // Check if the query had a TRUE result
	// Count the number of returned rows:
	$num = mysqli_num_rows($r);
}

if ($num > 0) { // If it ran OK, display the records.

	// Print how many users there are:
	echo "<p>There are currently $num customers.</p>\n";

	// Table header.
	echo '<table width="60%">
	<thead>
	<tr>
		<th align="left">Name</th>
	</tr>
	</thead>
	<tbody>
';

	// Fetch and print all the records:
	while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
		echo '<tr><td align="left">' . $row['name'] . '</td><td align="left"></tr>
		';
	}

	echo '</tbody></table>'; // Close the table.

	mysqli_free_result ($r); // Free up the resources.

} else { // If no records were returned.

	echo '<p class="error">There are currently no customers.</p>';

}

mysqli_close($dbc); // Close the database connection.

include('includes/footer.html');
?>