<html>
    <head>
        <script src="js/javascript.js"></script>
        <link href="css/estilo.css"
              type="text/css" rel="stylesheet">
    </head>
    
    <body>
        <header>
        <?php
            error_reporting(0);
            session_start();
            $_SESSION['idBodeguero'];
            $_SESSION['idObrero'];
            $_SESSION['idPrestamo'];
            //echo $_SESSION['idBodeguero'];//mensaje
            //echo $_SESSION['idObrero'];  //mensaje
            //echo $_GET['id'];
            //echo $_SESSION['idPrestamo'];
        
            //variable capturada desde el archivo "listadoPrestamos.php"
            //crear if para detectar si "id" esta vacio o con datos
            if($_GET['id'] == null){
                //echo "id desde idPrestamo";
                //echo 
                $prestamo = $_SESSION['idPrestamo'];
            }else{
                //echo "id desde GET";
                //echo 
                $prestamo = $_GET['id'];
                $_SESSION['idPrestamo']=$prestamo; // guarda id prestamo actual en variable global
            }
            //$prestamo = $_GET['id'];
            //$_SESSION['idPrestamo']=$prestamo;
            //echo $prestamo;//mensaje
            //echo $_SESSION['idPrestamo']; //mensaje
        ?>
            
            <h3>Detalle del préstamo Número <?php echo $_SESSION['idPrestamo'];?> </h3> 
            <button> <a href="listadoPrestamos.php" >Volver a préstamos</a> </button>
        </header>
        
        <?php
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
                //echo "conexion establecida<br>";
            }
        
            //validar existencia de la base de datos
            mysqli_select_db($conexion, $db_nombre) or die("No se encuentra la base de datos<br>");
            //establecer codificacion
            mysqli_set_charset($conexion, 'utf8');
        
            //generar consultas
            $consulta = "SELECT * FROM det_prestamo WHERE fk_prestamo = '$prestamo'";
            $resultado = mysqli_query($conexion, $consulta);
        
            //acceder a resultados
            /*if($fila = mysqli_num_rows($resultado) > 0) {*/
                
        ?>
                <!------------------------Buscar Herramienta------------>
                <div class="formulario">
                    <fieldset>
                    <legend><strong>Buscar Herramienta</strong></legend>
                    
                        <!--formulario de Buscar Herramienta-->
                        <form action="buscarHerramienta.php" method="get">
                            <input type="text" name="nomHer" placeholder="nombre herramienta" required>
                            <!--manda nombre de la Herramienta al archivo "buscarHerramienta.php"-->
                            <input class="boton" type="submit" name="envio" value="Buscar">
                        </form>
                    </fieldset>
                </div>
                
        
                <!--encabezados de tabla hechos con html-->
                
                <div class ="tablaContenedor5Columnas">
                    <div class="tablaTitulo5Columnas">Detalle préstamo</div>
                    <div class="tablaHeader">ID_detalle</div>
                    <div class="tablaHeader">ID_prestamo</div>
                    <div class="tablaHeader">herramienta</div>
                    <div class="tablaHeader">cantidad</div>
                    <div class="tablaHeader">Opciones</div>
        <?php
                //se muestra de forma asosiativa
                while($fila = mysqli_fetch_array($resultado, MYSQLI_ASSOC)){
        ?>          
                <!--items de tabla hechos con html y php-->    
                    <div class="tablaItem"> <?php echo $fila['id_det'];?></div>
                    <div class="tablaItem"> <?php echo $fila['fk_prestamo'];?></div>
                    <div class="tablaItem"> <?php echo $fila['fk_herramienta'];?></div>
                    <div class="tablaItem"> <?php echo $fila['cant_herramienta'];?></div>
     
                    <div class="tablaItem"> 
                        <!--envía id detalle préstamo al archivo "eliminarDetPrestamo.php"-->  
                        <button> <a href="eliminarDetPrestamo.php?id=<?php echo $fila['id_det'];?>">Eliminar </a> </button>
                    </div>
        <?php
                }
        ?>
                </div>
        <?php    
           /* }*/
        /*
            else{
                
                //***crear metodo para eliminar un prestamo cuando no tenga ningun detalle
                
                //consulta
                $consulta2 = "DELETE FROM prestamo
                            WHERE id_pre ='$prestamo'";
                //validar consulta
                $resultado2 = mysqli_query($conexion, $consulta2);
                
                echo " No existen detalles del préstamo por lo tanto se eliminó el préstamo";
                
                echo " el préstamo no tiene detalles, se eliminará al cerrar session";
            }
        */
            //cerrar conexion
            mysqli_close($conexion);
            
        ?>
    </body>
</html>