<?php
include "conexion.php";
if(isset($_POST['usuario'])){
    $sql="SELECT * from usuarios where nombre='".$_POST['usuario']."' and contra='".$_POST['contra']."'";
    
    $resultados=mysqli_query($conexion,$sql);
    $num=mysqli_num_rows($resultados);
    $fila=mysqli_fetch_array($resultados);
    if($num==1){
        
        $_SESSION['usuario']=$_POST['usuario'];
        $_SESSION['nivel']=$fila['nivel'];
        header('location: index.php');
    }else{
        echo "<script>alert('Usuario o contrasenia incorrectas');</script>";    
    }
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
    <form action="login.php" method="post">
        <input type="text" name="usuario" >
        <input type="text" name="contra" >
        <input type="submit" value="Login">
    </form>
</body>
</html>