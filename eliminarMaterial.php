<html>
    <head>
        <style>
            table{
                width: 50%;
                border: 1px solid red;
                margin: auto;
            }
        </style>
    </head>
    
    <body>
        <?php
            session_start();
            //session de seguridad
            $_SESSION['idBodeguero'];
            $_SESSION['idMaterial'];
            $_SESSION['opcVolver'];
        
            echo $_SESSION['idBodeguero'];
            echo $_SESSION['idMaterial'];
            echo $_SESSION['opcVolver'];
        
            //guardar id en variable
            $_SESSION['idMaterial'] = $_GET["id"];
            $material = $_SESSION['idMaterial'];
            echo $material;
        
            //guardar opc en variable
            $opc = $_SESSION['opcVolver'];
            echo " opc= ";
            echo $opc;
            
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
        
            //generar consulta
            //eliminar material
            $consulta = "DELETE FROM material
                            WHERE id_mat ='$material'";
            //validar consulta
            $resultado = mysqli_query($conexion, $consulta);
   
            //redirije segun opc
            if($opc==1){
                header('Location: listadoMaterial.php');
            }
            if($opc==2){
                header('Location: buscarMaterialM.php');
            }
         
            //cerrar conexion
            mysqli_close($conexion);
            
        ?>
    </body>
</html>