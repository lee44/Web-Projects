<?php
$link = mysqli_connect("localhost", "root", "", "acupuncture");
 
if($link === false) die("ERROR: Could not connect. " . mysqli_connect_error());

// When inserting data into mysql, it will convert the data to the proper datatype. For example, total is a decimal datatype in the DB. As long as the data
//being inserted doesnt contain any characters other than numbers, it will be accepted.
$customer_id = $_POST['customer_id']; 
$total = trim($_POST['grand_total'],'$');
$subtotal = trim($_POST['subtotal'],'$');
$co_pay = $_POST['co_pay'];
$taxes = $_POST['taxes'];

if(empty($co_pay)) $co_pay = 0.00;
if(empty($taxes)) $taxes = 0.00;

for($i = 0; $i < count($created_at); $i++)
{
	if(!(empty($_POST['charge_descriptions'][$i]) || empty($_POST['charges'][$i]) || empty($_POST['charge_created_at'][$i])))
	{
		$sql = "INSERT INTO payments (charge_description,total,subtotal,charges,co_pay,taxes,customer_id,charge_created_at) 
		VALUES ('".$_POST['charge_descriptions'][$i]."','$total','$subtotal','".$_POST['charges'][$i]."','$co_pay','$taxes','$customer_id','".$_POST['charge_created_at'][$i]."')";
		mysqli_query($link, $sql);
	}
}

$customer_id = mysqli_insert_id($link);

header("refresh:1;url= http://192.168.1.136:5555/Payments/index.php");
mysqli_close($link);
?>