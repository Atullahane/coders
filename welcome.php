<?php 

session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
}

include('header.php');
include 'product.php';
$product = new product();
//$product->checkLoggedIn();
?>
<title>product System</title>
 <script src="js/product.js"></script> 
<link href="css/style.css" rel="stylesheet">
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <ul class="nav navbar-nav">
      <li class=""><?php echo "<h1>Welcome " . $_SESSION['username'] . "</h1><br>"; ?></li>
      <li><a href="logout.php" title="logout"><button class="btn btn-primary btn-sm">logout</button></a></li>
    </ul>
  </div>
</nav>

	<div class="container">	
  	<a href="create_product.php" title="Create product"><button class="btn btn-primary btn-sm">Create product</button></a>
	  <h2 class="title mt-5">PHP product System</h2>			  
      <table id="data-table" class="table table-condensed table-hover table-striped">
        <thead>
          <tr>
            <th>product No.</th>
            <th>product Name</th>
            <th>Create Date</th>
            <!-- <th>Total</th> -->
            <th>Print</th>
            <th>Edit</th>
            <th>Delete</th>   
          </tr>
        </thead>
        <?php		
	    	$productList = $product->getproductList();
        foreach($productList as $productDetails){
			$productDate = date("d/M/Y, H:i:s", strtotime($productDetails["order_date"]));
            echo '
              <tr>
                <td>'.$productDetails["order_id"].'</td>
                <td>'.$productDetails["product_name"].'</td>
                <td>'.$productDate.'</td>
                
                <td><a href="print_product.php?product_id='.$productDetails["order_id"].'" title="Print product"><button class="btn btn-primary btn-sm"><i class="fa fa-print"></i></button></a></td>
                <td><a href="edit_product.php?update_id='.$productDetails["order_id"].'"  title="Edit product"><button class="btn btn-success btn-sm"><i class="fa fa-edit"></i></button></a></td>
                <td><a href="delete-product.php?order_id='.$productDetails['order_id'].'" title="Delete product"><button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button></a></td>
              </tr>
            ';
        }       
        ?> 
      </table>	
</div>	
<?php include('footer.php');?>

<!-- <td>$'.$productDetails["order_total_after_tax"].'</td> -->