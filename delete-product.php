<?php

session_start();

include 'config.php';


if (isset($_GET['order_id']))
{
    $order_id=$_GET['order_id'];
    $deleteQuery="DELETE FROM product_order where order_id=$order_id"; 
    //$deleteQuery="DELETE FROM product_order_item where order_id=$order_id"; 
    mysqli_query($conn, $deleteQuery);

	$deleteQuerysub="DELETE FROM product_order_item where order_id=$order_id"; 
    mysqli_query($conn, $deleteQuerysub);

    echo "<script>window.location = 'product_list.php';</script>";
} else {
    echo "ERR!";
}


?>
//product_order_item