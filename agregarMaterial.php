<html>
    <head>
        
    </head>
    
    <body>
        
        <?php
            session_start();
            $_SESSION['idEntrega'];
            $_SESSION['idMaterial'];
  
            //valores capturados y solicitados
            $entrega = $_SESSION['idEntrega'];
            $material = $_SESSION['idMaterial']; //desde archivo "buscarMaterial.php"
            $cantidad = $_GET['cant'];
        
            echo $entrega;
            echo "<br>";
            echo $material;
            echo "<br>";
            echo $cantidad;
        
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
        
            //generar consultas
            //***Se debe validar que la cantidad ingresada sea igual o menor que la del stock
        
            
            $consulta = "INSERT INTO det_entrega (fk_entrega, fk_material, cant_material)
            VALUES(?,?,?)";
        
            //validar consulta
            $resultado = mysqli_prepare($conexion, $consulta);
            
            //acceder a resultados
            //si la variable guarda resultados
            if(!$resultado) {
                echo "Error: " . mysqli_error($conexion);   
            }
            
            //prepara sentencia
            $ok = mysqli_stmt_bind_param($resultado, "iii", $entrega, $material , $cantidad);
            $ok = mysqli_stmt_execute($resultado);
            
            //validar variable ok
            if($ok == false){
                echo "Error:";
                
            }else{
                //si se ingresa correctamente
                //descontar herramienta de disponibles
                $consulta2 ="UPDATE material SET stock_mat = stock_mat - '$cantidad' WHERE id_mat = '$material'";
                $resultado2 = mysqli_query($conexion, $consulta2);
                
                //redirigir
                header('location: listadoDetEntrega.php');
            }

            //cerrar conexion
            mysqli_close($conexion);
           
        ?>
    </body>
</html>