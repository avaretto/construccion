<html>
    <head>
        
    </head>
    
    <body>
        
        <?php
            session_start();
            $_SESSION['idPrestamo'];
  
            //valores capturados y solicitados
            $prestamo = $_SESSION['idPrestamo'];
            $herramienta = $_GET['id']; //desde archivo "buscarHerramienta.php"
            $cantidad = 1;
        
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
            $consulta = "INSERT INTO det_prestamo (fk_prestamo, fk_herramienta, cant_herramienta)
            VALUES(?,?,?)";
        
            //validar consulta
            $resultado = mysqli_prepare($conexion, $consulta);
            
            //acceder a resultados
            //si la variable guarda resultados
            if(!$resultado) {
                echo "Error: " . mysqli_error($conexion);   
            }
            
            //prepara sentencia
            $ok = mysqli_stmt_bind_param($resultado, "iii", $prestamo, $herramienta , $cantidad);
            $ok = mysqli_stmt_execute($resultado);
            
            //validar variable ok
            if($ok == false){
                echo "Error:";
                
            }else{
                //si se ingresa correctamente
                //descontar herramienta de disponibles
                $consulta2 ="UPDATE herramienta SET stock_her = 0 WHERE id_her = '$herramienta'";
                $resultado2 = mysqli_query($conexion, $consulta2);
                
                //redirigir
                header('location: listadoDetPrestamo.php');
            }

            //cerrar conexion
            mysqli_close($conexion);
            
        ?>
    </body>
</html>