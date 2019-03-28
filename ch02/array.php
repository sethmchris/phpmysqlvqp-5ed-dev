<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>
<body>

<form action="array.php" method="post">
  <label for="courses">Select the courses you've completed so far:</label><br>
  <select name="courses" id="courses" multiple="multiple">
    <option name="courses[]" value="kmdt0101">Design & Internet Technology</option>
    <option name="courses[]" value="kmdt0120">Web Design Authoring</option>
    <option name="courses[]" value="kmdt0130">Web Authoring Applications</option>
    <option name="courses[]" value="kmdt0230">Web Applications Scripting I</option>
    <option name="courses[]" value="kmdt0140">Web Design Animation</option>
    <option name="courses[]" value="kmdt0240">Web Applications Scripting II</option>
    <option name="courses[]" value="kmdt0210">Web Developer Final Project</option>
  </select>
  
  <input type="submit" name="submit" value="Submit"></p>
</form>

<?php
  // Courses array
  $interests = $_POST['interests'];
  if(empty($interests)){
    echo("You didn't select any interests.");
  }else{
    $N = count($interests);
    echo("<p>You selected $N interests: </p>");

    sort($interests);
    for($i=0; $i < $N; $i++){
    //   sort($interests[$i] . "<br>" . " ");
    }
  }
  ?>
</body>
</html>