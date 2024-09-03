<?php
session_start();
include 'config.php';

// Handle removing an item from the cart
if (isset($_POST['remove'])) {
    $removeId = $_POST['product_id'];
    foreach ($_SESSION['cart'] as $key => $item) {
        if ($item['id'] == $removeId) {
            unset($_SESSION['cart'][$key]);
            break;
        }
    }
}

// Handle updating the quantity
if (isset($_POST['update'])) {
    $updateId = $_POST['product_id'];
    $newQty = $_POST['quantity'];
    foreach ($_SESSION['cart'] as &$item) {
        if ($item['id'] == $updateId) {
            $item['qty'] = $newQty;
            break;
        }
    }
}

// Calculate the total price
$totalPrice = 0;
$cart = $_SESSION['cart'] ?? [];
foreach ($cart as $item) {
    $totalPrice += $item['price'] * $item['qty'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Form</title>
    <style>
        /* Internal CSS */
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; background-color: #f5f5f5; }
        nav { background-color: #333; overflow: hidden; }
        nav ul { list-style-type: none; margin: 0; padding: 0; text-align: right; }
        nav ul li { display: inline; padding: 14px 20px; }
        nav ul li a { color: white; text-decoration: none; }
        nav .logo { float: left; color: white; font-size: 24px; padding: 14px 20px; }
        .main { padding: 20px; }
        .order-container { width: 80%; margin: 0 auto; background-color: white; padding: 20px; border-radius: 10px; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); }
        .order-header { text-align: center; font-size: 28px; margin-bottom: 20px; color: #333; }
        .cart-item { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
        .cart-item img { width: 100px; }
        .cart-item-details { flex: 1; margin-left: 20px; }
        .cart-item-actions { display: flex; align-items: center; }
        .cart-item-actions input[type="number"] { width: 50px; margin-right: 10px; }
        .total-price { text-align: right; font-size: 20px; margin-top: 20px; font-weight: bold; color: #333; }
        .buy-button { display: block; width: 100%; padding: 15px; background-color: #28a745; color: white; border: none; border-radius: 5px; font-size: 18px; cursor: pointer; margin-top: 20px; }
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
        <div class="order-container">
            <div class="order-header">My Cart</div>
            <form action="order.php" method="post">
                <?php foreach ($cart as $item): ?>
                    <div class="cart-item">
                        <img src="<?php echo $item['image']; ?>" alt="Product Image">
                        <div class="cart-item-details">
                            <h3><?php echo $item['title']; ?></h3>
                            <p>Price: Rs. <?php echo $item['price']; ?></p>
                        </div>
                        <div class="cart-item-actions">
                            <input type="number" name="quantity" value="<?php echo $item['qty']; ?>" min="1">
                            <input type="hidden" name="product_id" value="<?php echo $item['id']; ?>">
                            <button type="submit" name="update">Update</button>
                            <button type="submit" name="remove">Remove</button>
                        </div>
                    </div>
                <?php endforeach; ?>
            </form>

            <div class="total-price">
                Total Price: Rs. <?php echo $totalPrice; ?>
            </div>

            <form action="process_order.php" method="post">
                <h3>User Details</h3>
                <div class="form-group">
                    <label for="first_name">First Name:</label>
                    <input type="text" id="first_name" name="first_name" required>
                </div>
                <div class="form-group">
                    <label for="last_name">Last Name:</label>
                    <input type="text" id="last_name" name="last_name" required>
                </div>
                <div class="form-group">
                    <label for="phone">Phone Number:</label>
                    <input type="tel" id="phone" name="phone" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="address">Address:</label>
                    <input type="text" id="address" name="address" required>
                </div>
                <div class="form-group">
                    <label for="country">Country:</label>
                    <input type="text" id="country" name="country" required>
                </div>
                <div class="form-group">
                    <label for="pin_code">Pin Code:</label>
                    <input type="text" id="pin_code" name="pin_code" required>
                </div>
                <div class="form-group">
                    <label for="landmark">Landmark:</label>
                    <input type="text" id="landmark" name="landmark">
                </div>

                <input type="hidden" name="total_price" value="<?php echo $totalPrice; ?>">
                <button type="submit" class="buy-button">Buy Now</button>
            </form>
        </div>
    </div>
</body>
</html>