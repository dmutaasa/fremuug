<?php $percentage = $product['Product_Discount'];
                     $amount_saved = ($percentage / 100) * $product['Product_Price'];
                     $new_price =number_format($product['Product_Price']-$amount_saved);
                     ?>