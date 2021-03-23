<?PHP

$Current_Pg = $_GET['Product_Category'];
$sql = "SELECT count(*) FROM items WHERE product_category = ?"; 
$result = $pdo->prepare($sql); 
$result->execute([$Current_Pg]); 
$number_of_rows = $result->fetchColumn();



?>