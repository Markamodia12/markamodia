<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login Page</title>
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
    h1, h2 {
        text-align: center;
    }
    form {
        margin-bottom: 20px;
    }
    .form-group {
        margin-bottom: 15px;
    }
    label {
        display: block;
        margin-bottom: 5px;
    }
    input[type="text"], input[type="password"], input[type="number"], select {
        width: 100%;
        padding: 8px;
        box-sizing: border-box;
    }
    input[type="submit"] {
        width: 100%;
        padding: 10px;
        background-color: #4CAF50;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }
    .register-link {
        text-align: center;
    }
</style>
</head>
<body>
<div class="container">

<?php
session_start();

function display_login_form($error = "") {
    echo '
    <h1>Login here</h1>
    <form method="post" action="">
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" placeholder="Username" required>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" placeholder="Password" required>
        </div>
        <input type="submit" name="login" value="Login">
    </form>
    <div class="register-link">
        <p>Don\'t have an account? <a href="#">Register</a></p>
    </div>';
    if ($error) {
        echo '<p style="color:red;">' . $error . '</p>';
    }
}

function display_main_page() {
    echo '
    <h1>Welcome to the Tuhugan!</h1>
    <form method="post" action="">
        <p>Here\'s the menu and the prices:</p>
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
        <input type="submit" name="submit_order" value="Submit">
    </form>';
}

function display_receipt($order, $quantity, $cash, $total_cost, $change) {
    echo "<h2>Receipt</h2>";
    echo "Your order: $order<br>";
    echo "Quantity: $quantity<br>";
    echo "Total cost: $total_cost PHP<br>";
    echo "Cash received: $cash PHP<br>";
    echo "Your change: $change PHP<br><br>";
    echo "Thanks for ordering!";
}

$valid_username = "user";
$valid_password = "password";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username == $valid_username && $password == $valid_password) {
        $_SESSION['loggedin'] = true;
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    } else {
        display_login_form("Invalid username or password.");
    }
} elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit_order'])) {
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
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

        display_receipt($order, $quantity, $cash, $total_cost, $change);
        echo '<p><a href="' . htmlspecialchars($_SERVER['PHP_SELF']) . '?logout=true">Back to Login Page</a></p>';
        exit();
    } else {
        display_login_form("Please log in first.");
    }
} else {
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
        display_main_page();
    } else {
        display_login_form();
    }
}

// Handle logout
if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}
?>

</div>
</body>
</html>
