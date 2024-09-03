<?php
// Start the session
session_start();

// Retrieve cart from session
$cart = $_SESSION['cart'] ?? [];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Cart</title>
    <style>
        /* Internal CSS for styling */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }
        nav {
            background-color: #333;
            overflow: hidden;
        }
        nav ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            text-align: right;
        }
        nav ul li {
            display: inline;
            padding: 14px 20px;
        }
        nav ul li a {
            color: white;
            text-decoration: none;
        }
        nav .logo {
            float: left;
            color: white;
            font-size: 24px;
            padding: 14px 20px;
        }
        .main {
            padding: 20px;
        }
        .cart-container {
            width: 80%;
            margin: 0 auto;
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        .cart-header {
            text-align: center;
            font-size: 28px;
            margin-bottom: 20px;
            color: #333;
        }
        .cart-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #ccc;
            padding: 10px 0;
        }
        .cart-item img {
            width: 100px;
            height: auto;
            border-radius: 5px;
        }
        .cart-item-details {
            flex: 1;
            margin-left: 20px;
        }
        .cart-item-details h4 {
            margin: 0;
            font-size: 20px;
            color: #333;
        }
        .cart-item-details p {
            margin: 5px 0;
            color: #777;
        }
        .cart-item-price {
            font-size: 18px;
            color: #333;
        }
    </style>
</head>
<body>
    <nav>
        <label class="logo">cloth mart</label>
        <ul>
          <li><a href="index.php">Home</a></li>
          <li><a href="#">About</a></li>
          <li><a href="#">Services</a></li>
          <li><a href="#">Contact</a></li>
          <li><a href="#">Feedback</a></li>
        </ul>
    </nav>

    <div class="main">
        <div class="cart-container">
            <div class="cart-header">My Cart</div>
            <?php if (!empty($cart)): ?>
                <?php foreach ($cart as $item): ?>
                    <div class="cart-item">
                        <img src="<?php echo $item['images'][0]; ?>" alt="Product Image">
                        <div class="cart-item-details">
                            <h4><?php echo $item['title']; ?></h4>
                            <p>Quantity: <?php echo $item['qty']; ?></p>
                            <p>Size: <?php echo $item['size']; ?></p>
                        </div>
                        <div class="cart-item-price">
                            Rs. <?php echo $item['price']; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Your cart is empty.</p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>