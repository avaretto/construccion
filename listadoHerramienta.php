<html>
    <head>
        <script src="js/javascript.js"></script>
        <link href="css/estilo.css"
              type="text/css" rel="stylesheet">
        <?php
            session_start();
            $_SESSION['idBodeguero'];
            $_SESSION['idObrero'];
            $_SESSION['opcVolver']=1;
            
            //echo $_SESSION['idBodeguero']; //mensaje
            //echo $_SESSION['idObrero'];   //mensaje
            //echo " opc= ";
            //echo $_SESSION['opcVolver'];
            //captura "nombre" de la busqueda
            //if()***
            //$txtNombreHerramienta =_GET['nom'];
        ?>
    </head>
    
    <body>
        <header>
            <h3>Herramientas</h3>
            <button> <a href="#" onclick="clicVolverModuloHerramienta();">Volver</a> </button>
        
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
            //consulta para ver todos las herramientas
            $consulta = 'SELECT * FROM herramienta';
            $resultado = mysqli_query($conexion, $consulta);
        
            //acceder a resultados
            //registros de todas las herramientas
            if($fila = mysqli_num_rows($resultado) > 0) {
                
        ?>
                <!--encabezados de tabla hechos con html-->
                
                <div class ="tablaContenedor5Columnas">
                    <div class="tablaTitulo5Columnas">Lista de Herramientas</div>
                    <div class="tablaHeader">ID</div>
                    <div class="tablaHeader">Nombre</div>
                    <div class="tablaHeader">Stock</div>
                    <div class="tablaHeader">Tipo Herramienta</div>
                    <div class="tablaHeader">Opciones</div>
        <?php
                //se muestra de forma asosiativa
                while($fila = mysqli_fetch_array($resultado, MYSQLI_ASSOC)){
        ?>          
                <!--items de tabla hechos con html y php-->    
                    <div class="tablaItem"> <?php echo $fila['id_her'];?></div>
                    <div class="tablaItem"> <?php echo $fila['nom_her'];?></div>
                    <div class="tablaItem"> <?php echo $fila['stock_her'];?></div>
                    <div class="tablaItem"> <?php echo $fila['fk_tipo'];?></div>
                    
                    <div class="tablaItem">
                        <!--manda id de herramienta-->
                        <button> <a href="eliminarHerramienta.php?id=<?php echo $fila['id_her'];?>">Eliminar </a> </button>
                    </div>         
                    <!--
                    <?php //$_SESSION['idHerramienta']=$fila['id_her'];?>
                    <button> <a href="eliminarHerramienta.php">Eliminar</a></button>
                    -->
        <?php
                }
        ?>
                </div>
        <?php
            }else{
                echo "No existen registros";
            }
            /*
            //sin registros de herramientas
            if($fila = mysqli_num_rows($resultado) <= 0) {
                echo "No existen registros";    
            }
            */

            //cerrar conexion
            mysqli_close($conexion);
            
        ?>
    </body>
</html>