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
            $_SESSION['idEntrega'];
            //echo $_SESSION['idBodeguero'];//mensaje
            //echo $_SESSION['idObrero'];  //mensaje
            //echo $_GET['id'];
            //echo $_SESSION['idEntrega'];
        
            //variable capturada desde el archivo "listadoEntrega.php"
            //crear if para detectar si "id" esta vacio o con datos
            if($_GET['id'] == null){
                //echo "id desde idEntrega";
                //echo 
                $entrega = $_SESSION['idEntrega'];
            }else{
                //echo "id desde GET";
                //echo 
                $entrega = $_GET['id'];
                $_SESSION['idEntrega']=$entrega; // guarda id entrega actual en variable global
            }
            //$entrega = $_GET['id'];
            //$_SESSION['idEntrega']=$entrega;
            //echo $entrega;//mensaje
            //echo $_SESSION['idEntrega']; //mensaje
        ?>
            
            <h3>Detalle de la entrega Número <?php echo $_SESSION['idEntrega'];?> </h3> 
            <button> <a href="listadoEntrega.php" >Volver a entregas</a> </button>
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
            $consulta = "SELECT * FROM det_entrega WHERE fk_entrega = '$entrega'";
            $resultado = mysqli_query($conexion, $consulta);
        
            //acceder a resultados
            /*if($fila = mysqli_num_rows($resultado) > 0) {*/
                
        ?>
                <!------------------------Buscar Material------------>
                <div class="formulario">
                    <fieldset>
                    <legend><strong>Buscar Material</strong></legend>
                    
                        <!--formulario de Buscar Material-->
                        <form action="buscarMaterial.php" method="get">
                            <input type="text" name="nomMat" placeholder="nombre material" required>
                            <!--manda nombre del material al archivo "buscarMaterial.php"-->
                            <input class="boton" type="submit" name="envio" value="Buscar">
                        </form>
                    </fieldset>
                </div>
                
        
                <!--encabezados de tabla hechos con html-->
                
                <div class ="tablaContenedor5Columnas">
                    <div class="tablaTitulo5Columnas">Detalle entrega</div>
                    <div class="tablaHeader">ID_detalle</div>
                    <div class="tablaHeader">ID_entrega</div>
                    <div class="tablaHeader">material</div>
                    <div class="tablaHeader">cantidad</div>
                    <div class="tablaHeader">Opciones</div>
        <?php
                //se muestra de forma asosiativa
                while($fila = mysqli_fetch_array($resultado, MYSQLI_ASSOC)){
        ?>          
                <!--items de tabla hechos con html y php-->    
                    <div class="tablaItem"> <?php echo $fila['id_det'];?></div>
                    <div class="tablaItem"> <?php echo $fila['fk_entrega'];?></div>
                    <div class="tablaItem"> <?php echo $fila['fk_material'];?></div>
                    <div class="tablaItem"> <?php echo $fila['cant_material'];?></div>
     
                    <div class="tablaItem"> 
                        <!--envía id detalle entrega al archivo "eliminarDetEntrega.php"-->  
                        <button> <a href="eliminarDetEntrega.php?id=<?php echo $fila['id_det'];?>">Eliminar </a> </button>
                    </div>
        <?php
                }
        ?>
                </div>
        <?php    
        
            //cerrar conexion
            mysqli_close($conexion);
            
        ?>
    </body>
</html>