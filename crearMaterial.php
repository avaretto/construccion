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
            $_SESSION['idBodeguero'];
            $_SESSION['idMaterial'];
        
            //valores solicitados
            $nom = $_GET['nom'];
            $stock = $_GET['stock'];
            $tipo = $_GET['tipo'];
   
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
            $consulta = "INSERT INTO material (nom_mat, stock_mat, fk_tipo)
            VALUES(?,?,?)";
        
            //validar consulta
            $resultado = mysqli_prepare($conexion, $consulta);
            
            //acceder a resultados
            //si la variable guarda resultados
            
            if(!$resultado) {
                echo "Error: " . mysqli_error($conexion);   
            }
            
            //prepara sentencia
            $ok = mysqli_stmt_bind_param($resultado, "sii", $nom, $stock, $tipo);
            $ok = mysqli_stmt_execute($resultado);
            
            //validar variable ok
            if($ok == false){
                echo "Error:";
                
            }else{
                //si se ingresa correctamente
                echo "<script>alert('Material creado correctamente'); 
                window.location.assign('moduloMaterial.php'); </script>";
                //header('location: moduloMaterial.php');
            }

            //cerrar conexion
            mysqli_close($conexion);
            
        ?>
    </body>
</html>