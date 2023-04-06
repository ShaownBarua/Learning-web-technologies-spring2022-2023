<?php

if (!isset($_GET['id'])) {
    header('Location: display_products.php');
exit();

}


$product_id = $_GET['id'];


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "addproduct";

$conn = mysqli_connect("localhost", "root", "", "labperf");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


$sql = "DELETE FROM products WHERE product_id = '$product_id'";

if (mysqli_query($conn, $sql)) {
    echo "Product deleted successfully.";
   
    header("Location: display_products.php");
    exit();

} else {
    echo "Error deleting product: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
