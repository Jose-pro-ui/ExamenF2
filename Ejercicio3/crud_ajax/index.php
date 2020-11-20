<html>  
    <head>  
        <title>PHP Ajax Crud using JQuery UI Dialog</title>  
		<link rel="stylesheet" href="jquery-ui.css">
        <link rel="stylesheet" href="bootstrap.min.css" />
		<script src="jquery.min.js"></script>  
		<script src="jquery-ui.js"></script>
    </head>  
    <body style="background-color: #4FC3F7;">  
        <div class="container">
			<br />
			
			<h3 align="center"> Mis Productos</a></h3><br />
			<br />
			<div align="right" style="margin-bottom:5px;">
			<button type="button" name="add" id="add" class="btn btn-success btn-xs">Añadir</button>
			</div>
			<div class="table-responsive" id="user_data">
				
			</div>
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