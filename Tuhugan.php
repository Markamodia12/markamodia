<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Welcome to the Tuhugan!</title>
<style>
    body {
        font-family: Arial, sans-serif;
    }
    .container {
        max-width: 600px;
        margin: 0 auto;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }
    h1 {
        text-align: center;
    }
    form {
        margin-bottom: 20px;
    }
</style>
</head>
<body>
<div class="container">
    <h1>Welcome to the Tuhugan!</h1>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <p>Here's the menu and the prices:</p>
        <ul>
            <li>Fishball - 30 PHP</li>
            <li>Kikiam - 40 PHP</li>
            <li>Corndog - 50 PHP</li>
        </ul>
        <label for="order">Choose your preferred order:</label>
        <select name="order" id="order" required>
            <option value="Fishball">Fishball</option>
            <option value="Kikiam">Kikiam</option>
            <option value="Corndog">Corndog</option>
        </select><br><br>
        Quantity: <input type="number" name="quantity" required><br><br>
        Cash: <input type="number" name="cash" required><br><br>
        <input type="submit" name="submit" value="Submit">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $order = $_POST['order'];
        $quantity = $_POST['quantity'];
        $cash = $_POST['cash'];

        // Define prices
        $prices = array(
            "Fishball" => 30,
            "Kikiam" => 40,
            "Corndog" => 50
        );

        // Calculate total cost
        $total_cost = $prices[$order] * $quantity;

        // Calculate change
        $change = $cash - $total_cost;

        // Display receipt
        echo "<h2>Receipt</h2>";
        echo "Your order: $order<br>";
        echo "Quantity: $quantity<br>";
        echo "Total cost: $total_cost PHP<br>";
        echo "Cash received: $cash PHP<br>";
        echo "Your change: $change PHP<br><br>";
        echo "Thanks for ordering!";
    }
    ?>
</div>
</body>
</html>
