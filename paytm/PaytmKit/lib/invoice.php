<?php
/**
* import checksum generation utility
* You can get this utility from https://developer.paytm.com/docs/checksum/
*/
require_once("encdec_paytm.php");

/* initialize an array */
$paytmParams = array();

/* body parameters */
$paytmParams["body"] = array(

    /* Find your MID in your Paytm Dashboard at https://dashboard.paytm.com/next/apikeys */
    "mid" => "eXQ@JEpprrz14B3C",

    /* Possible value are "GENERIC", "FIXED", "INVOICE" */
    "linkType" => "INVOICE",

    /* Enter your choice of payment link description here, special characters are not allowed */
    "linkDescription" => "PAYMENT LINK DESCRIPTION",

    /* Enter your choice of payment link name here, special characters and spaces are not allowed */
    "linkName" => "PAYMENTLINKNAME",
);

/**
* Generate checksum by parameters we have in body
* Find your Merchant Key in your Paytm Dashboard at https://dashboard.paytm.com/next/apikeys 
*/
$checksum = getChecksumFromString(json_encode($paytmParams["body"], JSON_UNESCAPED_SLASHES), "YOUR_KEY_HERE");

/* head parameters */
$paytmParams["head"] = array(

    /* This will be AES */
    "tokenType"	=> "AES",

    /* put generated checksum value here */
    "signature"	=> $checksum
);

/* prepare JSON string for request */
$post_data = json_encode($paytmParams, JSON_UNESCAPED_SLASHES);

/* for Staging */
$url = "https://securegw-stage.paytm.in/link/create";

/* for Production */
// $url = "https://securegw.paytm.in/link/create";

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json")); 
$response = curl_exec($ch);

?>