<?php
header("Pragma: no-cache");
header("Cache-Control: no-cache");
header("Expires: 0");

// following files need to be included
require_once("./lib/config_paytm.php");
require_once("./lib/encdec_paytm.php");

$paytmChecksum = "";
$paramList = array();
$isValidChecksum = "FALSE";

$paramList = $_POST;
$paytmChecksum = isset($_POST["CHECKSUMHASH"]) ? $_POST["CHECKSUMHASH"] : ""; //Sent by Paytm pg

//Verify all parameters received from Paytm pg to your application. Like MID received from paytm pg is same as your application’s MID, TXN_AMOUNT and ORDER_ID are same as what was sent by you to Paytm PG for initiating transaction etc.
$isValidChecksum = verifychecksum_e($paramList, PAYTM_MERCHANT_KEY, $paytmChecksum); //will return TRUE or FALSE string.


if($isValidChecksum == "TRUE") {
	
	/* query insert*/
	if ($_POST["STATUS"] == "TXN_SUCCESS") {
		echo "<b>Transaction status is success</b>" . "<br/>";
		if(isset($_POST['CURRENCY'],$_POST['GATEWAYNAME'],$_POST['RESPMSG'],$_POST['BANKNAME'],$_POST['PAYMENTMODE'],$_POST['MID']
		,$_POST['RESPCODE'],$_POST['TXNID'],$_POST['TXNAMOUNT'],$_POST['ORDERID'],$_POST['STATUS']
		,$_POST['BANKTXNID'],$_POST['TXNDATE'])){
			session_start();
			$conn = mysqli_connect("localhost", "root", "");
			$db=mysqli_select_db($conn,"fuerte");
			$qry="INSERT INTO `donate`(`NAME`, `MOBILENO`, `EMAIL`, `CURRENCY`, `GATEWAYNAME`, `RESPMSG`, `BANKNAME`, `PAYMENTMODE`,
			`MID`, `RESPCODE`, `TXNID`, `TXNAMOUNT`, `ORDERID`, `STATUS`, `BANKTXNID`, `TXNDATE`) VALUES 
			('".$_SESSION['NAME']."','".$_SESSION['MOBILENO']."','".$_SESSION['EMAIL']."','".$_POST['CURRENCY']."','".$_POST['GATEWAYNAME']."','".$_POST['RESPMSG']."','"
			.$_POST['BANKNAME']."','".$_POST['PAYMENTMODE']."','".$_POST['MID']."','".$_POST['RESPCODE']."','".$_POST['TXNID']."','"
			.$_POST['TXNAMOUNT']."','".$_POST['ORDERID']."','".$_POST['STATUS']."','".$_POST['BANKTXNID']."','"
			.$_POST['TXNDATE']."')";
			
			mysqli_query($conn,$qry);
			
			
			
			header('Location: disp.php?id='.$_POST['ORDERID']);
			
			
		}
  
		
		//Process your transaction here as success transaction.
		//Verify amount & order id received from Payment gateway with your application's order id and amount.
	}
	else {
		echo "<b>Transaction status is failure</b>" . "<br/>";
		/*tranaction cancel thy to*/
		if (isset($_POST) && count($_POST)>0 )
		{ 
			foreach($_POST as $paramName => $paramValue) {
					echo "<br/>" . $paramName . " = " . $paramValue;
			}
		}
		echo "<a href='http://localhost/Fuerte/paytm_web_sample_kit_php-master/inquiry.php'";
	}

	echo "<br>";
	echo "<br><a href='http://localhost/Fuerte/paytm_web_sample_kit_php-master/inquiry.php'>Back</a>";

}
else {
	echo "<b>Checksum mismatched.</b>";
	//Process transaction as suspicious.
}

?>