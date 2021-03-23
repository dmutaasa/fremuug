
<?php
function pdo_connect_mysql() {
    // Update the details below with your MySQL details
    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'admin';
    $DATABASE_PASS = 'lubega1992';
    $DATABASE_NAME = 'fremuug';
    try {
        return new PDO('mysql:host=' . $DATABASE_HOST . ';dbname=' . $DATABASE_NAME . ';charset=utf8', $DATABASE_USER, $DATABASE_PASS);
       // 
    } catch (PDOException $exception) {
        // If there is an error with the connection, stop the script and display the error.
        exit('Failed to connect to database!');
    }

   
}

// Template header, feel free to customize this
function template_header($title) {

$pdo = pdo_connect_mysql();
    // Get the amount of items in the shopping cart, this will be displayed in the header.
$num_items_in_cart = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
$products_in_cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
$products = array();
$subtotal = 0.00;
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


    $sql = 'select * from items order by Product_ID  desc limit 3';
    $result = $pdo->query($sql);
}





 include 'cart_header.php';
    //print_r($_SESSION['cart']);
 

?>

<!DOCTYPE html>
<html>


    <head>
        
        <link rel="icon" 
      type="image/ico" 
      href="favicon.ico" />
        <meta charset="utf-8">
        <title><?=$title?></title>
            <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">

        <!-- Bootstrap -->
        <link type="text/css" rel="stylesheet" href="css/bootstrap.min.css"/>

        <!-- Slick -->
        <link type="text/css" rel="stylesheet" href="css/slick.css"/>
        <link type="text/css" rel="stylesheet" href="css/slick-theme.css"/>

        <!-- nouislider -->
        <link type="text/css" rel="stylesheet" href="css/nouislider.min.css"/>

        <!-- Font Awesome Icon -->
        <link rel="stylesheet" href="css/font-awesome.min.css">

        <!-- Custom stlylesheet -->
        <link type="text/css" rel="stylesheet" href="css/style.css"/>

         
          <link href="css/style-responsive.css" rel="stylesheet">
          <link href="lib/font-awesome/css/font-awesome.css" rel="stylesheet" />
          <link rel="stylesheet" type="text/css" href="js/bootstrap-fileupload.css" />
       
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">

        <!-- Bootstrap -->
        <link type="text/css" rel="stylesheet" href="css/bootstrap.min.css"/>

        <!-- Slick -->
        <link type="text/css" rel="stylesheet" href="css/slick.css"/>
        <link type="text/css" rel="stylesheet" href="css/slick-theme.css"/>

        <!-- nouislider -->
        <link type="text/css" rel="stylesheet" href="css/nouislider.min.css"/>

        <!-- Font Awesome Icon -->
        <link rel="stylesheet" href="css/font-awesome.min.css">

        <!-- Custom stlylesheet -->
        <link type="text/css" rel="stylesheet" href="css/style.css"/>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
       

        <style type="text/css">
  
    /* Formatting search box */
    .search-box{
        max-width: 100%;
        
    }
    .search-box input[type="text"]{
       max-width: 100%;
    }
    .result{
        position: absolute;        
        z-index: 999;
        top: 100%;
        left: 0;
    }
    .search-box input[type="text"], .result{
        max-width: 100%;
        
    }
    /* Formatting result items */
    .result p{
        margin: 0px;
        margin-left: 29%;
        padding: 7px 10px;
        max-width: 53%;
       
        border-top: none;
        cursor: pointer;
        background-color: #fff
    }
    .result p:hover{
        background: #f2f2f2;
    }
    td, th {
    padding: 10px;
}
   .cart_button{

    float:right;
    padding-right:80px;
    padding-top: 20px
   }
   @media (max-width:600px) {
   .header-logo {
    order:0;
    float: none;
    text-align: center;}
}
</style>

        <script type="text/javascript">
        $(document).ready(function(){
        $('.header-search input[type="text"]').on("keyup input", function(){
        /* Get input value on change */
        var inputVal = $(this).val();
        var resultDropdown = $(this).siblings(".result");
        if(inputVal.length){
            $.get("livesearch.php", {term: inputVal}).done(function(data){
                // Display the returned data in browser
                resultDropdown.html(data);
            });
        } else{
            resultDropdown.empty();
        }
    });
    
    // Set search input value on click of result item
    $(document).on("click", ".result p", function(){
        $(this).parents(".search-box").find('input[type="text"]').val($(this).text());
        $(this).parent(".result").empty();
    });
});
</script>        
        



    </head>
    <body>


    <!-- HEADER -->
        <header>
            <!-- TOP HEADER -->
            <div id="top-header">
                <div class="container">
                    <ul class="header-links pull-left">
            <li><a href="#"><i class="fa fa-phone"></i>+256-772-302-322</a></li>
                        <li><a href="#"><i class="fa fa-envelope-o"></i> customercare@fremu.com</a></li>
                        <li><a href="#"><i class="fa fa-map-marker"></i> Entebbe Road </a></li>
                    </ul>
                    <ul class="header-links pull-right">
                        <li><a href="#"><i class="fa fa-dollar"></i> USD</a></li>
                        <li>
                            <ul><a href="user_Details.php"><i class="fa fa-user-o"></i> My Account</a></ul>
                            
                        </li>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- /TOP HEADER -->

            <!-- MAIN HEADER -->
            <div id="header">
                <!-- container -->
                <div class="container">
                    <!-- row -->
                    <div class="row">
                        <!-- LOGO -->
                        <div class="col-md-3">
                            <div class="header-logo">
                                <a href="#" class="logo">
                                    <img src="./img/logo.png" alt="">
                                </a>
                            </div>
                        </div>
                        <!-- /LOGO -->

                        <!-- SEARCH BAR -->
                        <div class="col-md-6">
                            <div class="header-search">                               
                                 
                                <form>

                                    <select class="input-select">
                                        <option value="All">All Categories</option>
                                        <option value="Electronics">Electronics</option>
                                        <option value="Fashion">Fashion</option>
                                        <option value="Mobile Devices">Mobile Devices</option>
                                        <option value="Gaming">Gaming </option>
                                    </select>
                                   
                    <input type="text" class="input" autocomplete="off"  placeholder="Search here">
                    <div class="result" ></div>

                        <button class="search-btn">Search</button>                                     
      
                      
                        

                                    
                                </form>
                               
                                   
                            </div>
                        </div>
                        <!-- /SEARCH BAR -->

                        <!-- ACCOUNT -->
                        <div class="col-md-3 clearfix">
                            <div class="header-ctn">
                                <!-- Wishlist -->
                                <div>
                                    <a href="#">
                                        <i class="fa fa-heart-o"></i>
                                        <span>Your Wishlist</span>
                                        <div class="qty">2</div>
                                    </a>
                                </div>
                                <!-- /Wishlist -->

                  <!-- Cart -->

                     <div class='dropdown'>
                    <a class='dropdown-toggle' data-toggle='dropdown' aria-expanded='true'>
                                      <i class="fa fa-shopping-cart"></i>

                                        <span>Your Cart</span>
                                        <div class="qty"><?=$num_items_in_cart?></div>
                                    </a>
                                    <div class="cart-dropdown">
                                        <div class="cart-list">
                                            <?php foreach ($products as $product): ?>
                                            <div class="product-widget">
                                                <div class="product-img">
                                                    <img src="./img/<?=$product['Main_Image']?>" alt="">
                                                </div>
                                                <div class="product-body">
                <h3 class="product-name"><a href="index.php?page=product&id=<?=$product['Product_ID']?>"><?=$product['Product_Name']?></a></h3>
                 <h4 class="product-price"><span class="qty"><?=$products_in_cart[$product['Product_ID']]?>x</span><?=$product['Product_Price']?></h4>
                                                </div>
                        <a href="index.php?page=cart&remove=<?=$product['Product_ID']?>" class="remove">
                                <button class="delete"><i class="fa fa-close"></i></button>
                            </a>
                                            </div>
                                            <?php endforeach; ?>

                                            
                                        </div>
                                        <div class="cart-summary">
                                            <small><?=$num_items_in_cart?> Item(s) selected</small>
                                            <h5>SUBTOTAL: <?=$subtotal?></h5>
                                        </div>
                                        <div class="cart-btns">
                                            <a href="index.php?page=cart">View Cart</a>
                             <a href="index.php?page=cart"><i class="fas fa-shopping-cart"></i>
                                    <span><?=$num_items_in_cart?></span>
                                     </a>
                                            <a href="index.php?page=checkout">Checkout  <i class="fa fa-arrow-circle-right"></i></a>
                                        </div>
                                    </div>
                                </div>

                
                                <!-- /Cart -->

                                <!-- Menu Toogle -->
                                <div class="menu-toggle">
                                    <a href="#">
                                        <i class="fa fa-bars"></i>
                                        <span>Menu</span>
                                    </a>
                                </div>
                                <!-- /Menu Toogle -->
                            </div>
                        </div>
                        <!-- /ACCOUNT -->
                    </div>
                    <!-- row -->
                </div>
                <!-- container -->
            </div>
            <!-- /MAIN HEADER -->
        </header>
        <!-- /HEADER -->

        <!-- NAVIGATION -->
        <nav id="navigation">
            <!-- container -->
            <div class="container">
                <!-- responsive-nav -->
                <div id="responsive-nav">

                    <?php
    function page_title($url) {
        $fp = file_get_contents($url);
        if (!$fp) 
            return null;

        $res = preg_match("/<title>(.*)<\/title>/siU", $fp, $title_matches);
        if (!$res) 
            return null; 

        // Clean up title: remove EOL's and excessive whitespace.
        $title = preg_replace('/\s+/', ' ', $title_matches[1]);
        $title = trim($title);
        return $title;
    }


?>
                    <!-- NAV -->
                    <ul class="main-nav nav navbar-nav">
                <li <?php if($title =='Fremu Online Store'){echo 'class ="active"';}?>><a href="index.php">Home</a></li>
            <li <?php if($title =='Hot Deals'){echo 'class ="active"';}?>><a href="index.php?page=products">Hot Deals</a></li>
            <li <?php if($title =='Electronics'){echo 'class ="active"';}?>><a href="index.php?page=category&Product_Category=Electronics">Electronics</a></li>
            <li <?php if($title =='Fashion'){echo 'class ="active"';}?>><a href="index.php?page=category&Product_Category=Fashion">Fashion</a></li>
            <li <?php if($title =='Mobile Devices'){echo 'class ="active"';}?>><a href="index.php?page=category&Product_Category=Mobile Devices">Mobile Devices</a></li>
                        <li <?php if($title =='Cameras'){echo 'class ="active"';}?>><a href="index.php?page=category&Product_Category=Cameras">Cameras</a></li>
                        <li <?php if($title =='Accessories'){echo 'class ="active"';}?>><a href="index.php?page=category&Product_Category=Accessories">Accessories</a></li>
                        <li <?php if($title =='Gaming'){echo 'class ="active"';}?>><a href="index.php?page=category&Product_Category=Gaming">Gaming</a></li>
                        <li <?php if($title =='Computing'){echo 'class ="active"';}?>><a href="index.php?page=category&Product_Category=Computing">Computing</a></li>
                    </ul>
                    <!-- /NAV -->
                </div>
                <!-- /responsive-nav -->
            </div>
            <!-- /container -->
        </nav>
        <!-- /NAVIGATION -->
        
        <main>
            <?php

}

// Template footer
function template_footer() {
$year = date('Y');
?>
        </main>
        <footer>


        <!-- NEWSLETTER -->
        <div id="newsletter" class="section">
            <!-- container -->
            <div class="container">
                <!-- row -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="newsletter">
                            <p>Sign Up for the <strong>NEWSLETTER</strong></p>
                            <form>
                                <input class="input" type="email" placeholder="Enter Your Email">
                                <button class="newsletter-btn"><i class="fa fa-envelope"></i> Subscribe</button>
                            </form>
                            <ul class="newsletter-follow">
                                <li>
                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-instagram"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-pinterest"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /row -->
            </div>
            <!-- /container -->
        </div>
        <!-- /NEWSLETTER -->

        <!-- FOOTER -->
        <footer id="footer">
            <!-- top footer -->
            <div class="section">
                <!-- container -->
                <div class="container">
                    <!-- row -->
                    <div class="row">
                        <div class="col-md-3 col-xs-6">
                            <div class="footer">
                                <h3 class="footer-title">About Us</h3>
                                <p>Fremu Collections  is a reliable online store that offers limitless shopping 247 to customers globally</p>
                                <ul class="footer-links">
                                    <li><a href="#"><i class="fa fa-map-marker"></i>Entebbe Road</a></li>
                                    <li><a href="#"><i class="fa fa-phone"></i>+256-772-302-322</a></li>
                                    <li><a href="#"><i class="fa fa-envelope-o"></i>customercare@fremu.com</a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-md-3 col-xs-6">
                            <div class="footer">
                                <h3 class="footer-title">Categories</h3>
                                <ul class="footer-links">
                                    <li><a href="index.php?page=products">Hot deals</a></li>
                        <li><a href="index.php?page=category&Product_Category=ELECTRONICS">Laptops</a></li>
                        <li><a href="index.php?page=category&Product_Category=FASHION">Fashions</a></li>
                        <li><a href="index.php?page=category&Product_Category=Accessories">Cameras</a></li>
                        <li><a href="index.php?page=category&Product_Category=Accessories">Accessories</a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="clearfix visible-xs"></div>

                        <div class="col-md-3 col-xs-6">
                            <div class="footer">
                                <h3 class="footer-title">Information</h3>
                                <ul class="footer-links">
                                    <li><a href="#">About Us</a></li>
                                    <li><a href="#">Contact Us</a></li>
                                    <li><a href="#">Privacy Policy</a></li>
                                    <li><a href="#">Orders and Returns</a></li>
                                    <li><a href="index.php?page=conditions">Terms & Conditions</a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-md-3 col-xs-6">
                            <div class="footer">
                                <h3 class="footer-title">Service</h3>
                                <ul class="footer-links">
                                    <li><a href="#">My Account</a></li>
                                    <li><a href="index.php?page=cart">View Cart</a></li>
                                    <li><a href="#">Wishlist</a></li>
                                    <li><a href="index.php?page=adminlogin">Admin</a></li>
                                    <li><a href="#">Help</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- /row -->
                </div>
                <!-- /container -->
            </div>
            <!-- /top footer -->

            <!-- bottom footer -->
            <div id="bottom-footer" class="section">
                <div class="container">
                    <!-- row -->
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <ul class="footer-payments">
                                <li><a href="#"><i class="fa fa-cc-visa"></i></a></li>
                                <li><a href="#"><i class="fa fa-credit-card"></i></a></li>
                                <li><a href="#"><i class="fa fa-cc-paypal"></i></a></li>
                                <li><a href="#"><i class="fa fa-cc-mastercard"></i></a></li>
                                <li><a href="#"><i class="fa fa-cc-discover"></i></a></li>
                                <li><a href="#"><i class="fa fa-cc-amex"></i></a></li>
                            </ul>
                            <span class="copyright">
                                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                                Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This site is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Batraim Desgins</a>
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                            </span>
                        </div>
                    </div>
                        <!-- /row -->
                </div>
                <!-- /container -->
            </div>
            <!-- /bottom footer -->
        </footer>
        <!-- /FOOTER -->

        
            <div class="content-wrapper">
                <p><?&copy; $year, Fremu Ug?></p>
            </div>
        </footer>
       
        <!-- jQuery Plugins -->
     
        <script src="js/bootstrap.min.js"></script>
        
        <script src="js/nouislider.min.js"></script>
        <script src="js/jquery.zoom.min.js"></script>
        
        <script src="js/bootstrap.min.js"></script>
        <script src="js/slick.min.js"></script>
        <script src="js/nouislider.min.js"></script>
        <script src="js/jquery.zoom.min.js"></script>
        <script src="js/main.js"></script>
        <script type="text/javascript" src="js/bootstrap-fileupload.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </body>
</html>
<?php
}
?>