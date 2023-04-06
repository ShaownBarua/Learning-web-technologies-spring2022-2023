<!DOCTYPE html>
<html>
<head>
	<title>Search Products</title>
</head>
<body>
	<form action="search_product.php" method="GET">
		<fieldset>
			<legend><h1>Search Products</h1></legend>
			<label for="search">Search:</label>
			<input type="text" name="search" id="search">
			<input type="submit" value="Search">
		</fieldset>
	</form>
	<?php
		
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "products";

        $conn = mysqli_connect("localhost", "root", "", "labperf");

		if (!$conn) {
			die("Connection failed: " . mysqli_connect_error());
		}

		
		$search_term = $_GET['search'] ?? '';
		$sql = "SELECT * FROM products WHERE product_name LIKE '%$search_term%'";
		$result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) > 0) {
			echo "<table border=1>";
			echo "<thead>";
			echo "<tr>";
			echo "<th>Product Name</th>";
			echo "<th>Buying Price</th>";
            echo "<th>Selling Price</th>";
			echo "</tr>";
			echo "</thead>";
			echo "<tbody>";
			while ($row = mysqli_fetch_assoc($result)) {
				echo "<tr>";
				echo "<td>" . $row['product_name'] . "</td>";
				echo "<td>" . $row['buying_price'] . "</td>";
                echo "<td>" . $row['selling_price'] . "</td>";

				echo "</tr>";
			}
			echo "</tbody>";
			echo "</table>";
			echo "<br><a href='add_product.php'>Back</a>";
		} else {
			echo "<p>No products found.</p>";
			echo "<br><a href='add_product.php'>Back</a>";
		}

		mysqli_close($conn);
	?>
</body>
</html>
