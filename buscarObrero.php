<html>
    <head>
        <style>
            table{
                width: 100%;
                border: 1px solid red;
                margin: auto;
            }
        </style>
    </head>
    
    <body>
        
        <?php
            //crea SESSION
            session_start();
            $_SESSION['idObrero'] = 0;
            
            //datos de conexion, llama al archivo con datos de la bd
            require ("dbConstruccion.php");
        
            //variable capturada desde "moduloBodeguero.php" para buscar obrero
            $txtBusquedaRut = $_GET["rut"];
        
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
            $consulta = "SELECT * FROM obrero WHERE rut_obr = '$txtBusquedaRut'";
            $resultado = mysqli_query($conexion, $consulta);
        
            //acceder a resultados
            //guarda la ID de Obrero en variable global
            while($fila = mysqli_fetch_array($resultado)){
                $_SESSION['idObrero'] = $fila['id_obr'];
               //header('location: moduloObrero.php');
            }
            
            //validar resultado, redirije según resultado
            if($fila = mysqli_num_rows($resultado) > 0){
                echo "<script>alert('Obrero encontrado correctamente'); window.location.assign('moduloObrero.php'); </script>";
                //header('location: moduloObrero.php');
            }else{
                echo "<script>alert('Obrero NO encontrado, vuelva a intentarlo!'); window.location.assign('moduloBodeguero.php'); </script>";
                //header('location: moduloBodeguero.php');
            }
            
            //cerrar conexion
            mysqli_close($conexion);
            
        ?>
    </body>
</html>