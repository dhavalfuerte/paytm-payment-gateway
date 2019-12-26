<?php
session_start();

	$amount=$_POST['amount'];
	$firstname=$_POST['first_name'];
	$lastname=$_POST['last_name'];
	$email=$_POST['email'];
	$areacode=$_POST['area_code'];
	$phone=$_POST['phone'];
	$name=$firstname.' '.$lastname;
	$mobileno=$areacode.' '.$phone;
	
$_SESSION['NAME']=$name;
$_SESSION['MOBILENO']=$mobileno;
$_SESSION['EMAIL']=$_POST["email"];

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
			<title>
			</title>
	</head>
<body>
	<form method="post" action="paytm/PaytmKit/pgRedirect.php">
		<!-- order_id -->
	<input id="ORDER_ID" type="hidden" tabindex="1" maxlength="20" size="20"
						name="ORDER_ID" autocomplete="off"
						value="<?php echo  "ORDS" . rand(10000,99999999)?>">
						
	<!-- Customer Id Rand -->					
	<input id="CUST_ID" tabindex="2" maxlength="12" size="12"  type="hidden" name="CUST_ID" autocomplete="off" value="<?php echo  "CUST_ID_" . rand(10000,99999999)?>">
	
	<!-- INDUSTRY_TYPE_ID -->
	<input id="INDUSTRY_TYPE_ID" tabindex="4" maxlength="12" type="hidden"  size="12" name="INDUSTRY_TYPE_ID" autocomplete="off" value="Retail">
	
	<!-- CHANNEL_ID -->
	<input id="CHANNEL_ID" tabindex="4" maxlength="12" type="hidden" size="12" name="CHANNEL_ID" autocomplete="off" value="WEB">
		<table border="1">
		
			<tbody>
				<tr>
					<th>S.No</th>
					<th>Label</th>
					<th>Value</th>
				</tr>
				<tr>
					
					

				</tr>
				<tr>
					<td>1</td>
					<td><label>Name ::*</label></td>
					<td><input id="name"  tabindex="1" maxlength="30" size="30"
						name="name" autocomplete="off"
						value="<?php echo  $firstname.' '.$lastname;?>"></td>
				</tr>
				<tr>
					<td>2</td>
					<td><label>Email ::*</label></td>
					<td><input id="Email"  tabindex="1" maxlength="50" size="50"
						name="email" autocomplete="off"
						value="<?php echo  $email;?>"></td>
				</tr>
				<tr>
					<td>3</td>
					<td><label>Mobile No ::*</label></td>
					<td><input id="mobileno"  tabindex="1" maxlength="30" size="30"
						name="mobileno" autocomplete="off"
						value="<?php echo  $areacode.' '.$phone;?>">
					</td>
				</tr>
				<tr>
					<td>4</td>
					<td><label>Amount*</label></td>
					<td><input title="AMOUNT" tabindex="10"
						type="text" name="TXN_AMOUNT"
						value="<?php echo $amount; ?>">
					</td>
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td><input value="CheckOut" type="submit"	onclick=""></td>
				</tr>
			</tbody>
		</table>
		* - Mandatory Fields
	</form>
</body>
</html>