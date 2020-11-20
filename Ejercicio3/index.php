<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>La Cascada</title>
    <link rel="icon" href="img/logo.png"/>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
    
    <link rel="stylesheet" href="jquery-ui.css">
    <link rel="stylesheet" href="bootstrap.min.css" />
    <script src="jquery.min.js"></script>  
    <script src="jquery-ui.js"></script>
    
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
        <img src="img/portada.jpg" alt="" class="imgpor">
    </div>

    <!--PRODUCTOS-->
    <h1 class="titulo" id="productos">PRODUCTOS</h1>
    <div style="background-color: #4FC3F7;">
        <div class="container">	
            <h3 align="center">Tabla de Registro</a></h3>
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
    </div>
    <!--FOOTER-->
    <footer>
        <div class="derechos">
        <h4>Derechos Reservados © Danone</h4>
        </div>
    </footer>
</body>
</html>

<script>  
$(document).ready(function(){  
	load_data();
	function load_data(){
		$.ajax({
			url:"fetch.php",
			method:"POST",
			success:function(data){
				$('#user_data').html(data);
			}
		});
	}
	$("#user_dialog").dialog({
		autoOpen:false,
		width:400
	});
	$('#add').click(function(){
		$('#user_dialog').attr('title', 'Add Data');
		$('#action').val('insert');
		$('#form_action').val('Insert');
		$('#user_form')[0].reset();
		$('#form_action').attr('disabled', false);
		$("#user_dialog").dialog('open');
	});
	$('#user_form').on('submit', function(event){
		event.preventDefault();
		var error_producto = '';
		var error_precio = '';
		if($('#producto').val() == ''){
			error_producto = 'Producto requerido';
			$('#error_producto').text(error_producto);
			$('#producto').css('border-color', '#cc0000');
		}
		else{
			error_producto = '';
			$('#error_producto').text(error_producto);
			$('#producto').css('border-color', '');
		}
		if($('#precio').val() == ''){
			error_precio = 'Precio requerido';
			$('#error_precio').text(error_precio);
			$('#precio').css('border-color', '#cc0000');
		}
		else{
			error_precio = '';
			$('#error_precio').text(error_precio);
			$('#precio').css('border-color', '');
		}	
		if(error_producto != '' || error_precio != ''){
			return false;
		}
		else{
			$('#form_action').attr('disabled', 'disabled');
			var form_data = $(this).serialize();
			$.ajax({
				url:"action.php",
				method:"POST",
				data:form_data,
				success:function(data){
					$('#user_dialog').dialog('close');
					$('#action_alert').html(data);
					$('#action_alert').dialog('open');
					load_data();
					$('#form_action').attr('disabled', false);
				}
			});
		}
	});
	
	$('#action_alert').dialog({
		autoOpen:false
	});
	$(document).on('click', '.edit', function(){
		var id = $(this).attr('id');
		var action = 'fetch_single';
		$.ajax({
			url:"action.php",
			method:"POST",
			data:{id:id, action:action},
			dataType:"json",
			success:function(data){
				$('#producto').val(data.producto);
				$('#precio').val(data.precio);
				$('#user_dialog').attr('title', 'Edit Data');
				$('#action').val('update');
				$('#hidden_id').val(id);
				$('#form_action').val('Update');
				$('#user_dialog').dialog('open');
			}
		});
	});
	$('#delete_confirmation').dialog({
		autoOpen:false,
		modal: true,
		buttons:{
			Ok : function(){
				var id = $(this).data('id');
				var action = 'delete';
				$.ajax({
					url:"action.php",
					method:"POST",
					data:{id:id, action:action},
					success:function(data){
						$('#delete_confirmation').dialog('close');
						$('#action_alert').html(data);
						$('#action_alert').dialog('open');
						load_data();
					}
				});
			},
			Cancel : function(){
				$(this).dialog('close');
			}
		}	
	});
	$(document).on('click', '.delete', function(){
		var id = $(this).attr("id");
		$('#delete_confirmation').data('id', id).dialog('open');
	});
});  
</script>