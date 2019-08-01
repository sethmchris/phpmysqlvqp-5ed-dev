<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Form Feedback</title>
</head>
<body>
<?php 
  # 1. If you haven't applied the Filter function (for email validation) and the sapm_scrubber() function to a contact form used on one of your sites, do so now!

  // Check for form submission:
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    /* The function takes one argument: a string.
    * The function returns a clean version of the string.
    * The clean version may be either an empty string or
    * just the removal of all newline characters.
    */
    function spam_scrubber($value) {

      // List of very bad values:
      $very_bad = ['to:', 'cc:', 'bcc:', 'content-type:', 'mime-version:', 'multipart-mixed:', 'content-transfer-encoding:'];

      // If any of the very bad strings are in
      // the submitted value, return an empty string:
      foreach ($very_bad as $v) {
        if (stripos($value, $v) !== false) return '';
      }

      // Replace any newline characters with spaces:
      $value = str_replace(["\r", "\n", "%0a", "%0d"], ' ', $value);

      // Return the value:
      return trim($value);

    } // End of spam_scrubber() function.

    // Create a shorthand for the form data:
    $studentName = $_REQUEST['student-name'];
    $date = $_REQUEST['date'];
    $comments = $_REQUEST['comments'];

    // Clean the form data:
    $scrubbed = array_map('spam_scrubber', $_POST);

    // Minimal form validation:
    if (!empty($scrubbed['student-name']) && !empty($scrubbed['date']) && !empty($scrubbed['comments'])) {

      // Print the submitted information:
      echo "<p>Thank you for the comments regarding the following student:<strong> {$scrubbed['student-name']}</strong></p><pre>{$scrubbed['comments']}</pre> <p>Submission date: <em>{$scrubbed['date']}</em></p>\n";

      // Clear $scrubbed (so that the form's not sticky):
      $scrubbed = [];

    } else {
      echo '<p style="font-weight: bold; color: #C00">Please fill out the form completely.</p>';
    }

  } // End of main isset() IF.

// Create the HTML form:
?>
<form action="handle_form.php" method="post">

<fieldset><legend>Enter your information in the form below:</legend>

<p><label>Student Name: <input type="text" name="student-name" size="20" maxlength="40" value="<?php if (isset($scrubbed['student-name'])) echo $scrubbed['student-name']; ?>"></label></p>

<p><label>Date: <input type="date" name="date" value="<?php if (isset($scrubbed['date'])) echo $scrubbed['date']; ?>"></label></p>

<p><label>Comments: <textarea name="comments" rows="3" cols="40" value="<?php if (isset($scrubbed['comments'])) echo $scrubbed['comments']; ?>"></textarea></label></p>

</fieldset>

<p align="center"><input type="submit" name="submit" value="Submit My Information"></p>

</form>

</body>
</html>