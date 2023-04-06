<!DOCTYPE html>
<html>
<head>
	<title>Product List</title>
</head>
<body>
	<form method="POST" action="add_product.php">
		<fieldset>
			<legend><h1>Add Product</h1></legend>
			<label for="product_name">Product Name:</label>
			<input type="text" id="product_name" name="product_name" required><br><br>
			<label for="buying_price">Buying Price:</label>
			<input type="number" id="buying_price" name="buying_price" step="0.01" required><br><br>
			<label for="selling_price">Selling Price:</label>
			<input type="number" id="selling_price" name="selling_price" step="0.01" required><br><br>
			<input type="submit" value="Add Product">
		</fieldset>
	</form>

	<h1>Product List</h1>
	<form method="POST" action="display_products.php">
		<table>
			<?php
                if (isset($_POST['product_name']) && isset($_POST['buying_price']) && isset($_POST['selling_price'])) {
                   
                    $product_name = $_POST['product_name'];
                    $buying_price = $_POST['buying_price'];
                    $selling_price = $_POST['selling_price'];
                
                   
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "mydatabase";
                
                    $conn = mysqli_connect("localhost", "root", "", "labperf");
                
                    if (!$conn) {
                        die("Connection failed: " . mysqli_connect_error());
                    }
                
                    
                    $sql = "INSERT INTO products (product_name, buying_price, selling_price) VALUES ('$product_name', '$buying_price', '$selling_price')";
                
                    if (mysqli_query($conn, $sql)) {
                        echo "Product added successfully.";
                    } else {
                        echo "Error adding product: " . mysqli_error($conn);
                    }
                
                    mysqli_close($conn);
                }
            ?>

		</table>
		<input type="submit" value="Display Products">
	</form>
</body>
</html>