<?php

include 'dbconfig.php' ;
$limit = 6;  
if (isset($_GET["p"])) {
    $p  = (int) $_GET["p"]; 
    } 
    else{ 
    $p=1;
    };  
$Current_Pg = $_GET['Product_Category'];
$start_from = ($p-1) * $limit;
$previous_page = $p - 1;
$next_page = $p + 1;
$adjacents = "2";

$result = mysqli_query($conn,"SELECT * FROM items where Product_Category like ? ORDER BY product_id ASC LIMIT $start_from, $limit");
//Recently Added Products
$stmt = $pdo->prepare('SELECT * FROM items where Product_Category like ? ORDER BY product_id ASC LIMIT $start_from, $limit"');
$stmt->execute();
$recently_added_product = $stmt->fetchAll(PDO::FETCH_ASSOC);
//End Of Recently added Products//


// The amounts of products to show on each page
$num_products_on_each_page = 6;
// The current page, in the URL this will appear as index.php?page=products&p=1, index.php?page=products&p=2, etc...
$current_page = isset($_GET['p']) && is_numeric($_GET['p']) ? (int)$_GET['p'] : 1;

if (isset($_GET['Product_Category'])) {
// Select products ordered by the date added
$stmt = $pdo->prepare('SELECT * FROM items where Product_Category like ? ORDER BY date_added DESC LIMIT ?,?');
// bindValue will allow us to use integer in the SQL statement, we need to use for LIMIT
$stmt->bindValue(1, $Current_Pg, PDO::PARAM_STR);
$stmt->bindValue(2, ($current_page - 1) * $num_products_on_each_page, PDO::PARAM_INT);
$stmt->bindValue(3, $num_products_on_each_page, PDO::PARAM_INT);

$stmt->execute();
//$stmt->execute();
// Fetch the products from the database and return the result as an Array
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
// Get the total number of products
$total_products = $pdo->query('SELECT * FROM items ')->rowCount();
}
else
{
    echo "Sorry no products available for this category ";
}



include 'categoryn.php';

?>
<?=template_header($_GET['Product_Category'])?>
<!-- SECTION -->
        <div class="section">
            <!-- container -->
            <div class="container">
                <!-- row -->
                <div class="row">
                    <!-- ASIDE -->
                    <div id="aside" class="col-md-3">
                        <!-- aside Widget -->
                        <div class="aside">
                            <h3 class="aside-title">Categories</h3>
                            <div class="checkbox-filter">

                                 <?php include  'category_count.php'?> 
                            </div>
                        </div>
                        <!-- /aside Widget -->

                        <!-- aside Widget -->
                        <div class="aside">
                            <h3 class="aside-title">Price</h3>
                            <div class="price-filter">
                                <div id="price-slider"></div>
                                <div class="input-number price-min">
                                    <input id="price-min" type="number">
                                    <span class="qty-up">+</span>
                                    <span class="qty-down">-</span>
                                </div>
                                <span>-</span>
                                <div class="input-number price-max">
                                    <input id="price-max" type="number">
                                    <span class="qty-up">+</span>
                                    <span class="qty-down">-</span>
                                </div>
                            </div>
                        </div>
                        <!-- /aside Widget -->

                        <!-- aside Widget -->
                        <div class="aside">
                            <h3 class="aside-title">Brand</h3>
                            <div class="checkbox-filter">
                                <?php include 'brand.php'?> 
                            </div>
                        </div>
                        <!-- /aside Widget -->

                        <!-- aside Widget -->
                        <div class="aside">
                            <h3 class="aside-title">Top selling</h3>
                           
                                
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
                        <!-- /aside Widget -->
                    </div>
                    <!-- /ASIDE -->

                    <!-- STORE -->
                    <div id="store" class="col-md-9">
                        <!-- store top filter -->
                        <div class="store-filter clearfix">
                            <div class="store-sort">
                                <label>
                                    Sort By:
                                    <select class="input-select">
                                        <option value="0">Popular</option>
                                        <option value="1">Position</option>
                                    </select>
                                </label>

                                <label>
                                    Show:
                                    <select class="input-select">
                                        <option value="0">20</option>
                                        <option value="1">50</option>
                                    </select>
                                </label>
                            </div>
                            <ul class="store-grid">
                                <li class="active"><i class="fa fa-th"></i></li>
                                <li><a href="#"><i class="fa fa-th-list"></i></a></li>
                            </ul>
                        </div>
                        <!-- /store top filter -->

                        <!-- store products -->
                        <div class="row">

<div class="products content-wrapper">
    <h1><?=$_GET['Product_Category']?></h1>
    <p><?=$number_of_rows?> Products</p>
    <div class="products-wrapper">
        <?php foreach ($products as $product): ?>
            <?php include 'storeitems.php';?>
     
            </span>
        </a>
        <?php endforeach; ?>
    </div>
 
</div>


</div>

   
                           
                        </div>
                        <!-- /store products -->

                        <!-- store bottom filter -->
                        <div class="store-filter clearfix">
                            <span class="store-qty">Showing 20-100 products</span>
                            <?php  
INCLUDE 'Categoryn.php';


//$result_db = mysqli_query($conn,"SELECT COUNT(product_id) FROM items Where product_category like $Current_Pg"); 

//$row_db = mysqli_stmt_fetch($result_db);  
$total_records = $number_of_rows;  
$total_pages = ceil($total_records / $limit);


?>
<div class="store-filter clearfix">
<ul class="store-pagination">
<?php if($p > 1){
echo "<li><a href='index.php?page=category&Product_Category=$Current_Pg&p=1'>First</a></li>";
} ?>
    
<li <?php if($p <= 1){ echo "class='disabled'"; } ?>>
<a <?php if($p > 1){
echo "href='index.php?page=category&Product_Category=$Current_Pg&p=$previous_page'";
} ?>><i class="fa fa-angle-left"></i></a>
</li>
    
  <?php  if ($total_pages <= 10){   
 for ($counter = 1; $counter <= $total_pages; $counter++){
 if ($counter == $p) {
 echo "<li class='active'><a>$counter</a></li>"; 
         }else{
        echo "<li><a href='index.php?page=category&Product_Category=$Current_Pg&p=$counter'>$counter</a></li>";
                }
        }
    }
   
?>

<li <?php if($p >= $total_pages){
echo "class='disabled'";
} ?>>
<a <?php if($p < $total_pages) {
echo "href='index.php?page=category&Product_Category=$Current_Pg&p=$next_page'";
} ?>><i class="fa fa-angle-right"></i></a>
</li>
 
<?php if($p < $total_pages){
echo "<li><a href='index.php?page=category&Product_Category=$Current_Pg&p=$total_pages'>Last</a></li>";
} 

?>

</ul>
                        </div>
                        <!-- /store bottom filter -->
                    </div>
                    <!-- /STORE -->
                </div>
                <!-- /row -->
            </div>
            <!-- /container -->
        </div>
        <!-- /SECTION -->

<?=template_footer()?>