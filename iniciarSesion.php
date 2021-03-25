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
            //error_reporting(0);
            //abre SESSION de obrero y bodeguero para manejar la seguridad de las ventanas
            session_start();
            $_SESSION['idBodeguero'] = 0; //se inicia en 0 por default que significa que no se puede ingresar
            $_SESSION['idObrero'] = 0; //se inicia en 0 por default que significa que no se puede ingresar
            $_SESSION['nomBodeguero']="";
            
            //datos de conexion, llama al archivo con datos de la bd
            require ("dbConstruccion.php");
        
            //variables capturadas desde "index.php" para iniciar sesion
            $txtBusquedaRut = $_POST["rut"];
            $txtBusquedaPw = $_POST["pw"];
        
            //establecer conexion a servidor
            $conexion = mysqli_connect($db_host, $db_user, $db_pass);
            if(mysqli_connect_errno()) {
                //notifica algo en caso de error
                echo "fallo de conexion<br>";
                //salir para liberar conexion
                exit();
            }else{
                //echo "conexion establecida<br>";
            }
        
            //validar existencia de la base de datos
            mysqli_select_db($conexion, $db_nombre) or die("No se encuentra la base de datos<br>");
            //establecer codificacion
            mysqli_set_charset($conexion, 'utf8');
        
            //generar consultas
            //busca cuenta en la BD
            $consulta1 = "SELECT id_bod FROM bodeguero WHERE rut_bod = '$txtBusquedaRut' and pw_bod  = '$txtBusquedaPw'";
            $resultado1 = mysqli_query($conexion, $consulta1);
        
            //selecciona nombre del bodeguero
            $consulta2 = "SELECT nom_bod FROM bodeguero WHERE rut_bod = '$txtBusquedaRut' and pw_bod  = '$txtBusquedaPw'";
            $resultado2 = mysqli_query($conexion, $consulta2);
        
            //acceder a resultados
            //mientras encuentre el bodeguero en la BD, guarda la ID de bodeguero en variable global
            while($fila = mysqli_fetch_array($resultado1)){
                $_SESSION['idBodeguero'] = $fila['id_bod'];
                
                //guarda nombre de bodeguero en variable global
                if($fila = mysqli_fetch_array($resultado2)){
                   $_SESSION['nomBodeguero'] = $fila['nom_bod'];
                } 
            }
            
            //si encuentra redirije según resultado
        
            if($fila = mysqli_num_rows($resultado1) > 0){
                echo "<script>alert('Se ha ingresado correctamente'); window.location.assign('moduloBodeguero.php'); </script>";
                //header('location: moduloBodeguero.php');
            }else{
                echo "<script>alert('Datos incorrectos, vuelva a intentarlo!'); 
                window.location.assign('index.php'); </script>";
                //header('location: index.php');
            }
            
            //cerrar conexion
            mysqli_close($conexion);
   
        ?>
    </body>
</html>