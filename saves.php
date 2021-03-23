<?PHP



     

 


 // include 'order_id.php';
  $Order_ID=$_POST['Order_ID']; 

    $stmt = $pdo->prepare("INSERT INTO orders (first_name,last_name,email,address,city,country,zip_code,tel,Order_Details,Total_Cost,Order_ID) VALUES (:first_name, :last_name,:email, :address,:city,:country,:zip_code,:tel,:Order_Details,:Total_Cost,:Order_ID )");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt->bindParam(':Order_ID', $Order_ID);
    $stmt->bindParam(':first_name', $first_name);
    $stmt->bindParam(':last_name', $last_name);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':address', $address);
    $stmt->bindParam(':city', $city);
    $stmt->bindParam(':country', $country);
    $stmt->bindParam(':zip_code', $zip_code);
    $stmt->bindParam(':tel', $phonenumber);
    $stmt->bindParam(':Order_Details', $Order_Details);
    $Total_Cost = $amount;
    $stmt->bindParam(':Total_Cost',$Total_Cost);
    
    

    $first_name = clean($_POST["first_name"]);
    $last_name = clean($_POST["last_name"]);
    $email = clean($_POST["email"]);
    $address = clean($_POST["address"]);
    $city = clean($_POST["city"]);
    $country = clean($_POST["country"]);
    $zip_code = clean($_POST["zip_code"]);
   // $phonenumber = clean($_POST["tel"]);
    $order_notes = clean($_POST["order_notes"]);
    $stmt->execute();

    




function clean($userInput) {
  $userInput = trim($userInput);
  $userInput = stripslashes($userInput);
  $userInput = htmlspecialchars($userInput);
  return $userInput;
}
$conn = null;



    ?>