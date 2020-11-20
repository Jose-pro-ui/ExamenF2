<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 2</title>
</head>
<body>
    <h2>Ejercicio 2</h2>
    <p>
        Implementar una página que contenga una caja de texto y un botón. Al introducir
        nuestro ci en la caja de texto busque en la base de datos y si estamos en ella muestre
        nuestros datos. Los datos son: ci, nombre apellido paterno apellido materno. Todo esto se
        debe hacer de forma asincrónica
    </p>

    <div class="container">
        <h2>Busqueda por numero de carnet</h2>
        <form action="form" method="POST">
            <div class="form-group">
                <label for="text">Carnet de Identidad:</label>
                <input type="text" class="form-control" name="documento" placeholder="Ingrese C.I." required>
            </div>
            <button type="submit" class="btn btn-default">Consultar</button>
        </form>
    </div>
</body>
</html>
