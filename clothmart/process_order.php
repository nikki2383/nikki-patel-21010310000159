<?php
session_start();
include 'config.php';

// Retrieve cart from session
$cart = $_SESSION['cart'] ?? [];

// Calculate the total price on the server side again
$expectedTotalPrice = 0;
foreach ($cart as $item) {
    $expectedTotalPrice += $item['price'] * $item['qty'];
}

// Get the total price from the POST data
$submittedTotalPrice = $_POST['total_price'] ?? 0;

// Compare the submitted total price with the expected total price
if ($submittedTotalPrice == $expectedTotalPrice) {
    // Collect user information
    $firstName = mysqli_real_escape_string($conn, $_POST['first_name']);
    $lastName = mysqli_real_escape_string($conn, $_POST['last_name']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $country = mysqli_real_escape_string($conn, $_POST['country']);
    $pinCode = mysqli_real_escape_string($conn, $_POST['pin_code']);
    $landmark = mysqli_real_escape_string($conn, $_POST['landmark']);
    
    // Store user details and order in the database
    $query = "INSERT INTO orders (first_name, last_name, phone, email, address, country, pin_code, landmark, total_price, created_at) 
              VALUES ('$firstName', '$lastName', '$phone', '$email', '$address', '$country', '$pinCode', '$landmark', '$expectedTotalPrice', NOW())";
    
    if (mysqli_query($conn, $query)) {
        $orderId = mysqli_insert_id($conn);

        // Store each cart item in the order_items table
        foreach ($cart as $item) {
            $productId = $item['id'];
            $quantity = $item['qty'];
            $price = $item['price'];

            $itemQuery = "INSERT INTO order_items (order_id, product_id, quantity, price) 
                          VALUES ('$orderId', '$productId', '$quantity', '$price')";
            mysqli_query($conn, $itemQuery);
        }

        // Clear the cart
        unset($_SESSION['cart']);

        // Redirect to a success page
        header("Location: success.php");
        exit;
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    echo "Error: Total price mismatch. Please try again.";
}
?>