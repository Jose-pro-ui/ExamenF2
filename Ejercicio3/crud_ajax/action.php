<?php

include('conexion.php');

if(isset($_POST["action"])){
	if($_POST["action"] == "insert"){
		$query = "INSERT INTO tbl_products (producto, precio) VALUES ('".$_POST["producto"]."', '".$_POST["precio"]."')";
		$statement = $connect->prepare($query);
		$statement->execute();
		echo '<p>Data Inserted...</p>';
	}
	if($_POST["action"] == "fetch_single"){
		$query = "SELECT * FROM tbl_products WHERE id = '".$_POST["id"]."'";
		$statement = $connect->prepare($query);
		$statement->execute();
		$result = $statement->fetchAll();
		foreach($result as $row){
			$output['producto'] = $row['producto'];
			$output['precio'] = $row['precio'];
		}
		echo json_encode($output);
	}
	if($_POST["action"] == "update"){
		$query = "UPDATE tbl_products SET producto = '".$_POST["producto"]."', precio = '".$_POST["precio"]."' WHERE id = '".$_POST["hidden_id"]."'";
		$statement = $connect->prepare($query);
		$statement->execute();
		echo '<p>Data Updated</p>';
	}
	if($_POST["action"] == "delete"){
		$query = "DELETE FROM tbl_products WHERE id = '".$_POST["id"]."'";
		$statement = $connect->prepare($query);
		$statement->execute();
		echo '<p>Data Deleted</p>';
	}
}
?>