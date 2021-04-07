<?php
include "header.php";
?>
    <!-- Jumbotron Header -->
    <header class="jumbotron my-4">
      <h1 class="display-3">A Warm Welcome!</h1>
      <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsa, ipsam, eligendi, in quo sunt possimus non incidunt odit vero aliquid similique quaerat nam nobis illo aspernatur vitae fugiat numquam repellat.</p>
      <a href="#" class="btn btn-primary btn-lg">Call to action!</a>
    </header>

    <!-- Page Features -->
    <div class="row text-center">
    <?php
            $buscar='';
            if(isset($_POST['buscar'])){
                $buscar=$_POST['buscar'];
            }
            $sql="select * from productos where nombre like '%".$buscar."%'";
            $resultados=mysqli_query($conexion,$sql);
            while($filas=mysqli_fetch_array($resultados)){
                ?>
                 <div class="col-lg-3 col-md-6 mb-4">
                    <div class="card h-100">
                    <img class="card-img-top" src="http://placehold.it/500x325" alt="">
                    <div class="card-body">
                        <h4 class="card-title"><?php echo $filas['nombre'] ?></h4>
                        <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sapiente esse necessitatibus neque.</p>
                    </div>
                    <div class="card-footer">
                    <p class="card-text">$<?php echo $filas['precio']  ?></p>
                    <?php
                    if(isset($_SESSION['usuario'])){
                        ?>
                        <a href="carrito.php?agregar=<?php echo $filas['id'] ?>" class="btn btn-primary">Agregar al carrito</a>
                        <?php
                    }
                    ?>
                        
                    </div>
                    </div>
                </div>
            <?php 
            }
        ?>
    
    </div>
    <!-- /.row -->
    <?php
include "footer.php";
?>