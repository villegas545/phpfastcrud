<?php
include 'conexion.php';
if(isset($_GET['agregar'])){
    $sql="select * from carrito where usuario='".$_SESSION['usuario']."' and id_producto='".$_GET['agregar']."'";
    $resultados=mysqli_query($conexion,$sql);
    $num=mysqli_num_rows($resultados);
    if($num==0){
        $sql="INSERT INTO carrito(id_producto,cantidad,usuario) values('".$_GET['agregar']."','1','".$_SESSION['usuario']."')";
        mysqli_query($conexion,$sql);
    }else{
        $fila=mysqli_fetch_array($resultados);
        $cantidad=$fila['cantidad']+1;
        $sql="update carrito set cantidad='".$cantidad."' where usuario='".$_SESSION['usuario']."' and id_producto='".$_GET['agregar']."'";
        mysqli_query($conexion,$sql);
    }
    
}
if(isset($_POST['id'])){
    
    $sql="update carrito set cantidad='".$_POST['cantidad']."' where id='".$_POST['id']."'";
        mysqli_query($conexion,$sql);
}
if(isset($_GET['eliminar'])){
    $sql="delete from carrito where id=".$_GET['eliminar']."";
    mysqli_query($conexion,$sql);
}
if(isset($_GET['limpiar'])){
    $sql="delete from carrito where usuario=".$_SESSION['usuario']."";
    mysqli_query($conexion,$sql);
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
    <form action="carritoadministador.php" method="post">
        <input type="text" name="buscar" placeholder="Buscar">
    </form>
    <?php
    if(isset($_POST['buscar'])){
    ?>
<table>
        <tr>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Cantidad</th>
            <th>Total</th>
            <th>Actualizar cantidad</th>
            <th>Eliminar</th>
        </tr>
        <?php
          
          
              $buscar=$_POST['buscar'];
          
            $sql="select productos.nombre,productos.precio,carrito.cantidad,carrito.id from carrito,productos where carrito.id_producto=productos.id and usuario='".$_POST['buscar']."'";
            
            $resultados=mysqli_query($conexion,$sql);
            $total=0;
            while($filas=mysqli_fetch_array($resultados)){
                $totalproductos=$filas['cantidad']*$filas['precio'];
                $total=$total+$totalproductos;
                echo '
                <form action="carrito.php" method="post">
                    <tr>
                        <td>'.$filas['nombre'].'</td>
                        <td>'.$filas['precio'].'</td>
                        
                        <td><input value="'.$filas['cantidad'].'" type="number" name="cantidad">
                            <input type="hidden" value="'.$filas['id'].'" name="id">
                        </td>
                        <td>$'.$totalproductos.'</td>
                        <td><input type="submit" value="Actualizar cantidad"></td>
                        
                        <td><a href="#" onclick="eliminar('.$filas['id'].')">Eliminar</a></td>
                    </tr>
                    </form>
                ';
            }
        ?>
    </table>
    $<?php echo $total; ?>
    <a href="carritoadministrador.php?limpiar=1">Limpiar carrito</a>
<?php
}
?>
</body>
<script>
    function eliminar(id){
        if(confirm("Deseas eliminar el registro")){
            window.location="carritoadministrador.php?eliminar="+id;
        }
    }
</script>
</html>