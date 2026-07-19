<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Menu</title>
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
		
        <div class="header-button-container">
            <div class="back-button">

            </div>
            <div class="home-button">
                <button class="home-button" onclick="navigateTo('home.php')">Home</button>
            </div>
        </div>
        <!-- Add any navigation or header content here -->
    </header>

    <main class="main">
        <!-- Your main content goes here -->
        <div class="left-container">
				<p>MENU</p>
        </div>
		
        <!-- Buttons to navigate to breakfast and dinner pages -->
        <div class="right-container">
			<div class="button-one">
				<button class="primary-button" onclick="navigateTo('breakfast.php')">Breakfast</button>
			</div>
			<div class="button-two">
				<button class="primary-button" onclick="navigateTo('dinner.php')">Dinner</button>
			</div>
        </div>
    </main>

    <footer>
        <!-- Your footer content goes here -->
        <p>&copy; 2023 Your Restaurant</p>
    </footer>

</html>