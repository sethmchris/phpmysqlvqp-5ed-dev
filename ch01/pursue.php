<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <?php

    # Create a new script, from scratch, that defines and displays the values of some string variables. Use double quotation marks in the echo or print statement that outputs the values. For added complexity, include some HTML in the output. Then rewrite the script so that it uses single quotation marks and concatenation instead of double quotation marks.
    $student = 'John';
    $teacher = 'Mr. T.';

    echo '<p>Get back to work, <strong>' . $student . '</strong>!</p>';
    echo '<p><strong>' . $teacher . '</strong> will not stand for this!</p>';
    
    # Create a new script, from scratch, that defines, manipulates, and displays the values of some numeric variables.
    $student_age = 15;
    $graduation_age = 18;
    $years_until_graduation = $graduation_age - $student_age;

    echo '<p>' . $student . ' is ' . $student_age . ' years old!</p>';
    echo '<p> There\'s only ' . $years_until_graduation . ' years until they graduate!</p>';
    ?>
</body>
</html>