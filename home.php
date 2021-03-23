
<?php
// Get the 4 most recently added products
$stmt = $pdo->prepare('SELECT * FROM items limit 5');
$stmt->execute();
$recently_added_products = $stmt->fetchAll(PDO::FETCH_ASSOC);

$stmt = $pdo->prepare('SELECT * FROM items  order by Product_id desc limit 3');
$stmt->execute();
$recently_added_product = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<?=template_header('Fremu Online Store')?>
<!-- HOT DEAL SECTION -->
        <!-- SECTION -->
        <div class="section">
            <!-- container -->
            <div class="container">
                <!-- row -->
                <div class="row">
                    <!-- shop -->
                    <div class="col-md-4 col-xs-6">
                        <div class="shop">
                            <div class="shop-img">
                                <img src="./img/shop29.png" alt="" width="400px" height="240px">
                            </div>
                            <div class="shop-body">
                                <h3>Fashion<br>Collection</h3>
                                <a href="index.php?page=category&Product_Category=Fashion" class="cta-btn">Shop now <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <!-- /shop -->

                    <!-- shop -->
                    <div class="col-md-4 col-xs-6">
                        <div class="shop">
                            <div class="shop-img">
                                <img src="./img/shop21.png" alt="" width="400px" height="240px">
                            </div>
                            <div class="shop-body">
                                <h3>Smart Phones<br>Collection</h3>
                                <a href="index.php?page=category&Product_Category=Mobile Devices" class="cta-btn">Shop now <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <!-- /shop -->

                    <!-- shop -->
                    <div class="col-md-4 col-xs-6">
                        <div class="shop">
                            <div class="shop-img">
                                <img src="./img/shop23.png" alt="" width="400px" height="240px">
                            </div>
                            <div class="shop-body">
                                <h3>Gaming <br>Collection</h3>
                                <a href="index.php?page=category&Product_Category=Gaming" class="cta-btn">Shop now <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <!-- /shop -->
                
                <!-- /row -->
            </div>
            <!-- /container -->
        </div>
        <!-- /SECTION -->
        <div class="section">
            <!-- container -->
            <div class="container">
                <!-- row -->
                <div class="row">
        <!-- section title -->
                    <div class="col-md-12">
                        <div class="section-title">
                            <h3 class="title">New Products</h3>
                            <div class="section-nav">
                                <ul class="section-tab-nav tab-nav">
                                    <li class="active"><a data-toggle="tab" href="#tab1">Laptops</a></li>
                                    <li><a data-toggle="tab" href="#tab1">Smartphones</a></li>
                                    <li><a data-toggle="tab" href="#tab1">Cameras</a></li>
                                    <li><a data-toggle="tab" href="#tab1">Accessories</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
 <div class="col-md-12">
        <div class="section-title">   

                    <!-- shop -->
                    
                        
                            <div class="products-tabs">
                                <!-- tab -->
                                <div id="tab1" class="tab-pane active">
                                    <div class="products-slick" data-nav="#slick-nav-1">

<?php foreach ($recently_added_products as $product): ?> 
     <div class="product">
                                            <div class="product-img">
            <a href="index.php?page=product&id=<?=$product['Product_ID']?>" class="product">
             <img src="img/<?=$product['Main_Image']?>" width ='150' height ='150'  alt="<?=$product['Product_Name']?>">
                  
                                                </a>                                                
                                                <div class="product-label">
                                                    <span class="sale">-<?=$product['Product_Discount']?>%</span>
                                                    <span class="new">NEW</span>
                                                </div>
                                            </div>
                                            <div class="product-body">
                                                <p class="product-category"><?=$product['Product_Category']?></p>
                                        <h3 class="product-name"><a href="#"><?=$product['Product_Name']?></a></h3>
                                        <?php include 'prices.php';?>
<h4 class="product-price">$<?= $new_price?> <del class="product-old-price">$<?=$product['Product_Price']?></del></h4>
                                                <div class="product-rating">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                </div>
                                                
       
                                                <div class="product-btns">
                                                    <button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">add to wishlist</span></button>
                                                    <button class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">add to compare</span></button>
                                                    <button class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">quick view</span></button>
                                                </div>
                                            </div>
                                                 <form action="" method="post">
                                
                        <input type="hidden" name="quantity" value="1" >
                                            <div class="add-to-cart">
                                                <input type="hidden" name="product_id" value="<?=$product['Product_ID']?>">
                <button class="add-to-cart-btn" value="Add To Cart" type="submit" ><i class="fa fa-shopping-cart"></i> add to cart</button>
                 </form>
                                            </div>
                                        </div>
                                        <?php endforeach; ?>
                                        <!-- /product -->     

                                    <div id="slick-nav-1" class="products-slick-nav"></div>
                                </div>
                                <!-- /tab -->
                            </div>
                        </div>
                    </div>
                    <!-- Products tab & slick -->
                </div>
                <!-- /row -->
            </div>
            <!-- /container -->
        </div>
        <!-- HOT DEAL SECTION -->
        <div id="hot-deal" class="section">
            <!-- container -->
            <div class="container">
                <!-- row -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="hot-deal">
                            <ul class="hot-deal-countdown">
                                
<script>
// Set the date we're counting down to
var countDownDate = new Date("Mar 13, 2021 00:00:00").getTime();

// Update the count down every 1 second
var x = setInterval(function() {

  // Get today's date and time
  var now = new Date().getTime();

  // Find the distance between now and the count down date
  var distance = countDownDate - now;

  // Time calculations for days, hours, minutes and seconds
  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);

  // Display the result in the element with id="demo"
  document.getElementById("days").innerHTML = days;

   document.getElementById("hours").innerHTML = hours ;
  document.getElementById("Mins").innerHTML =  minutes;
  document.getElementById("Secs").innerHTML = seconds;

  // If the count down is finished, write some text
  if (distance < 0) {
    clearInterval(x);
    document.getElementById("days").innerHTML = "0";
    document.getElementById("hours").innerHTML = "0";
    document.getElementById("Mins").innerHTML = "0";
    document.getElementById("Secs").innerHTML = "0";
    document.getElementById("deal").innerHTML = "<p>Just Missed a Great Deal..</p>";
  }
}, 1000);
</script>

                                <li>
                                    <div>
                                        
                                        <h3 id='days'></h3>
                                        <span>Days</span>
                                    </div>
                                </li>
                                <li>
                                    <div>
                                        <h3 id ="hours"></h3>
                                        <span>Hours</span>
                                    </div>
                                </li>
                                <li>
                                    <div>
                                        <h3 id ="Mins"></h3>
                                        <span>Mins</span>
                                    </div>
                                </li>
                                <li>
                                    <div>
                                        <h3 id ="Secs"></h3>
                                        <span>Secs</span>
                                    </div>
                                </li>
                            </ul>
                            <h2 class="text-uppercase">hot deal this week</h2>
                            <p id ="deal" >New Collection Up to 50% OFF</p>
                            <a class="primary-btn cta-btn" href="index.php?page=products">Shop now</a>
                        </div>
                    </div>
                </div>
                <!-- /row -->
            </div>
            <!-- /container -->
        </div>
        <!-- /HOT DEAL SECTION -->
        <!-- SECTION -->
        <div class="section">
            <!-- container -->
            <div class="container">
                <!-- row -->
                <div class="row">

                    <!-- section title -->
                    <div class="col-md-12">
                        <div class="section-title">
                            <h3 class="title">Top selling</h3>
                            <div class="section-nav">
                                <ul class="section-tab-nav tab-nav">
                                    <li class="active"><a data-toggle="tab" href="#tab2">Laptops</a></li>
                                    <li><a data-toggle="tab" href="#tab2">Smartphones</a></li>
                                    <li><a data-toggle="tab" href="#tab2">Cameras</a></li>
                                    <li><a data-toggle="tab" href="#tab2">Accessories</a></li>
                                    <li><a data-toggle="tab" href="#tab2">Gaming</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- /section title -->

                    <!-- Products tab & slick -->
                    <div class="col-md-12">
                        <div class="row">
                            <div class="products-tabs">
                                <!-- tab -->
                                <div id="tab2" class="tab-pane fade in active">
                                    <div class="products-slick" data-nav="#slick-nav-2">
                     <?php foreach ($recently_added_products as $product): ?> 
     <div class="product">
                                            <div class="product-img">
            <a href="index.php?page=product&id=<?=$product['Product_ID']?>" class="product">
             <img src="img/<?=$product['Main_Image']?>" width ='150' height ='150'  alt="<?=$product['Product_Name']?>">
                  
                                                </a>                                                
                                                <div class="product-label">
                                                    <span class="sale">-<?=$product['Product_Discount']?>%</span>
                                                    <span class="new">NEW</span>
                                                </div>
                                            </div>
                                            <div class="product-body">
                                                <p class="product-category"><?=$product['Product_Category']?></p>
                                        <h3 class="product-name"><a href="#"><?=$product['Product_Name']?></a></h3>
                                        <?php include 'prices.php';?>
<h4 class="product-price">$<?= $new_price?> <del class="product-old-price">$<?=$product['Product_Price']?></del></h4>
                                                <div class="product-rating">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                </div>
                                                
       
                                                <div class="product-btns">
                                                    <button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">add to wishlist</span></button>
                                                    <button class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">add to compare</span></button>
                                                    <button class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">quick view</span></button>
                                                </div>
                                            </div>
                                                 <form action="" method="post">
                                
                        <input type="hidden" name="quantity" value="1" >
                                            <div class="add-to-cart">
                                                <input type="hidden" name="product_id" value="<?=$product['Product_ID']?>">
                <button class="add-to-cart-btn" value="Add To Cart" type="submit" ><i class="fa fa-shopping-cart"></i> add to cart</button>
                 </form>
                                            </div>
                                        </div>
                                        <?php endforeach; ?>
                                        <!-- /product -->                                  

                                    </div>
                                    <div id="slick-nav-2" class="products-slick-nav"></div>
                                </div>
                                <!-- /tab -->
                            </div>
                        </div>
                    </div>
                    <!-- /Products tab & slick -->
                </div>
                <!-- /row -->
            </div>
            <!-- /container -->
        </div>
        <!-- /SECTION -->
        <!-- SECTION -->
        <div class="section">
            <!-- container -->
            <div class="container">
                <!-- row -->
                <div class="row">
                    <div class="col-md-4 col-xs-6">
                        <div class="section-title">
                            <h4 class="title">Top selling</h4>
                            <div class="section-nav">
                                <div id="slick-nav-3" class="products-slick-nav"></div>
                            </div>
                        </div>

                        <div class="products-widget-slick" data-nav="#slick-nav-3">
                            <div>
                                <?php foreach ($recently_added_product as $product): ?> 
                                    <?php include 'prices.php';?>

                                <!-- product widget -->
                                <div class="product-widget">
                                    <div class="product-img">

                                        <img src="./img/<?=$product['Main_Image']?>" alt="">
                                    </div>
                                    <div class="product-body">
                                        <p class="product-category"><?=$product['Product_Category']?></p>
                                        <h3 class="product-name"><a href="index.php?page=product&id=<?=$product['Product_ID']?>"><?=$product['Product_Name']?></a></h3>
                                        <h4 class="product-price">$<?= $new_price?>  <del class="product-old-price">$<?=$product['Product_Price']?></del></h4>
                                    </div>
                                </div>
                                <!-- /product widget -->
                                <?php endforeach; ?>

                             

                             
                            </div>

                            <div>
                                <!-- product widget -->
                               <?php foreach ($recently_added_product as $product): ?> 
                                <?php include 'prices.php';?>

                                <!-- product widget -->
                                <div class="product-widget">
                                    <div class="product-img">

                                        <img src="./img/<?=$product['Main_Image']?>" alt="">
                                    </div>
                                    <div class="product-body">
                                        <p class="product-category"><?=$product['Product_Category']?></p>
                                        <h3 class="product-name"><a href="index.php?page=product&id=<?=$product['Product_ID']?>"><?=$product['Product_Name']?></a></h3>
                                        <h4 class="product-price">$<?= $new_price?>  <del class="product-old-price">$<?=$product['Product_Price']?></del></h4>
                                    </div>
                                </div>
                                <!-- /product widget -->
                                <?php endforeach; ?>
                                <!-- /product widget -->

                                

                                
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 col-xs-6">
                        <div class="section-title">
                            <h4 class="title">Top selling</h4>
                            <div class="section-nav">
                                <div id="slick-nav-4" class="products-slick-nav"></div>
                            </div>
                        </div>

                        <div class="products-widget-slick" data-nav="#slick-nav-4">
                            <div>
                                <!-- product widget -->
                                <?php foreach ($recently_added_product as $product): ?> 
                                    <?php include 'prices.php';?>

                                <!-- product widget -->
                                <div class="product-widget">
                                    <div class="product-img">

                                        <img src="./img/<?=$product['Main_Image']?>" alt="">
                                    </div>
                                    <div class="product-body">
                                        <p class="product-category"><?=$product['Product_Category']?></p>
                                        <h3 class="product-name"><a href="index.php?page=product&id=<?=$product['Product_ID']?>"><?=$product['Product_Name']?></a></h3>
                                        <h4 class="product-price">$<?= $new_price?>  <del class="product-old-price">$<?=$product['Product_Price']?></del></h4>
                                    </div>
                                </div>
                                <!-- /product widget -->
                                <?php endforeach; ?>
                                <!-- /product widget -->

                                <!-- product widget -->
                                
                                <!-- product widget -->
                            </div>

                            <div>
                                <!-- product widget -->
                                <?php foreach ($recently_added_product as $product): ?> 
                                    <?php include 'prices.php';?>

                                <!-- product widget -->
                                <div class="product-widget">
                                    <div class="product-img">

                                        <img src="./img/<?=$product['Main_Image']?>" alt="">
                                    </div>
                                    <div class="product-body">
                                        <p class="product-category"><?=$product['Product_Category']?></p>
                                        <h3 class="product-name"><a href="index.php?page=product&id=<?=$product['Product_ID']?>"><?=$product['Product_Name']?></a></h3>
                                        <h4 class="product-price">$<?= $new_price?>  <del class="product-old-price">$<?=$product['Product_Price']?></del></h4>
                                    </div>
                                </div>
                                <!-- /product widget -->
                                <?php endforeach; ?>
                                <!-- /product widget -->

                                
                            </div>
                        </div>
                    </div>

                    <div class="clearfix visible-sm visible-xs"></div>

                    <div class="col-md-4 col-xs-6">
                        <div class="section-title">
                            <h4 class="title">Top selling</h4>
                            <div class="section-nav">
                                <div id="slick-nav-5" class="products-slick-nav"></div>
                            </div>
                        </div>

                        <div class="products-widget-slick" data-nav="#slick-nav-5">
                            <div>
                                <!-- product widget -->

                                <?php foreach ($recently_added_product as $product): ?> 
                                    <?php include 'prices.php';?>

                                <!-- product widget -->
                                <div class="product-widget">
                                    <div class="product-img">
                                        <?php include 'prices.php';?>

                                        <img src="./img/<?=$product['Main_Image']?>" alt="">
                                    </div>
                                    <div class="product-body">
                                        <p class="product-category"><?=$product['Product_Category']?></p>
                                        <h3 class="product-name"><a href="index.php?page=product&id=<?=$product['Product_ID']?>"><?=$product['Product_Name']?></a></h3>
                                        <h4 class="product-price">$<?= $new_price?> <del class="product-old-price">$<?=$product['Product_Price']?></del></h4>
                                    </div>
                                </div>
                                <!-- /product widget -->
                                <?php endforeach; ?>
                               
                            </div>

                            <div>
                                <!-- product widget -->
                           <?php foreach ($recently_added_product as $product): ?> 
                            <?php include 'prices.php';?>

                                <!-- product widget -->
                                <div class="product-widget">
                                    <div class="product-img">

                                        <img src="./img/<?=$product['Main_Image']?>" alt="">
                                    </div>
                                    <div class="product-body">
                                        <p class="product-category"><?=$product['Product_Category']?></p>
                                        <h3 class="product-name"><a href="index.php?page=product&id=<?=$product['Product_ID']?>"><?=$product['Product_Name']?></a></h3>
                                        <h4 class="product-price">$<?= $new_price?>  <del class="product-old-price">$<?=$product['Product_Price']?></del></h4>
                                    </div>
                                </div>
                                <!-- /product widget -->
                                <?php endforeach; ?>
                                <!-- /product widget -->

                                <!-- product widget -->
                              
                                <!-- /product widget -->

                                <!-- product widget -->
                               
                                <!-- product widget -->
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /row -->
            </div>
            <!-- /container -->
        </div>
        <!-- /SECTION -->


 


<?=template_footer()?>