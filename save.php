<?php
  // Create database connection
  require 'dbconfig.php';

  // Initialize message variable
  $msg = "";

  // If upload button is clicked ...
  if (isset($_POST['save'])) {
  	// Get image name
  	$Main_image = $_FILES['Main_Image']['name'];
    $Side_image1 = $_FILES['Side_image1']['name'];
    $Side_image2 = $_FILES['Side_image2']['name'];
    $Side_image3 = $_FILES['Side_image3']['name'];
  	// Get text
  	//$Main_Image = mysqli_real_escape_string($conn, $_POST['Main_Image']);


        
    


  	// image file directory
  	$target = "img/".basename($Main_image);
    $target1 = "img/".basename($Side_image1);
    $target2 = "img/".basename($Side_image2);
    $target3 = "img/".basename($Side_image3);

  	$sql = "INSERT INTO items (Product_Name,Product_Type,Product_Description, Product_Price,Product_Category,Product_Status,Product_Discount,Product_Brand,Product_Specifications,Quantity,Main_Image, Side_image1,Side_image2, Side_Image3,Maintained_By,Product_Color) VALUES ('".$_POST["Product_Name"]."','".$_POST["Product_Type"]."','".$_POST["Product_Description"]."', '".$_POST["Product_Price"]."','".$_POST["Product_Category"]."','".$_POST["Product_Status"]."','".$_POST["Product_Discount"]."','".$_POST["Product_Brand"]."','".$_POST["product_specs"]."','".$_POST["Quantity"]."','$Main_image', '$Side_image1','$Side_image2', '$Side_image3','ADMIN','".$_POST["Product_Color"]."')";



  	// execute query
  	mysqli_query($conn, $sql);

  	if (move_uploaded_file($_FILES['Main_Image']['tmp_name'], $target)) {
  		$msg = "Product added successfully";
  	}else{
  		$msg = "Failed to save item";
  	}
    if (move_uploaded_file($_FILES['Side_image1']['tmp_name'], $target1)) {
      $msg = "Product added successfully";
    }else{
      $msg = "Failed to save item";
    }
    if (move_uploaded_file($_FILES['Side_image2']['tmp_name'], $target2)) {
      $msg = "Product added successfully";
    }else{
      $msg = "Failed to save item";
    }
    if (move_uploaded_file($_FILES['Side_image3']['tmp_name'], $target3)) {
      $msg = "Product added successfully";
    }else{
      $msg = "Failed to save item";
    }

    session_start();
    $_SESSION['success_message'] = "Item ".$_POST["Product_Name"]."added successfully.";
    header("Location: index.php?page=newproduct");
    exit();
  }
  $result = mysqli_query($conn, "SELECT * FROM items");

?>