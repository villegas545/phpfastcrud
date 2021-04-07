<?php
include "conexion.php";
$sql="select * from productos where id=".$_GET['id']."";
$resultados=mysqli_query($conexion,$sql);
$fila=mysqli_fetch_array($resultados);
if(isset($_POST['nombre'])){
    $sql="update productos set nombre='nombre',precio='precio',cantidad='cantidad' where id=".$_POST['id']."";
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
        <input type="text" name='nombre' placeholder="Nombre" value='<?php echo $fila['nombre'] ?>' require>
        <input type="number" name='precio' placeholder="Precio" value='<?php echo $fila['precio'] ?>' require>
        <input type="number" name='cantidad' placeholder="Cantidad" value='<?php echo $fila['cantidad'] ?>' require>
        <input type="submit" value="Modificar">
    </form>
</body>
</html>