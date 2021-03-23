<?php
 
 /*require  'dbconfig.php';
  

  if (!isset($_SESSION['user_id'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: login.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['user_id']);
  	header("location: login.php");
  }*/

include_once "./dbconfig.php";
$query = "SELECT * FROM items ";
  	
	 if($result = mysqli_query($conn, $query)){
    if(mysqli_num_rows($result) > 0){
        
        while($row = mysqli_fetch_array($result)){


          echo "<div class='product'>";

              
                     echo  "<div class='product-img'>";
                     
                                     
                      
         echo  " <img src='./img/".$row['Main_Image']."' alt=''>";
                                   
                  
                
                      
                         echo "<div class='product-label'>";
                         echo "<span class='sale'> ".$row['Product_Discount']."%</span>";
                         

                         echo "<span class='new'>NEW</span>";
                       echo" </div>";
                      echo "</div>";
                      echo "<div class='product-body'>";
                      echo  "<p class='product-category'>".$row['Product_Category']."</p>";
                      echo  "<h3 class='product-name'><a href='#'>".$row['Product_Name']."</a></h3>";
                      $percentage = $row['Product_Discount'];
                     $amount_saved = ($percentage / 100) * $row['Product_Price'];
                     $new_price =number_format($row['Product_Price']-$amount_saved);
                    echo" <h4 class='product-price'>".$new_price." <del class='product-old-price'>".$row['Product_Price']."</del></h4>";

                  
                
              
              
                       echo" <div class='product-rating'>
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
                      <div class='add-to-cart'>
                        <button class='add-to-cart-btn'><i class='fa fa-shopping-cart'></i> add to cart</button>
                      </div>
                    </div>";

            }
          }
        }

        //close
        ?>
	

