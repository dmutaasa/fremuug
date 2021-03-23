
<?php
include_once('oauth.php');

$oauth_consumer_key ='BklkhHlqMXqA7QZf2b9mkZViA/hKPhBa';//= <your consumer key>
$oauth_nonce = '1224567891254';//<a unique id>
$oauth_signature = 'u221ezUpDYQQkmzVcnfHJU+qJrs=';//<OAuth signatue>
$oauth_signature_method = new OAuthSignatureMethod_HMAC_SHA1();
$oauth_timestamp =time();// <nu221ezUpDYQQkmzVcnfHJU+qJrs=umbeBklkhHlqMXqA7QZf2b9mkZViA/hKPhBar of seconds since January 1, 1970 00:00:00 GMT, also known as Unix Time>
$oauth_version = '1.0';

$reference = null;

$pesapal_tracking_id = null;

$pesapal_merchant_reference =$_GET['pesapal_merchant_reference'];

 //<the Reference you sent to PesaPal when posting the transaction>
//This is the a unique order id that you sent as Reference in the pesapal_request_data XML when posting the transaction.
$pesapal_transaction_tracking_id=$_GET['pesapal_transaction_tracking_id'];




if(isset($_GET['pesapal_merchant_reference'])){

$reference = $_GET['pesapal_merchant_reference'];
echo $_GET['pesapal_merchant_reference'];
}
if(isset($_GET['pesapal_transaction_tracking_id'])){


$pesapal_tracking_id = $_GET['pesapal_transaction_tracking_id'];
echo $_GET['pesapal_transaction_tracking_id'];

}

include 'dbconfig.php';

//store $pesapal_tracking_id in your database against the order with Order_ID  = $reference
$sql = "UPDATE Orders SET Pesa_Pal_ID ='$pesapal_tracking_id' WHERE Order_ID  ='$reference'";


include_once('oauth.php');

$consumer_key="xxxxxxxxxxxxxxxxxx";//Register a merchant account on

                   //demo.pesapal.com and use the merchant key for testing.

                   //When you are ready to go live make sure you change the key to the live account

                   //registered on www.pesapal.com!

$consumer_secret="xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx";// Use the secret from your test

                   //account on demo.pesapal.com. When you are ready to go live make sure you

                   //change the secret to the live account registered on www.pesapal.com!

$statusrequestAPI = 'https://www.pesapal.com/api/querypaymentstatus';//change to     

                   //https://www.pesapal.com/api/querypaymentstatus' when you are ready to go live!

 

// Parameters sent to you by PesaPal IPN

$pesapalNotification=$_GET['pesapal_notification_type'];

$pesapalTrackingId=$_GET['pesapal_transaction_tracking_id'];

$pesapal_merchant_reference=$_GET['pesapal_merchant_reference'];

 

if($pesapalNotification=="CHANGE" && $pesapalTrackingId!='')

{

   $token = $params = NULL;

   $consumer = new OAuthConsumer($consumer_key, $consumer_secret);

   $signature_method = new OAuthSignatureMethod_HMAC_SHA1();

 

   //get transaction status

   $request_status = OAuthRequest::from_consumer_and_token($consumer, $token, "GET", $statusrequestAPI, $params);

   $request_status->set_parameter("pesapal_merchant_reference", $pesapal_merchant_reference);

   $request_status->set_parameter("pesapal_transaction_tracking_id",$pesapalTrackingId);

   $request_status->sign_request($signature_method, $consumer, $token);

   $ch = curl_init();

   curl_setopt($ch, CURLOPT_URL, $request_status);

   curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

   curl_setopt($ch, CURLOPT_HEADER, 1);

   curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

   if(defined('CURL_PROXY_REQUIRED')) if (CURL_PROXY_REQUIRED == 'True')

   {

      $proxy_tunnel_flag = (defined('CURL_PROXY_TUNNEL_FLAG') && strtoupper(CURL_PROXY_TUNNEL_FLAG) == 'FALSE') ? false : true;

      curl_setopt ($ch, CURLOPT_HTTPPROXYTUNNEL, $proxy_tunnel_flag);

      curl_setopt ($ch, CURLOPT_PROXYTYPE, CURLPROXY_HTTP);

      curl_setopt ($ch, CURLOPT_PROXY, CURL_PROXY_SERVER_DETAILS);

   }

 

   $response = curl_exec($ch);

   $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);

   $raw_header  = substr($response, 0, $header_size - 4);

   $headerArray = explode("\r\n\r\n", $raw_header);

   $header      = $headerArray[count($headerArray) - 1];

 

   //transaction status

   $elements = preg_split("/=/",substr($response, $header_size));

   $status = $elements[1];

 

   curl_close ($ch);

 

   //UPDATE YOUR DB TABLE WITH NEW STATUS FOR TRANSACTION WITH pesapal_transaction_tracking_id $pesapalTrackingId

 

  // if(DB_UPDATE_IS_SUCCESSFUL && $status != "PENDING")

 //  {

      $resp="pesapal_notification_type=$pesapalNotification&pesapal_transaction_tracking_id=$pesapalTrackingId&pesapal_merchant_reference=$pesapal_merchant_reference";

      ob_start();

      echo $resp;

     ob_flush();

      exit;

  //}

}




?>
<!DOCTYPE html>
<html>


	<head>
		<meta charset="utf-8">
		<title>Fremu Payments</title>
		<link href="style.css" rel="stylesheet" type="text/css">
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
        
        



	</head>
	<body>


    <!-- HEADER -->
        <header>
            <!-- TOP HEADER -->
            <div id="top-header">
                <div class="container">
                    <ul class="header-links pull-left">
                        <li><a href="#"><i class="fa fa-phone"></i> +256-785-414-615</a></li>
                        <li><a href="#"><i class="fa fa-envelope-o"></i> fremu@fremu.com</a></li>
                        <li><a href="#"><i class="fa fa-map-marker"></i> 123 Ntinda Complex</a></li>
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

                        
                        <!-- /SEARCH BAR -->

                        <!-- ACCOUNT -->
                        <

                                <!-- Menu Toogle -->
                               
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
                    <!-- NAV -->
                   
                    <!-- /NAV -->
                </div>
                <!-- /responsive-nav -->
            </div>
            <!-- /container -->
        </nav>
        <!-- /NAVIGATION -->
        
        <main>
	<div class="container">
<div class="cart content-wrapper">

<?php	if ($conn->query($sql) === TRUE) {

	echo "<h2>Your Order is being processed</h2>";
	 echo"</BR>";
  echo "<p> Record updated successfully<p>";
   echo"</BR>";
 echo" <p>Thank you for ordering with us, we'll contact you by email with your order details.</p>";

 echo"</BR>";
} else {
  echo "We applogise there is an Issue with the payment: " . $conn->error;
}
?>
   
    
</div>
</div>
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
                                    <li><a href="index.php?page=newproduct">Admin</a></li>
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
                <p>&copy; $year, Fremu Ug</p>
            </div>
        </footer>

