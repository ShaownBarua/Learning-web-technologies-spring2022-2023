<!DOCTYPE html>
<html>
<head>
	<title>Product List</title>
</head>
<body>
	<form method="POST" action="update_delete_product.php">
		<fieldset>
			<legend><h1>Display</h1></legend>
			<table>
				<thead>
					<tr>
						<th>Name</th>
						<th>Profit</th>
						<th>|</th>
						<th>Edit</th>
						<th>Delete</th>
					</tr>
				</thead>
				<tbody>
					<?php
						// Connect to the database
						$servername = "localhost";
						$username = "root";
						$password = "";
						$dbname = "addproduct";

                        $conn = mysqli_connect("localhost", "root", "", "labperf");

						if (!$conn) {
							die("Connection failed: " . mysqli_connect_error());
						}

						// Retrieve the products from the database
						$sql = "SELECT * FROM products";
						$result = mysqli_query($conn, $sql);

						if (mysqli_num_rows($result) > 0) {
							while ($row = mysqli_fetch_assoc($result)) {
                                $profit = $row['selling_price'] - $row['buying_price'];
                                echo "<tr>";
                                echo "<td>" . $row['product_name'] . "</td>";
                                echo "<td>" . $profit . "</td>";
                                echo "<td>|</td>";
                                echo "<td><a href='edit_product.php?id=" . $row['product_id'] . "'>Edit</a></td>";
                                echo "<td><a href='delete_product.php?id=" . $row['product_id'] . "'>Delete</a></td>";
                                echo "</tr>";
                                echo "<tr><td colspan='6'><hr></td></tr>";
                            }
                            
						} else {
							echo "<tr><td colspan='6'>No products found.</td></tr>";
						}

						mysqli_close($conn);
					?>
				</tbody>
			</table>
			<input type="submit" name="delete" value="Delete">
            <button type="back" value="back"><a href='add_product.php'>Back</a></button>
            <button type="Search" value="Search"><a href='search_product.php'>Search</a></button>
		</fieldset>
	</form>
</body>
</html>