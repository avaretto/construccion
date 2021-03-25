<html>
    <head>
        
    </head>
    
    <body>
        <?php
            session_start();
            $_SESSION['idBodeguero'];
            $_SESSION['idObrero'];
            $_SESSION['idPrestamo'];
                
            date_default_timezone_set('America/Santiago');
            
            //valores solicitados
            $fecha = date("y-m-d");//fecha actual
            $bodeguero = $_SESSION['idBodeguero'];
            $obrero = $_SESSION['idObrero'];
   
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
            $consulta = "INSERT INTO prestamo (fec_pre, fk_bodeguero, fk_obrero)
            VALUES(?,?,?)";
        
            //validar consulta
            $resultado = mysqli_prepare($conexion, $consulta);
            
            //acceder a resultados
            //si la variable guarda resultados
            
            if(!$resultado) {
                echo "Error: " . mysqli_error($conexion);   
            }
            
            //prepara sentencia
            $ok = mysqli_stmt_bind_param($resultado, "sii", $fecha, $bodeguero, $obrero);
            $ok = mysqli_stmt_execute($resultado);
            
            //validar variable ok
            if($ok == false){
                echo "Error:";
                
            }else{
                //si se ingresa correctamente
                //guardar id prestamo
                $consulta2 = "SELECT max(id_pre) as 'idMax' FROM prestamo";
                $resultado2 = mysqli_query($conexion, $consulta2);
                
                //guardar ID prestamo (el ultimo, es decir el maximo) en variable global
                $dato = mysqli_fetch_array($resultado2);
                $_SESSION['idPrestamo']=$dato['idMax'];
    
                header('location: moduloPrestamo.php');
            }

            //cerrar conexion
            mysqli_close($conexion);
            
        ?>
    </body>
</html>