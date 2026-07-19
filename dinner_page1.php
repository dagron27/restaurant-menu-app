<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beef Tagliata</title>
    <!-- Add your CSS files, styles, or external libraries here -->
    <link rel="stylesheet" href="styles.css">
	<!-- Link to your JavaScript file -->
    <script src="navigation.js"></script>
</head>

<body>

    <header>
        <div class="header-text">
			<h1>YOUR RESTAURANT</h1>
		</div>
        <!-- Add any navigation or header content here -->
        <div class="header-button-container">
            <div class="back-button">
                <button class="back-button" onclick="goBack()">Back</button>
            </div>
            <div class="home-button">
                <button class="home-button" onclick="navigateTo('home.php')">Home</button>
            </div>
        </div>
    </header>

    <main class="main">
        <div class="left-container">
			<p class="item-text">BEEF<br>TAGLIATA</p>
		</div>
		
		<div class="right-container">
			<?php
			// Include the PHP file with your database connection and query
			include 'db.php';
			
			// Check if there are menu items
			if (!empty($menu_items)) {
				// Get the first item
				$item = $menu_items[2];

				// Check if 'image_path' is set in the $item array
				if (isset($item['image_path'])) {
					// Echo the image container
					echo '<div class="image-container"><img src="' . htmlspecialchars($item['image_path']) . '" alt="Menu Image" width="500"></div>';
				} else {
					echo "No image path!<br><br>";
				}

				// Echo the description container
				echo '<div class="description-container">' . htmlspecialchars($item['description']) . '</div>';
			} else {
				echo "No menu items available.";
			}
			?>
		</div>
    </main>

    <footer>
        <!-- Your footer content goes here -->
        <p>&copy; 2023 Your Restaurant</p>
    </footer>

</html>