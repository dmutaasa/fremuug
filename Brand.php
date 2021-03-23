<?PHP


$sql ='select  product_brand ,count(*) Counts  from items group by Product_Brand limit 6';
$stmt = $pdo->prepare($sql);
$stmt->execute();
if($stmt->rowCount() > 0){
	$add =1;
            while($row = $stmt->fetch()){

            	
            	

            	$id = $add + 1;

            	$brand = 'brand'.$id;


            	 echo   "<div class='input-checkbox'>";
                                echo"   <input type='checkbox' id='brand".$id."'>";
                                  echo  "<label for='brand".$id."'>";
                                      echo  "<span></span>";
                                       echo $row["product_brand"];

                                        echo "<small> (".$row["Counts"].")</small>";
                                  echo  "</label>";
                               echo "</div>";                             

               $add++;
                
            }
        } else{
            echo "<p>No New Brands Keep Shoping</p>";
        }





?>