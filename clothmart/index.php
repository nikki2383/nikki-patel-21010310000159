<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>Responsive Navbar</title>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <link rel="stylesheet" href="footer.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <link rel="stylesheet" href="main.css">
    <script>
        AOS.init();
    </script>
    <style>
        /* Responsive styles */
        body {
            margin: 0;
            font-family: Arial, sans-serif;
        }
        nav {
            background: #333;
            padding: 10px;
        }
        nav .logo {
            color: white;
            font-size: 24px;
        }
        nav ul {
            list-style: none;
            padding: 0;
        }
        nav ul li {
            display: inline;
            margin: 0 10px;
        }
        nav ul li a {
            color: white;
            text-decoration: none;
        }
        .main, .latest, .product, .product1 {
            padding: 20px;
        }
        .main img, .latest1 img, .product img, .product1 img {
            max-width: 100%;
            height: auto;
        }
        .latest, .product, .product1 {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }
        .mainpro, .latest1 {
            flex: 1 1 calc(33.333% - 40px);
            box-sizing: border-box;
        }
        @media (max-width: 768px) {
            .mainpro, .latest1 {
                flex: 1 1 calc(50% - 40px);
            }
        }
        @media (max-width: 480px) {
            .mainpro, .latest1 {
                flex: 1 1 100%;
            }
        }
    </style>
</head>
<body>
    <?php
    // Database connection settings
    $servername = "localhost";
    $username = "your_username";
    $password = "your_password";
    $dbname = "your_database_name";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch images and titles for the main content
    $sql = "SELECT chimgae, ttitle FROM img2 LIMIT 3";
    $result = $conn->query($sql);

    $images = [];
    $titles = [];

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $images[] = $row['chimgae'];
            $titles[] = $row['ttitle'];
        }
    }

    // Fetch images for the latest section
    $sql_latest = "SELECT lt FROM latestimg LIMIT 6";
    $result_latest = $conn->query($sql_latest);

    $latestImages = [];

    if ($result_latest->num_rows > 0) {
        while($row = $result_latest->fetch_assoc()) {
            $latestImages[] = $row['lt'];
        }
    }

    // Close the database connection
    $conn->close();
    ?>

    <nav>
        <input type="checkbox" id="check">
        <label for="check" class="checkbtn">
            <i class="fas fa-bars"></i>
        </label>
        <label class="logo">cloth mart</label>
        <ul>
            <li><a class="active" href="#">Home</a></li>
            <li><a href="#">About</a></li>
            <li><a href="#">Services</a></li>
            <li><a href="#">Contact</a></li>
            <li><a href="#">Feedback</a></li>
        </ul>
    </nav>

    <div class="main">
        <div class="first">
            <img src="back1.webp" alt="" class="img1" id="img1">
            <h1 class="title" id="title1">Blue Kurti</h1>
            <button class="shop" id="shop1">Shop Now</button>
        </div>
        <form id="shopForm" method="post" action="index.php" style="display: none;">
            <input type="hidden" name="image" id="productImage">
            <input type="hidden" name="title" id="productTitle">
            <input type="hidden" name="price" id="productPrice">
        </form>
        <script>
            // Embed PHP arrays into JavaScript
            const images = <?php echo json_encode($images); ?>;
            const titles = <?php echo json_encode($titles); ?>;

            let currentIndex = 0;

            function updateContent() {
                const imgElement = document.getElementById('img1');
                const titleElement = document.getElementById('title1');
                const buttonElement = document.getElementById('shop1');

                imgElement.src = images[currentIndex];
                titleElement.textContent = titles[currentIndex];
                buttonElement.textContent = "Shop Now";

                currentIndex = (currentIndex + 1) % images.length;
            }

            setInterval(updateContent, 3000);

            document.getElementById('shop1').addEventListener('click', function() {
                const form = document.getElementById('shopForm');
                document.getElementById('productImage').value = images[currentIndex];
                document.getElementById('productTitle').value = titles[currentIndex];
                document.getElementById('productPrice').value = '3000'; // Example price
                form.submit();
            });
        </script>
    </div>

    <center><h1 style="height: 100px;width:100%">Description</h1></center>

    <div class="latest">
        <?php foreach ($latestImages as $image): ?>
            <div class="latest1">
                <img src="<?php echo $image; ?>" alt="" class="img2">
                <h1 class="title1">Blue Kurti</h1> <!-- Example title -->
                <button class="shop1">Shop Now</button>
            </div>
        <?php endforeach; ?>
    </div>

    <center><h1>Latest Product</h1></center>

    <div class="product">
        <?php foreach ($images as $index => $image): ?>
            <div class="mainpro" data-aos="fade-up">
                <img src="<?php echo $image; ?>" alt="">
                <center>
                    <h3><?php echo $titles[$index]; ?></h3>
                    <h3>Rs. 3000</h3>
                </center>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="product1">
        <?php foreach ($images as $index => $image): ?>
            <div class="mainpro" data-aos="fade-up">
                <img src="<?php echo $image; ?>" alt="">
                <center>
                    <h3><?php echo $titles[$index]; ?></h3>
                    <h3>Rs. 3000</h3>
                </center>
            </div>
        <?php endforeach; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
</body>
</html>