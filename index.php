<?php
include "conexion.php";
if(isset($_GET['eliminar'])){
    $sql="delete from productos where id=".$_GET['eliminar']."";
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
<?php
if(isset($_SESSION['usuario'])){
    echo '<h1>'.$_SESSION['usuario'].'</h1>';
}


?>

    menu para todos

    <?php
if(isset($_SESSION['nivel'])){
    if($_SESSION['nivel']=='admin'){
   ?>
   menu especial para administrador
   <?php
    }
}
    ?>

    
<body>
    <button><a href="agregar.php">Agregar</a></button>
    <form action="index.php" method="post">
        <input type="text" name="buscar" placeholder="Buscar">
    </form>
    <table>
        <tr>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Cantidad</th>
            <th>Modificar</th>
            <th>Eliminar</th>
        </tr>
        <?php
            $buscar='';
            if(isset($_POST['buscar'])){
                $buscar=$_POST['buscar'];
            }
            $sql="select * from productos where nombre like '%".$buscar."%'";
            $resultados=mysqli_query($conexion,$sql);
            while($filas=mysqli_fetch_array($resultados)){
                echo '
                    <tr>
                        <td>'.$filas['nombre'].'</td>
                        <td>'.$filas['precio'].'</td>
                        <td>'.$filas['cantidad'].'</td>
                        <td><a href="modificar.php?id='.$filas['id'].'">Modificar</a></td>
                        <td><a href="#" onclick="eliminar('.$filas['id'].')">Eliminar</a></td>
                    </tr>
                ';
            }
        ?>
    </table>
    
</body>
<script>
    function eliminar(id){
        if(confirm("Deseas eliminar el registro")){
            window.location="index.php?eliminar="+id;
        }
    }
</script>
</html>