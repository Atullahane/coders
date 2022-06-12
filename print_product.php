<?php
session_start();
include 'product.php';
$product = new product();
//$product->checkLoggedIn();
if(!empty($_GET['product_id']) && $_GET['product_id']) {
	echo $_GET['product_id'];

	$productValues = $product->getproduct($_GET['product_id']);		
	$productItems = $product->getproductItems($_GET['product_id']);		
}
$productDate = date("d/M/Y, H:i:s", strtotime($productValues['order_date']));

$output = '';
$output .= '<table width="100%" border="1" cellpadding="5" cellspacing="0">
	<tr>
	<td colspan="2" align="center" style="font-size:18px"><b>product</b></td>
	</tr>
	<tr>
	<td colspan="2">
	<table width="100%" cellpadding="5">
	<tr>
	<td width="65%">
	<b>Product Name : '.$productValues['product_name'].'</b><br /> 
	
	</td>
	<td width="35%">         
	product No. : '.$productValues['order_id'].'<br />
	product Date : '.$productDate.'<br />
	</td>
	</tr>
	</table>
	<br />
	<table width="100%" border="1" cellpadding="5" cellspacing="0">
	<tr>
	<th align="left">Sr No.</th>
	<th align="left">Item Code</th>
	<th align="left">Item Name</th>
	<th align="left">Quantity</th>
	<th align="left">Price</th>
	<th align="left">Actual Amt.</th> 
	</tr>';

$count = 0;   
foreach($productItems as $productItem){
	$count++;
	$output .= '
	<tr>
	<td align="left">'.$count.'</td>
	<td align="left">'.$productItem["item_code"].'</td>
	<td align="left">'.$productItem["item_name"].'</td>
	<td align="left">'.$productItem["order_item_quantity"].'</td>
	<td align="left">'.$productItem["order_item_price"].'</td>
	<td align="left">'.$productItem["order_item_final_amount"].'</td>   
	</tr>';
}

$output .= '
	<tr>
	<td align="right" colspan="5"><b>Sub Total</b></td>
	<td align="left"><b>'.$productValues['order_total_before_tax'].'</b></td>
	</tr>';

$output .= '
	</table>
	</td>
	</tr>
	</table>';
	//echo $output;
//exit();
// create pdf of product	
$productFileName = 'Astroproduct_'.$productValues['order_id'].'.pdf';
require_once 'dompdf/src/Autoloader.php';
Dompdf\Autoloader::register();
use Dompdf\Dompdf;
$dompdf = new Dompdf();
$dompdf->loadHtml(html_entity_decode($output));
$dompdf->setPaper('A4', 'landscape');
$dompdf->render();
$dompdf->stream($productFileName, array("Attachment" => false));
?>   
   