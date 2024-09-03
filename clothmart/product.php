<?php
session_start();
include 'config.php';

// Fetch product details via POST
$title = $_POST['title'] ?? 'Product Title';
$price = $_POST['price'] ?? '0';
$image1 = $_POST['image1'] ?? 'img1.webp';
$image2 = $_POST['image2'] ?? 'img2.webp';
$image3 = $_POST['image3'] ?? 'img3.webp';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_to_cart'])) {
    $product = [
        'id' => $_POST['product_id'],
        'title' => $title,
        'price' => $price,
        'image' => $image1, // Default image, can be updated with AJAX or similar
        'qty' => $_POST['qty']
    ];

    $_SESSION['cart'][] = $product;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Page</title>
    <style>
        /* Reset CSS */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }

        nav {
            background-color: #333;
            overflow: hidden;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
        }

        nav .logo {
            color: white;
            font-size: 24px;
            padding: 14px 20px;
        }

        nav ul {
            list-style-type: none;
            display: flex;
        }

        nav ul li {
            padding: 14px 20px;
        }

        nav ul li a {
            color: white;
            text-decoration: none;
        }

        .main {
            display: flex;
            padding: 20px;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
        }

        .left, .right {
            width: 100%;
            max-width: 600px;
            padding: 20px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            margin: 10px;
        }

        .left img {
            width: 100%;
            max-width: 300px;
            height: auto;
            display: block;
            margin-bottom: 10px;
        }

        .right {
            text-align: center;
        }

        .right h1, .right h2 {
            margin: 10px 0;
        }

        .button {
            padding: 10px 20px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin: 5px;
        }

        .button:hover {
            background-color: #218838;
        }

        @media (max-width: 768px) {
            .main {
                flex-direction: column;
                align-items: center;
            }

            .left img {
                max-width: 100%;
            }

            .right h1, .right h2 {
                font-size: 1.2em;
            }
        }

        @media (max-width: 480px) {
            nav ul {
                flex-direction: column;
                align-items: center;
            }

            nav ul li {
                padding: 10px;
            }
        }
    </style>
</head>
<body>
    <nav>
        <label class="logo">cloth mart</label>
        <ul>
            <li><a href="index.php" class="active">Home</a></li>
            <li><a href="#">About</a></li>
            <li><a href="#">Services</a></li>
            <li><a href="#">Contact</a></li>
            <li><a href="#">Feedback</a></li>
        </ul>
    </nav>

    <div class="main">
        <div class="left">
            <img src="<?php echo $image1; ?>" alt="Product Image">
            <img src="<?php echo $image2; ?>" alt="Product Image">
            <img src="<?php echo $image3; ?>" alt="Product Image">
        </div>
        <div class="right">
            <h2><?php echo $title; ?></h2>
            <h1>Rs. <?php echo $price; ?></h1>
            <h1>Qty: <input type="number" name="qty" value="1" min="1" class="num"></h1>
            <form action="index.php" method="post">
                <input type="hidden" name="product_id" value="1">
                <input type="hidden" name="title" value="<?php echo $title; ?>">
                <input type="hidden" name="price" value="<?php echo $price; ?>">
                <input type="hidden" name="image1" value="<?php echo $image1; ?>">
                <input type="hidden" name="image2" value="<?php echo $image2; ?>">
                <input type="hidden" name="image3" value="<?php echo $image3; ?>">
                <input type="hidden" name="qty" value="1">
                <button type="submit" name="add_to_cart" class="button">Add to Cart</button>
                <button type="button" class="button">Buy Now</button>
            </form>
        </div>
    </div>
</body>
</html>