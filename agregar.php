<?php
include "conexion.php";
if(isset($_POST['nombre'])){
    $sql="insert into productos(nombre,precio,cantidad) values('".$_POST['nombre']."','".$_POST['precio']."','".$_POST['cantidad']."')";
    mysqli_query($conexion,$sql);
    header('location: index.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="agregar.php" method="post">
        <input type="text" name='nombre' placeholder="Nombre" require>
        <input type="number" name='precio' placeholder="Precio" require>
        <input type="number" name='cantidad' placeholder="Cantidad" require>
        <input type="submit" value="Agregar">
    </form>
</body>
</html>