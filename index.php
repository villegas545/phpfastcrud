
<?php
include "header.php";
?>
<?php

if($_SESSION['nivel']<>'admin'){
    header("location:principal.php");
}
if(isset($_GET['eliminar'])){
    $sql="delete from productos where id=".$_GET['eliminar']."";
    mysqli_query($conexion,$sql);
}
?>
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
    <table class="table dark-table">
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
            $record_per_page = 5;
            $pagina = '';
            if(isset($_GET["pagina"]))
            {
            $pagina = $_GET["pagina"];
            }
            else
            {
            $pagina = 1;
            }
            $start_from = ($pagina-1)*$record_per_page;
            $sql="select * from productos where nombre like '%".$buscar."%' ORDER BY id DESC LIMIT $start_from, $record_per_page";
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
    <div align="center">
    <br />
    <?php
    $page_query = "SELECT * FROM productos ORDER BY id DESC";
    $page_result = mysqli_query($conexion, $page_query);
    $total_records = mysqli_num_rows($page_result);
    $total_pages = ceil($total_records/$record_per_page);
    $start_loop = $pagina;
    $diferencia = $total_pages - $pagina;
    if($diferencia <= 5)
    {
     $start_loop = $total_pages - 5;
    }
    $end_loop = $start_loop + 4;
    if($pagina > 1)
    {
        
     echo "<a class='pagina' href='index.php?pagina=1'>Primera</a>";
     echo "<a class='pagina' href='index.php?pagina=".($pagina - 1)."'><<</a>";
    }
    for($i=$start_loop; $i<=$end_loop+1; $i++)
    {     
        if($i>0){
            echo "<a class='pagina' href='index.php?pagina=".$i."'>".$i."</a>";
        }
    }
    if($pagina <= $end_loop)
    {
     echo "<a class='pagina' href='index.php?pagina=".($pagina + 1)."'>>></a>";
     echo "<a class='pagina' href='index.php?pagina=".$total_pages."'>Última</a>";
    }
    
    
    ?>
    </div>
    <?php
include "footer.php";
?>