<?php
// Get the drink details from URL parameters
$drinkName = isset($_GET['name']) ? $_GET['name'] : "Unknown Drink";
$drinkDescription = isset($_GET['description']) ? $_GET['description'] : "No description available.";
$imageSrc = isset($_GET['imageSrc']) ? $_GET['imageSrc'] : "default.png";

// Define options for milk, tea, and add-ins
$milkOptions = ["2% Milk", "Whole Milk", "Almond Milk"];
$teaOptions = ["None", "Black Tea", "Green Tea"];
$addinsOptions = ["Ice, Vanilla Syrup", "No Ice", "Extra Ice"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Drink Customization</title>
    <style>
        /* Add your CSS styles from the second code */
        body {
            font-family: Arial, sans-serif;
            background-color: #f6f6f6;
            margin: 0;
            padding: 0;
        }

        .back-button {
            position: absolute;
            top: 130px;
            left: 40px;
            padding: 10px 20px;
            background-color: #fff;
            border: 2px solid #333;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .back-button:hover {
            background-color: #333;
            color: #fff;
        }

        .main-container {
            max-width: 800px;
            margin: 50px auto;
            background-color: white;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Header Section */
        h1 {
            font-size: 32px;
            color: #ff6600;
            text-align: center;
        }

        /* Drink Display Box */
        .drink-display-box {
            wwidth: 90%;           
      max-width: 1650px;    
      height: 600px;        
      background-color: #fff;
      border-radius: 20px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
      position: relative;
      overflow: hidden;
      margin-top: 180px;
      margin-left: 10%;
        }

        /* Drink Image */
        .drink-display img {
            width: 150px; /* Reduced width */
            height: auto; /* Maintain aspect ratio */
            object-fit: cover; /* Ensure the image fills the area, maintaining aspect ratio */
            border-radius: 12px;
            margin-right: 20px;
            flex-shrink: 0; /* Prevents shrinking */
        }

        /* Drink Information */
        .drink-info {
            flex-grow: 1;
            text-align: left;
        }

        .product-name {
            font-size: 22px;
            font-weight: bold;
            color: #ff6600;
            margin-top: 10px;
        }

        .product-description {
            font-size: 16px;
            color: #333;
            margin-top: 5px;
            line-height: 1.5;
        }

        /* Options Container */
        .options-container {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        /* Size Options and What's Included */
        .size-options {
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: white;
            margin-right: 10px; /* Space between sections */
            flex: 1; /* Equal width for size options */
        }

        .whats-included {
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: white;
            flex: 1; /* Equal width for what's included */
        }

        .size-options h3, .whats-included h3 {
            font-size: 20px;
            margin-bottom: 10px;
        }

        .size-option {
            margin: 10px 0;
        }

        .size-option input {
            margin-right: 10px;
        }

        /* Customize Button */
        .customize-button {
            display: block;
            padding: 12px 25px;
            background-color: #004236;
            color: white;
            text-transform: uppercase;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
            margin: 0 auto; /* Center the button */
        }

        .customize-button:hover {
            background-color: #00705a;
        }

        .back-button {
            position: absolute;
            top: 130px;
            left: 40px;
            padding: 10px 20px;
            background-color: #fff;
            border: 2px solid #333;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .back-button:hover {
            background-color: #333;
            color: #fff;
        }
        .add-to-cart-button{
            display: block;
            padding: 12px 25px;
            background-color: #004236;
            color: white;
            text-transform: uppercase;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
            margin: 0 auto;
            margin-top: 8px
        }

        .add-to-cart-button:hover {
            background-color: #00705a;
        }

        /* Modal for Customization */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            padding-top: 100px;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
        }

        .modal-content {
            background-color: #fff;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.2);
            width: 60%;
            margin: auto;
            font-family: Arial, sans-serif;
            max-height: 80vh;
            overflow-y: auto;
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #e0e0e0;
            padding-bottom: 10px;
        }

        .modal-header h2 {
            font-size: 24px;
            color: #004236;
        }

        .close-button {
            background-color: #004236;
            color: white;
            border: none;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            cursor: pointer;
        }

        .close-button:hover {
            background-color: #00705a;
        }

        /* Customization Options */
        #milkSection, #teaSection, #addinsSection {
            margin: 20px 0;
        }

        label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
            color: #004236;
        }

        select {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 6px;
            background-color: #f9f9f9;
        }

        /* Save Button */
        .save-button {
            background-color: #004236;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            text-align: center;
            display: block;
            margin: 20px auto;
            font-weight: bold;
            text-transform: uppercase;
        }

        .save-button:hover {
            background-color: #00705a;
        }
    
    </style>
</head>
<body>

<button class="back-button" onclick="goBack()">Back</button>
<!-- Drink Display Box -->
<div class="drink-display-box">
            <img id="drinkImage" src="<?php echo $imageSrc; ?>" alt="<?php echo $drinkName; ?>">
            <div class="drink-info">
                <p class="product-name"><?php echo $drinkName; ?></p>
                <p class="product-description"><?php echo $drinkDescription; ?></p>
            </div>
        </div>
    <!-- Drink Display Box with Image and Text -->
    <div class="main-container">
        <h1>Customize Your Drink</h1>

        

        <!-- Options Container -->
        <div class="options-container">
            <!-- Size Options -->
            <div class="size-options">
                <h3>Size options</h3>
                <div class="size-option">
                    <input type="radio" name="size" value="Tall" id="sizeTall">
                    <label for="sizeTall">Tall (12 fl oz)</label>
                </div>
                <div class="size-option">
                    <input type="radio" name="size" value="Grande" id="sizeGrande" checked>
                    <label for="sizeGrande">Grande (16 fl oz)</label>
                </div>
                <div class="size-option">
                    <input type="radio" name="size" value="Venti" id="sizeVenti">
                    <label for="sizeVenti">Venti (24 fl oz)</label>
                </div>
            </div>

            <!-- What's Included Section -->
            <div class="whats-included">
                <h3>What's Included</h3>
                <p id="milkIncluded">Milk: <?php echo $milkOptions[0]; ?></p>
                <p id="teaIncluded">Tea: <?php echo $teaOptions[0]; ?></p>
                <p id="addinsIncluded">Add-ins: <?php echo $addinsOptions[0]; ?></p>
            </div>
        </div>

        <!-- Customize Button -->
        <button class="customize-button" onclick="openModal()">Customize</button>
        <button class="add-to-cart-button">Add to Bag</button>
    

    </div>

    <!-- Modal Popup -->
    <div id="customizeModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Customize Your Drink</h2>
                <button class="close-button" onclick="closeModal()">&times;</button>
            </div>

            <!-- Customization Form -->
            <div id="milkSection">
                <label for="milkSelect">Milk:</label>
                <select id="milkSelect">
                    <?php foreach ($milkOptions as $milk) {
                        echo "<option value='$milk'>$milk</option>";
                    } ?>
                </select>
            </div>

            <div id="teaSection">
                <label for="teaSelect">Tea:</label>
                <select id="teaSelect">
                    <?php foreach ($teaOptions as $tea) {
                        echo "<option value='$tea'>$tea</option>";
                    } ?>
                </select>
            </div>

            <div id="addinsSection">
                <label for="addinsSelect">Add-ins:</label>
                <select id="addinsSelect">
                    <?php foreach ($addinsOptions as $addins) {
                        echo "<option value='$addins'>$addins</option>";
                    } ?>
                </select>
            </div>

            <!-- Save Button -->
            <button class="save-button" onclick="saveCustomization()">Save</button>
        </div>
    </div>

    <script>

        function goBack() {
            window.history.back();
        }

        function openModal() {
            document.getElementById('customizeModal').style.display = 'block';
        }

        function closeModal() {
            document.getElementById('customizeModal').style.display = 'none';
        }

        function saveCustomization() {
            const milk = document.getElementById('milkSelect').value;
            const tea = document.getElementById('teaSelect').value;
            const addins = document.getElementById('addinsSelect').value;

            document.getElementById('milkIncluded').innerText = `Milk: ${milk}`;
            document.getElementById('teaIncluded').innerText = `Tea: ${tea}`;
            document.getElementById('addinsIncluded').innerText = `Add-ins: ${addins}`;

            closeModal();
        }
    </script>
</body>
</html>
