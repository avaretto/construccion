<html>
    <head>

    </head>
    
    <body>
        <?php
            session_start();
            //session de seguridad
            $_SESSION['idBodeguero'];
            $_SESSION['idObrero'];
            $_SESSION['idPrestamo'];
        
            //captura id detalle préstamo
            $detalle = $_GET['id'];
            
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
            //1. actualizar stock
            //2. borrar det prestamo
            //3. borrar prestamo
            $consulta1 = "UPDATE herramienta
                            SET stock_her = 1
                            WHERE id_her =(SELECT fk_herramienta
                            FROM det_prestamo
                            WHERE id_det ='$detalle')";
            
            $consulta2 = "DELETE FROM det_prestamo
                            WHERE id_det ='$detalle'";
        
        
        
            //validar consulta
            $resultado1 = mysqli_query($conexion, $consulta1);
            $resultado2 = mysqli_query($conexion, $consulta2);
        
            header('location: listadoDetPrestamo.php');
            //***SE PODRIA MANDAR ID = ID PRESTAMO
        
            //acceder a resultados
            //si la variable guarda resultados
            
            /*   
             if(!$resultado) {
                echo "Error: " . mysqli_error($conexion);   
            }
            */
            //cerrar conexion
            mysqli_close($conexion);
            
        ?>
    </body>
</html>