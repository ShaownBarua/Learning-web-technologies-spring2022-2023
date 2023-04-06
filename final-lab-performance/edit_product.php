<!DOCTYPE html>
<html>
<head>
	<title>Edit Product</title>
</head>
<body>
	<?php
	// Check if the product id is provided
	if (!isset($_GET['id'])) {
		header('Location: display_products.php');
		exit();
	}

	// Get the product id from the url parameter
	$product_id = $_GET['id'];

	// Connect to the database
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "addproduct";

    $conn = mysqli_connect("localhost", "root", "", "labperf");

	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}

	// Retrieve the product from the database
	$sql = "SELECT * FROM products WHERE product_id = '$product_id'";
	$result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($result) > 0) {
		$row = mysqli_fetch_assoc($result);
		$product_name = $row['product_name'];
		$buying_price = $row['buying_price'];
		$selling_price = $row['selling_price'];
	} else {
		echo "No product found with ID $product_id";
		mysqli_close($conn);
		exit();
	}

	// Check if the form is submitted
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		// Get the form data
		$new_buying_price = $_POST['buying_price'];
		$new_selling_price = $_POST['selling_price'];

		// Update the product in the database
		$sql = "UPDATE products SET buying_price='$new_buying_price', selling_price='$new_selling_price' WHERE product_id='$product_id'";
		if (mysqli_query($conn, $sql)) {
			echo "Product updated successfully.";
			$buying_price = $new_buying_price;
			$selling_price = $new_selling_price;
		} else {
			echo "Error updating product: " . mysqli_error($conn);
		}
	}

	mysqli_close($conn);
	?>
	<form method="POST">
		<fieldset>
			<legend><h1>Edit Product</h1></legend>
			<label for="product_name">Product Name:</label>
			<input type="text" id="product_name" name="product_name" value="<?php echo $product_name; ?>" disabled>
			<br>
			<label for="buying_price">Buying Price:</label>
			<input type="number" id="buying_price" name="buying_price" value="<?php echo $buying_price; ?>">
			<br>
			<label for="selling_price">Selling Price:</label>
			<input type="number" id="selling_price" name="selling_price" value="<?php echo $selling_price; ?>">
			<br>
			<input type="checkbox" id="display_checkbox" name="display_checkbox" value="1">
			<label for="display_checkbox">Display Product Information on this page</label>
			<br>
			<input type="submit" name="submit" value="Edit">
            <button type="back" value="back"><a href='add_product.php'>Back</a></button>
		</fieldset>
	</form>
	<?php
	// Display product information if the checkbox is checked
	if (isset($_POST['display_checkbox'])) {
		echo "<h2>Product Information</h2>";
		echo "<p><strong>Product Name:</strong> $product_name</p>";
        echo "<p><strong>Buying Price:</strong> $buying_price</p>";
		echo "<p><strong>Selling Price:</strong> $selling_price</p>";
	}
	?>
</body>
</html>
