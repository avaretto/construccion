<?php
    session_start();
    //session de seguridad
    $_SESSION['idBodeguero'];
    //$_SESSION['idObrero'];
    //echo $_SESSION['idBodeguero'];
    //echo $_SESSION['idObrero'];


    //datos de conexion, llama al archivo con datos de la bd
    require ("dbConstruccion.php");
        
    //establecer conexion a servidor
    $conexion = mysqli_connect($db_host, $db_user, $db_pass);
    if(mysqli_connect_errno()) {
    //notifica algo en caso de error
    echo "fallo de conexion<br>";
    //salir para liberar conexion
        exit();
    }else{
        echo "conexion establecida<br>";
    }
        
    //validar existencia de la base de datos
    mysqli_select_db($conexion, $db_nombre) or die("No se encuentra la base de datos<br>");
    //establecer codificacion
    mysqli_set_charset($conexion, 'utf8');
        


    //Eliminar un prestamo cuando no tenga ningun detalle   
    //consulta
    $consulta = "DELETE p.*
                FROM prestamo p
                WHERE NOT EXISTS (SELECT * FROM det_prestamo d 
                                 WHERE p.id_pre = d.fk_prestamo)";

    $resultado = mysqli_query($conexion, $consulta);
    
    header('Location: moduloBodeguero.php');

?>