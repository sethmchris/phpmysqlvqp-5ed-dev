<?php
  $courses = $_POST['courses']; // Courses array
  $completedCourses = count($courses); // Count number of courses the user has submitted
  
  # 11. For added complexity, take the suggested PHP script you just created (that handles multiple selections), and have it display the selections in alphabetical order.
  sort($courses); // Sort $courses array WITHOUT assigning its output to a variable - that would require a different sort() function which goes beyond the scope of this exercise
  
  if (empty($courses)) { // Check if value is empty
    echo "You didn't select any courses";
  } else { // Echo number of selected courses
    echo "You've completed {$completedCourses} courses:<br />"; 
    foreach ($courses as $course) {
      echo "{$course}<br />";
    }
  }
?>