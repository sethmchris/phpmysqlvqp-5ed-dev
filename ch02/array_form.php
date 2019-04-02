<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>
<body>

<!-- 10. Create a form that contains a select menu or series of check boxes that allow for multiple sections. Then, in the handling PHP script, display the selected items along with a count of how many the user selected.
-->

<form action="handle_array_form.php" method="post">
  <label for="courses">Select the courses you've completed so far (hold shift to select multiple):</label><br>
  <select name="courses[]" id="courses" multiple="multiple">
    <option value="Design & Internet Technology">Design & Internet Technology</option>
    <option value="Web Design Authoring">Web Design Authoring</option>
    <option value="Web Authoring Applications">Web Authoring Applications</option>
    <option value="Web Applications Scripting I">Web Applications Scripting I</option>
    <option value="Web Design Animation">Web Design Animation</option>
    <option value="Web Applications Scripting II">Web Applications Scripting II</option>
    <option value="Web Developer Final Project">Web Developer Final Project</option>
  </select>
  <br >
  <input type="submit" name="submit" value="Submit"></p>
</form>

</body>
</html>