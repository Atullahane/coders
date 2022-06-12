<?php
class product{
	private $host  = 'localhost';
    private $user  = 'root';
    private $password   = "";
    private $database  = "coders_db";   
	private $productUserTable = 'users';	
    private $productOrderTable = 'product_order';
	private $productOrderItemTable = 'product_order_item';
	private $dbConnect = false;
    public function __construct(){
        if(!$this->dbConnect){ 
            $conn = new mysqli($this->host, $this->user, $this->password, $this->database);
            if($conn->connect_error){
                die("Error failed to connect to MySQL: " . $conn->connect_error);
            }else{
                $this->dbConnect = $conn;
            }
        }
    }
	private function getData($sqlQuery) {
		$result = mysqli_query($this->dbConnect, $sqlQuery); 
		if(!$result){
			die('Error in query: '. mysqli_error()); 
		}
		$data= array();
		while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
			$data[]=$row;            
		}
		return $data;
	}
	private function getNumRows($sqlQuery) {
		$result = mysqli_query($this->dbConnect, $sqlQuery);
		if(!$result){
			die('Error in query: '. mysqli_error());
		}
		$numRows = mysqli_num_rows($result);
		return $numRows;
	}
	// public function loginUsers($email, $password){
	// 	$sqlQuery = "
	// 		SELECT id, email, first_name, last_name, address, mobile 
	// 		FROM ".$this->productUserTable." 
	// 		WHERE email='".$email."' AND password='".$password."'";
 //        return  $this->getData($sqlQuery);
	// }	
	// public function checkLoggedIn(){
	// 	if(!$_SESSION['userid']) {
	// 		header("Location:index.php");
	// 	}
	// }		
	public function saveproduct($POST) {		
		$sqlInsert = "INSERT INTO ".$this->productOrderTable."(user_id, product_name, order_total_before_tax, order_total_tax, order_tax_per, order_total_after_tax, order_amount_paid, order_total_amount_due, note) VALUES ('".$POST['userId']."', '".$POST['mainproductName']."', '".$POST['subTotal']."', '".$POST['taxAmount']."', '".$POST['taxRate']."', '".$POST['totalAftertax']."', '".$POST['amountPaid']."', '".$POST['amountDue']."', '".$POST['notes']."')";		
		mysqli_query($this->dbConnect, $sqlInsert);
		$lastInsertId = mysqli_insert_id($this->dbConnect);
		for ($i = 0; $i < count($POST['productCode']); $i++) {
			$sqlInsertItem = "INSERT INTO ".$this->productOrderItemTable."(order_id, item_code, item_name, order_item_quantity, order_item_price, order_item_final_amount) VALUES ('".$lastInsertId."', '".$POST['productCode'][$i]."', '".$POST['productName'][$i]."', '".$POST['quantity'][$i]."', '".$POST['price'][$i]."', '".$POST['total'][$i]."')";			
			mysqli_query($this->dbConnect, $sqlInsertItem);
		}       	
	}	
	public function updateproduct($POST) {
		if($POST['productId']) {	
			//echo $_POST['userId'];
//exit();

			//$POST['taxAmount']='12';
			//$POST['taxRate']='12';

			$sqlInsert = "UPDATE ".$this->productOrderTable." 
				SET product_name = '".$POST['mainproductName']."', order_total_before_tax = '".$POST['subTotal']."', order_total_tax = '".$POST['taxAmount']."', order_tax_per = '".$POST['taxRate']."', order_total_after_tax = '".$POST['totalAftertax']."', order_amount_paid = '".$POST['amountPaid']."', order_total_amount_due = '".$POST['amountDue']."', note = '".$POST['notes']."' 
				WHERE order_id = '".$POST['productId']."'";		
			mysqli_query($this->dbConnect, $sqlInsert);	
		}		
		$this->deleteproductItems($POST['productId']);
		for ($i = 0; $i < count($POST['productCode']); $i++) {			
			$sqlInsertItem = "INSERT INTO ".$this->productOrderItemTable."(order_id, item_code, item_name, order_item_quantity, order_item_price, order_item_final_amount) 
				VALUES ('".$POST['productId']."', '".$POST['productCode'][$i]."', '".$POST['productName'][$i]."', '".$POST['quantity'][$i]."', '".$POST['price'][$i]."', '".$POST['total'][$i]."')";			
			mysqli_query($this->dbConnect, $sqlInsertItem);			
		}       	
	}	
	public function getproductList(){
		$sqlQuery = "SELECT * FROM ".$this->productOrderTable." 
			WHERE user_id = '".$_SESSION['id']."'";
		return  $this->getData($sqlQuery);
	}	
	public function getproduct($productId){
		$sqlQuery = "SELECT * FROM ".$this->productOrderTable." 
			WHERE user_id = '".$_SESSION['id']."' AND order_id = '$productId'";
		$result = mysqli_query($this->dbConnect, $sqlQuery);	
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		return $row;
	}	
	public function getproductItems($productId){
		$sqlQuery = "SELECT * FROM ".$this->productOrderItemTable." 
			WHERE order_id = '$productId'";
		return  $this->getData($sqlQuery);	
	}
	public function deleteproductItems($productId){
		$sqlQuery = "DELETE FROM ".$this->productOrderItemTable." 
			WHERE order_id = '".$productId."'";
		mysqli_query($this->dbConnect, $sqlQuery);				
	}
	public function deleteproduct($productId){
		$sqlQuery = "DELETE FROM ".$this->productOrderTable." 
			WHERE order_id = '".$productId."'";
		mysqli_query($this->dbConnect, $sqlQuery);	
		$this->deleteproductItems($productId);	
		return 1;
	}
}
?>  