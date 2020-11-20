<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yogurt Danone</title>
    <link rel="icon" href="img/logo.png"/>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
    <link rel="stylesheet" href="./crud_ajax/jquery-ui.css">
    <link rel="stylesheet" href="./crud_ajax/bootstrap.min.css" />
    <script src="./crud_ajax/jquery.min.js"></script>  
	<script src="./crud_ajax/jquery-ui.js"></script>
</head>
<body>
    <!--CABECERA-->
    <header class="header">  
        <ul>
        <li><img src="img/logo.png" class="logo"></li>
        <li><a href="index.html">Inicio</a></li>
        <li><a href="#nosotros">Nosotros</a></li>                
        <li><a href="#productos">Productos</a></li>
        <li><a href="#contactos">Contactos</a></li>
        </ul>
    </header>

    <!--PORTADA-->
    <div class="portada">
        <img src="img/portada.png" alt="" class="imgpor">
    </div>

    <!--PRODUCTOS-->
    <h1 class="titulo" id="productos">PRODUCTOS</h1>
    <div class="container">
		<br />	
        
        <h3 align="center"> Mis Productos</a></h3><br />
        
        <br />
        
		<div align="right" style="margin-bottom:5px;">
		    <button type="button" name="add" id="add" class="btn btn-success btn-xs">Añadir</button>
		</div>
        
        <div class="table-responsive" id="user_data"></div>
		<br />
    </div>
    
	<div id="user_dialog" title="Registro de Producto">
		<form method="post" id="user_form">
			<div class="form-group">
				<label>Ingrese el producto</label>
				<input type="text" name="producto" id="producto" class="form-control" />
				<span id="error_producto" class="text-danger"></span>
			</div>
			<div class="form-group">
				<label>Ingrese el precio</label>
				<input type="text" name="precio" id="precio" class="form-control" />
				<span id="error_precio" class="text-danger"></span>
			</div>
			<div class="form-group">
				<input type="hidden" name="action" id="action" value="insert" />
				<input type="hidden" name="hidden_id" id="hidden_id" />
				<input type="submit" name="form_action" id="form_action" class="btn btn-info" value="Insert" />
			</div>
		</form>
	</div>
		
	<div id="action_alert" title="Action"></div>
		
	<div id="delete_confirmation" title="Confirmation">
		<p>Esta seguro de Eliminar es elemento?</p>
	</div>
    <!--FOOTER-->
    <footer>
        <div class="derechos">
        <h4>Derechos Reservados © Danone</h4>
        </div>
    </footer>
</body>
</html>