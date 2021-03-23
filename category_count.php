<?PHP


$sql ='select  product_category ,count(*) Counts  from items group by product_category limit 6';
$stmt = $pdo->prepare($sql);
$stmt->execute();
if($stmt->rowCount() > 0){
	$add =1;
            while($row = $stmt->fetch()){

            	
            	

            	$id = $add + 1;

            	$brand = 'brand'.$id;


            	 echo   "<div class='input-checkbox'>";
                                echo"   <input type='checkbox' id='category".$id."'>";
                                  echo  "<label for='category".$id."'>";
                                      echo  "<span></span>";
                                       echo $row["product_category"];

                                        echo "<small> (".$row["Counts"].")</small>";
                                  echo  "</label>";
                               echo "</div>";                             

               $add++;
                
            }
        } else{
            echo "<p>No New Brands Keep Shoping</p>";
        }





?>