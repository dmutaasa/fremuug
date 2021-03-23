

<div class='col-md-4 col-xs-6'>
           <div class='product'>
                 <div class='product-img'>
                  <a href="index.php?page=product&id=<?=$product['Product_ID']?>" class="product">
    <img src="img/<?=$product['Main_Image']?>" width="200" height="200" alt="<?=$product['Product_Name']?>">

                  </a>
                  
              <div class='product-label'>

                 <span class='sale'><?=$product['Product_Discount']?>%</span>
                  <span class='new'>NEW</span>
                 </div>
               </div>
          <div class='product-body'>
                 <p class='product-category'><?=$product['Product_Category']?></p>
       <h3 class='product-name'><a href='#'><?=$product['Product_Name']?></a></h3>

                     <?php  $percentage = $product['Product_Discount'];
                     $amount_saved = ($percentage / 100) * $product['Product_Price'];
                     $new_price =    number_format($product['Product_Price']-$amount_saved);
   
    //  <h4 class="product-price">$<?= $new_price?

      ?>
   <h4 class='product-price'>$<?=$new_price?>


   <del class='product-old-price'><?=$product['Product_Price']?></del></h4>
    

               <div class='product-rating'>
                      <i class='fa fa-star'></i>
                      <i class='fa fa-star'></i>
                      <i class='fa fa-star'></i>
                      <i class='fa fa-star'></i>
                      <i class='fa fa-star'></i>
                    </div>
                    <div class='product-btns'>
    <button class='add-to-wishlist'><i class='fa fa-heart-o'></i><span class='tooltipp'>add to wishlist</span></button>
     <button class='add-to-compare'><i class='fa fa-exchange'></i><span class='tooltipp'>add to compare</span></button>
    <button class='quick-view'><i class='fa fa-eye'></i><span class='tooltipp'>quick view</span></button>
    
                   </div>
                  </div>
                  <div class='add-to-cart'>";
                  
                  <form action="" method="post">
                                
                        <input type="hidden" name="quantity" value="1" >
                                           
                                                <input type="hidden" name="product_id" value="<?=$product['Product_ID']?>">
                <button class="add-to-cart-btn" value="Add To Cart" type="submit" ><i class="fa fa-shopping-cart"></i> add to cart</button>
                 </form>
                  </div>
                </div>
              </div>
