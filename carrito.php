<?php
include 'conexion.php';
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
<table>
        <tr>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Cantidad</th>
            <th>Eliminar</th>
        </tr>
        <?php
            $sql="select * from carrito,productos where carrito.id_producto=productos.id and usuario='".$_SESSION['usuario']."'";
            
            $resultados=mysqli_query($conexion,$sql);
            while($filas=mysqli_fetch_array($resultados)){
                echo '
                    <tr>
                        <td>'.$filas['nombre'].'</td>
                        <td>'.$filas['precio'].'</td>
                        <td>'.$filas['cantidad'].'</td>
                        <td><a href="#" onclick="eliminar('.$filas['id'].')">Eliminar</a></td>
                    </tr>
                ';
            }
        ?>
    </table>
</body>
</html>