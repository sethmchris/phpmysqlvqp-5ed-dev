<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Sorting Arrays</title>
</head>
<body>
<table border="0" cellspacing="3" cellpadding="3" align="center">
<thead>
	<tr>
		<th><h2>Student</h2></th>
		<th><h2>Program</h2></th>
	</tr>
</thead>
<tbody>
<?php # Modified Version of Script 2.8 - sorting.php

# 9. Create a new array and then display its elements. Sort the array in different ways and then display the array’s contents again.

// Create the array:
$students = [
	'John' => 'Graphic Technician',
	'Earl' => 'Web Site Designer',
	'Marlene' => 'Graphic Technician',
	'Stephanie' => 'Web Programmer',
	'Tana' => 'Web Site Designer',
	'Donnie Darko' => 'Web Programmer'
];

// Display the students in their original order:
echo '<tr><td colspan="2"><strong>In their original order:</strong></td></tr>';
foreach ($students as $name => $program) {
	echo "<tr><td>$program</td>
	<td>$name</td></tr>\n";
}

// Display the students sorted by name:
ksort($students);
echo '<tr><td colspan="2"><strong>Sorted by name:</strong></td></tr>';
foreach ($students as $name => $program) {
	echo "<tr><td>$program</td>
	<td>$name</td></tr>\n";
}

// Display the students sorted by program:
asort($students);
echo '<tr><td colspan="2"><strong>Sorted by program:</strong></td></tr>';
foreach ($students as $name => $program) {
	echo "<tr><td>$program</td>
	<td>$name</td></tr>\n";
}

?>
</tbody>
</table>
</body>
</html>

<?php 
  // // 9. Create a new array and then display its elements. Sort the array in different ways and then display the array’s contents again.

  // // Create the students array that contains names and emails:
  // $students = [
  //   'John' => 'murty@icloud.com',
  //   'Jonie' => 'yangyan@me.com',
  //   'Marlene' => 'jespley@me.com',
  //   'Joseph' => 'jdhildeb@comcast.net',
  //   'Stephanie' => 'sequin@outlook.com',
  //   'Dan' => 'dkeeler@me.com',
  //   'Dexter' => 'dexter@mac.com',
  //   'Mohammed' => 'muadip@hotmail.com',
  //   'Jessie' => 'unreal@live.com',
  //   'Earl' => 'bachmann@yahoo.ca',
  //   'Tana' => 'tlinden@mac.com',
  //   'Nancy' => 'ninenine@mac.com'
  // ];

  // // Sort students alphabetically by email address (using asort to maintain the keys)
  // asort($students);

  // // Sort students alphabetically by name
  // // ksort($students);

  // // Loop through the students:
  // foreach ($students as $student => $email) {

  //   // Print a heading:
  //   echo "<h2>$student</h2><ul><li>$email</li></ul>\n";

  // } // End of FOREACH.

  ?>