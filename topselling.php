<?php 
    // Prepare statement and execute, prevents SQL injection
    $stmt = $pdo->prepare('SELECT * FROM items ORDER BY Quantiy desc limit 3 ');
    $stmt->execute();
    // Fetch the product from the database and return the result as an Array
    $productn = $stmt->fetch(PDO::FETCH_ASSOC);
    // Check if the product exists (array is not empty)
    
?>