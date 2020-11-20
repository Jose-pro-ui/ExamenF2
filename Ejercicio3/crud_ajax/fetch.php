<?php

include("conexion.php");

$query = "SELECT * FROM tbl_products";
$statement = $connect->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
$total_row = $statement->rowCount();
$output = '
<table class="table table-striped table-bordered">
	<tr>
		<th>Producto</th>
		<th>Precio $</th>
		<th>Editar</th>
		<th>Borrar</th>
	</tr>
';
if($total_row > 0){
	foreach($result as $row){
		$output .= '
		<tr>
			<td width="40%">'.$row["producto"].'</td>
			<td width="40%">'.$row["precio"].'</td>
			<td width="10%">
				<button type="button" name="edit" class="btn btn-primary btn-xs edit" id="'.$row["id"].'">Editar</button>
			</td>
			<td width="10%">
				<button type="button" name="delete" class="btn btn-danger btn-xs delete" id="'.$row["id"].'">Borrar</button>
			</td>
		</tr>
		';
	}
}
else{
	$output .= '
	<tr>
		<td colspan="4" align="center">Data not found</td>
	</tr>
	';
}
$output .= '</table>';
echo $output;
?>
