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
            //echo $_SESSION['idBodeguero']; //mensaje
            //echo $_SESSION['idObrero']; //mensaje
            //echo $_SESSION['idPrestamo']; //mensaje
        
            //validar que se encuentre una SESSION abierta por seguridad
                if($_SESSION['idBodeguero'] == null || $_SESSION['idBodeguero'] =='' || $_SESSION['idBodeguero']==0) {
                    
                    echo 'Debe iniciar sesión';
                    die();
                }
        
            //variable capturada desde el archivo "buscarObrero.php"
            $obrero = $_SESSION['idObrero'];
            
            //redireccion del boton (moduloBodeguero o moduloObrero) guarda opc en variable
            if ($_SESSION['idObrero']==0){
                //echo " boton redirije a modulo bodeguero";
                $modulo = "clicVolverModuloBodeguero();";
            }else{
                //echo " boton redirije a modulo obrero";
                $modulo = "clicVolverModuloObrero();";
            }
        ?>
            <h3>Préstamos</h3>
            <button> <a href="#" onclick="<?php echo $modulo ?>" >Volver</a> </button>
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
            //consulta para ver todos los préstamos
            $consulta = 'SELECT * FROM prestamo';
            $resultado = mysqli_query($conexion, $consulta);
            
            //consulta para ver los préstamos de un usuario en particular
            $consulta2 = "SELECT * FROM prestamo WHERE fk_obrero = '$obrero'";
            $resultado2 = mysqli_query($conexion, $consulta2);
        
            //acceder a resultados
            //sin registros de todos los préstamos
            if($obrero == 0 and $fila = mysqli_num_rows($resultado) <= 0) {
                echo "No existen registros";    
            }
            //registros de todos los préstamos
            if($obrero == 0 and $fila = mysqli_num_rows($resultado) > 0) {
                
        ?>
                <!--encabezados de tabla hechos con html-->
                
                <div class ="tablaContenedor5Columnas">
                    <div class="tablaTitulo5Columnas">Lista de préstamos</div>
                    <div class="tablaHeader">ID</div>
                    <div class="tablaHeader">Fecha</div>
                    <div class="tablaHeader">Bodeguero</div>
                    <div class="tablaHeader">Obrero</div>
                    <div class="tablaHeader">Opciones</div>
        <?php
                //se muestra de forma asosiativa
                while($fila = mysqli_fetch_array($resultado, MYSQLI_ASSOC)){
        ?>          
                <!--items de tabla hechos con html y php-->    
                    <div class="tablaItem"> <?php echo $fila['id_pre'];?></div>
                    <div class="tablaItem"> <?php echo $fila['fec_pre'];?></div>
                    <div class="tablaItem"> <?php echo $fila['fk_bodeguero'];?></div>
                    <div class="tablaItem"> <?php echo $fila['fk_obrero'];?></div>
                  
                    <div class="tablaItem"> 
                        <!--envía id préstamo al archivo "listadoDetPrestamo.php"-->  
                        <button> <a href="listadoDetPrestamo.php?id=<?php echo $fila['id_pre'];?>">Detalle </a> </button>
                    </div>
      
        <?php
                }
        ?>
                </div>
        <?php
            }
            //sin registro de préstamos de obrero
            if($obrero > 0 and $fila = mysqli_num_rows($resultado2) <= 0) {
                echo " No existen préstamos para el obrero";    
            }
            //registros de préstamos de obrero
            if ($obrero > 0 and $fila = mysqli_num_rows($resultado2) > 0){
                
        ?>
                <!--encabezados de tabla hechos con html-->
                
                <div class ="tablaContenedor5Columnas">
                    <div class="tablaTitulo5Columnas">Lista de préstamos</div>
                    <div class="tablaHeader">ID</div>
                    <div class="tablaHeader">Fecha</div>
                    <div class="tablaHeader">Bodeguero</div>
                    <div class="tablaHeader">Obrero</div>
                    <div class="tablaHeader">Opciones</div>
        <?php
                //se muestra de forma asosiativa
                while($fila = mysqli_fetch_array($resultado2, MYSQLI_ASSOC)){
        ?>          
                <!--items de tabla hechos con html y php-->    
                    <div class="tablaItem"> <?php echo $fila['id_pre'];?></div>
                    <div class="tablaItem"> <?php echo $fila['fec_pre'];?></div>
                    <div class="tablaItem"> <?php echo $fila['fk_bodeguero'];?></div>
                    <div class="tablaItem"> <?php echo $fila['fk_obrero'];?></div>
                  
                    <div class="tablaItem"> 
                        <!--envía id préstamo al archivo "listadoDetPrestamo.php"-->  
                        <button> <a href="listadoDetPrestamo.php?id=<?php echo $fila['id_pre'];?>">Detalle </a> </button>
                    </div>
     
                    <!--envía id préstamo al archivo "listadoDetPrestamo" *** cambiar la forma de enviar-->  
                    
                    <!--
                    <button> <a href="listadoDetPrestamo.php?id=<?php //echo $fila['id_pre'];?>">Detalles </a> </button>
                    -->    
        <?php
                }
        ?>
                </div>
        <?php
            }
              
            //cerrar conexion
            mysqli_close($conexion);
            
        ?>
    </body>
</html>