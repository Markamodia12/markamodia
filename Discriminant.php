<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Discriminant</title>
</head>
<body>
<h1>Discriminant of a Quadratic Equation</h1>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    A: <input type="number" step="any" name="a_value" required><br><br>
    B: <input type="number" step="any" name="b_value" required><br><br>
    C: <input type="number" step="any" name="c_value" required><br><br>
    <input type="submit" name="submit" value="Submit">
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the values from the form
    $a = $_POST['a_value'];
    $b = $_POST['b_value'];
    $c = $_POST['c_value'];

    // Calculate the discriminant
    $discriminant = ($b * $b) - (4 * $a * $c);

    // Display the result
    echo "<h2>Result:</h2>";
    echo "The discriminant of the quadratic equation Ax^2 + Bx + C is: " . $discriminant;
}
?>
</body>
</html>
