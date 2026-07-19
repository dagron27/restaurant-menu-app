<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Breakfast Menu</title>
    <!-- Add your CSS files, styles, or external libraries here -->
    <link rel="stylesheet" href="assets/css/styles.css">
	<!-- Link to your JavaScript file -->
    <script src="assets/js/navigation.js"></script>
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
			<p class="selection-text">BREAKFAST</p>
        </div>

        <!-- Buttons to navigate to new breakfast pages -->
        <div class="right-container">
			<div class="button-one">
				<button class="primary-button" onclick="navigateTo('breakfast_page1.php')">Focaccia</button>
			</div>
			<div class="button-two">
				<button class="primary-button" onclick="navigateTo('breakfast_page2.php')">Frutta Fresca</button>
			</div>
        </div>
    </main>

    <footer>
        <!-- Your footer content goes here -->
        <p>&copy; 2023 Your Restaurant</p>
    </footer>

</body>

</html>