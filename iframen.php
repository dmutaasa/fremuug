<?php
  include_once('OAuth.php');

// If the user clicked the add to cart button on the product page we can check for the form data
if (isset($_POST['product_id'], $_POST['quantity']) && is_numeric($_POST['product_id']) && is_numeric($_POST['quantity'])) {
    // Set the post variables so we easily identify them, also make sure they are integer
    $product_id = (int)$_POST['product_id'];
    $quantity = (int)$_POST['quantity'];
    // Prepare the SQL statement, we basically are checking if the product exists in our database
    $stmt = $pdo->prepare('SELECT * FROM items WHERE Product_ID = ?');
    $stmt->execute([$_POST['product_id']]);
    // Fetch the product from the database and return the result as an Array
    $product = $stmt->fetch(PDO::FETCH_ASSOC);
    // Check if the product exists (array is not empty)
    if ($product && $quantity > 0) {
        // Product exists in database, now we can create/update the session variable for the cart
        if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
            if (array_key_exists($product_id, $_SESSION['cart'])) {
                // Product exists in cart so just update the quanity
                $_SESSION['cart'][$product_id] += $quantity;
            } else {
                // Product is not in cart so add it
                $_SESSION['cart'][$product_id] = $quantity;
            }
        } else {
            // There are no products in cart, this will add the first product to cart
            $_SESSION['cart'] = array($product_id => $quantity);
        }
    }
    // Prevent form resubmission...
    header('location: index.php?page=cart');
    exit;
}
// Remove product from cart, check for the URL param "remove", this is the product id, make sure it's a number and check if it's in the cart
if (isset($_GET['remove']) && is_numeric($_GET['remove']) && isset($_SESSION['cart']) && isset($_SESSION['cart'][$_GET['remove']])) {
    // Remove the product from the shopping cart
    unset($_SESSION['cart'][$_GET['remove']]);
}
// Update product quantities in cart if the user clicks the "Update" button on the shopping cart page
if (isset($_POST['update']) && isset($_SESSION['cart'])) {
    // Loop through the post data so we can update the quantities for every product in cart
    foreach ($_POST as $k => $v) {
        if (strpos($k, 'quantity') !== false && is_numeric($v)) {
            $id = str_replace('quantity-', '', $k);
            $quantity = (int)$v;
            // Always do checks and validation
            if (is_numeric($id) && isset($_SESSION['cart'][$id]) && $quantity > 0) {
                // Update new quantity
                $_SESSION['cart'][$id] = $quantity;
            }
        }
    }
    // Prevent form resubmission...
    header('location: index.php?page=cart');
    exit;
}
// Send the user to the place order page if they click the Place Order button, also the cart should not be empty
if (isset($_POST['placeorder']) && isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    header('Location: index.php?page=placeorder');
    exit;
}
// Check the session variable for products in cart
$products_in_cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
$products = array();
$subtotal = 0.00;
// If there are products in cart
if ($products_in_cart) {
    // There are products in the cart so we need to select those products from the database
    // Products in cart array to question mark string array, we need the SQL statement to include IN (?,?,?,...etc)
    $array_to_question_marks = implode(',', array_fill(0, count($products_in_cart), '?'));
    $stmt = $pdo->prepare('SELECT * FROM items WHERE  Product_ID IN (' . $array_to_question_marks . ')');
    // We only need the array keys, not the values, the keys are the id's of the products
    $stmt->execute(array_keys($products_in_cart));
    // Fetch the products from the database and return the result as an Array
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // Calculate the subtotal
    foreach ($products as $product) {
        $subtotal += (float)$product['Product_Price'] * (int)$products_in_cart[$product['Product_ID']];
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST") { 
$first_name=$last_name=$email=$address=$city=$country=$zip_code=$tel=$Order_Details="";
$arraylength =count($products_in_cart);




	foreach ($products as $product){
       
		//$Order_Details= $Order_Detail;

    $Order_Detail = $products_in_cart[$product['Product_ID']].$product['Product_Name'].'@'.$product['Product_Price']*$products_in_cart[$product['Product_ID']];

    $Order_Details= $Order_Details.$Order_Detail;


	}


 

echo $Order_Details;

     try{


    $stmt = $pdo->prepare("INSERT INTO orders (first_name,last_name,email,address,city,country,zip_code,tel,Order_Details,Total_Cost) VALUES (:first_name, :last_name,:email, :address,:city,:country,:zip_code,:tel,:Order_Details,:Total_Cost)");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt->bindParam(':first_name', $first_name);
    $stmt->bindParam(':last_name', $last_name);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':address', $address);
    $stmt->bindParam(':city', $city);
    $stmt->bindParam(':country', $country);
    $stmt->bindParam(':zip_code', $zip_code);
    $stmt->bindParam(':tel', $tel);
    $stmt->bindParam(':Order_Details', $Order_Details);
    $Total_Cost = $subtotal;
    $stmt->bindParam(':Total_Cost',$Total_Cost);
    
    

    $first_name = clean($_POST["first_name"]);
    $last_name = clean($_POST["last_name"]);
    $email = clean($_POST["email"]);
    $address = clean($_POST["address"]);
    $city = clean($_POST["city"]);
    $country = clean($_POST["country"]);
    $zip_code = clean($_POST["zip_code"]);
    $tel = clean($_POST["tel"]);
    $order_notes = clean($_POST["order_notes"]);
    $stmt->execute();

    header('Location: index.php?page=placeorder');
}
catch(PDOException $e)
  {
  echo "Error: " . $e->getMessage();
  }
}
function clean($userInput) {
  $userInput = trim($userInput);
  $userInput = stripslashes($userInput);
  $userInput = htmlspecialchars($userInput);
  return $userInput;
}
$conn = null;


?>

<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">

					<div class="col-md-7">
						<!-- Billing Details -->
						<div class="billing-details">
							<div class="section-title">
								<h3 class="title">Billing address</h3>
							</div>

				<form method="post" action="iframe.php">
					<?php include "order_id.php" ?>
                              <div class="form-group">
                              	<h4> Order ID : <?=$Final_Order_id?></h4>
                      <input hidden class="input" type="text" name="amount" value = <?=$subtotal?>>
		             <input hidden class="input" type="text" name="Order_id" value = <?=$Final_Order_id?>>
							</div>
							<div class="form-group">
								<input class="input" type="text" name="first_name" placeholder="First Name">
							</div>
							<div class="form-group">
								<input class="input" type="text" name="last_name" placeholder="Last Name">
							</div>
							<div class="form-group">
								<input class="input" type="email" name="email" placeholder="Email">
							</div>
							<div class="form-group">
								<input class="input" type="text" name="address" placeholder="Address">
							</div>
							<div class="form-group">
								<input class="input" type="text" name="city" placeholder="City">
							</div>
							<div class="form-group">
								<input class="input" type="text" name="country" placeholder="Country">
							</div>
							<div class="form-group">
								<input class="input" type="text" name="zip_code" placeholder="ZIP Code">
							</div>
							<div class="form-group">
								<input class="input" type="text" name="phonenumber" placeholder="phone number">
							</div>
							<div class="form-group">
								<div class="input-checkbox">
									<input type="checkbox" id="create-account">
									<label for="create-account">
										<span></span>
										Create Account?
									</label>
									<div class="caption">
										<p>By creating an account , you agree to our Terms and Conditions</p>
										<input class="input" type="password" name="password" placeholder="Enter Your Password">
									</div>
								</div>
							</div>
						</div>
					
						<!-- /Billing Details -->

						<!-- Shiping Details -->
						<div class="shiping-details">
							<div class="section-title">
								<h3 class="title">Shiping address</h3>
							</div>
							<div class="input-checkbox">
								<input type="checkbox" id="shiping-address" disabled>
								<label for="shiping-address">
									<span></span>
									Ship to a diffrent address?
								</label>
								<div class="caption">
									<div class="form-group">
										<input class="input" type="text" name="first-name" placeholder="First Name">
									</div>
									<div class="form-group">
										<input class="input" type="text" name="last-name" placeholder="Last Name">
									</div>
									<div class="form-group">
										<input class="input" type="email" name="shipping_email" placeholder="Email">
									</div>
									<div class="form-group">
										<input class="input" type="text" name="shipping_address" placeholder="Address">
									</div>
									<div class="form-group">
										<input class="input" type="text" name="shipping_city" placeholder="City">
									</div>
									<div class="form-group">
										<input class="input" type="text" name="shipping_country" placeholder="Country">
									</div>
									<div class="form-group">
										<input class="input" type="text" name="shipping_zip-code" placeholder="ZIP Code">
									</div>
									<div class="form-group">
										<input class="input" type="tel" name="shipping_tel" placeholder="Telephone">
									</div>
								</div>
							</div>
						</div>
						<!-- /Shiping Details -->

						<!-- Order notes -->
						<div class="order-notes">
							<textarea class="input" name="order_notes" placeholder="Order Notes"></textarea>
						</div>
						<!-- /Order notes -->
					</div>

					<!-- Order Details -->
					<div class="col-md-5 order-details">
						<div class="section-title text-center">
							<h3 class="title">Your Order</h3>
						</div>
						<div class="order-summary">
							<div class="order-col">
								<div><strong>PRODUCT</strong></div>
								<div><strong>TOTAL</strong></div>
							</div>
				<?php if (empty($products)): ?>
                <tr>
                    <td colspan="5" style="text-align:center;">You have no products added in your Shopping Cart</td>
                </tr>
                <?php else: ?>
                <?php foreach ($products as $product): ?>
							<div class="order-products">
								<div class="order-col">
				<div><?=$products_in_cart[$product['Product_ID']]?> <?=$product['Product_Name']?></div>
			<div>$<?=number_format($product['Product_Price']*$products_in_cart[$product['Product_ID']])?></div>
								</div>
		

				<?php endforeach; ?>
                <?php endif; ?>
								
							</div>
							<div class="order-col">
								<div>Shiping</div>
								<div><strong>FREE</strong></div>
							</div>
							<div class="order-col">
								<div><strong>TOTAL</strong></div>
								<div><strong class="order-total">$<?=number_format($subtotal)?></strong></div>
							</div>
						</div>
						<div class="payment-method">
							<div class="input-radio">
								<input type="radio" name="payment" id="payment-1">
								<label for="payment-1">
									<span></span>
									Visa or Master Card
								</label>
								<div class="caption">
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
								</div>
							</div>
							<div class="input-radio">
								<input type="radio" name="payment" id="payment-1">
								<label for="payment-2">
									<span></span>
									Mobile Money
								</label>
								<div class="caption">
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
								</div>
							</div>
							<div class="input-radio">
								<input type="radio" name="payment" id="payment-1">
								<label for="payment-3">
									<span></span>
									Direct Bank Transfer
								</label>
								<div class="caption">
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
								</div>
							</div>
							<div class="input-radio">
								<input type="radio" name="payment" id="payment-2">
								<label for="payment-4">
									<span></span>
									Cheque Payment
								</label>
								<div class="caption">
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
								</div>
							</div>
							<div class="input-radio">
								<input type="radio" name="payment" id="payment-3">
								<label for="payment-5">
									<span></span>
									Paypal System
								</label>
								<div class="caption">
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
								</div>
							</div>
						</div>
						<div class="input-checkbox">
							<input type="checkbox" id="terms">
							<label for="terms">
								<span></span>
								I've read and accept the <a href="#">terms & conditions</a>
							</label>
						</div>

						<input type="submit" name="submit" value="Submit">
						
					</div>
					<!-- /Order Details -->
					</form>

		<div class="modal fade" id="myModal">
		<div class="modal-dialog">
			<div class="modal-content">

				<div class="modal-body">
          
          <div class="close-button">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </div>
          <div class="embed-responsive embed-responsive-16by9">
					            <iframe class="embed-responsive-item" frameborder="0"></iframe>
          </div>
				</div>

			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>

		<!-- /SECTION -->
		