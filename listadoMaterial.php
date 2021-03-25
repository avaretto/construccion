<html>
    <head>
        <script src="js/javascript.js"></script>
        <link href="css/estilo.css"
              type="text/css" rel="stylesheet">
        <?php
            error_reporting(0);
            session_start();
            $_SESSION['idBodeguero'];
            $_SESSION['idObrero'];
            $_SESSION['idMaterial'];
            $_SESSION['stock'];
            $_SESSION['opcVolver']=1;
            $_SESSION['opcActualizar']=1;
            
            
            //echo $_SESSION['idBodeguero']; //mensaje
            //echo $_SESSION['idObrero'];   //mensaje
            //echo " opc= ";
            //echo $_SESSION['opcVolver'];
            //captura "nombre" de la busqueda
            //if()***
            //$txtNombreMaterial =_GET['nom'];
        ?>
    </head>
    
    <body>
        <header>
            <h3>Materiales</h3>
            <button> <a href="#" onclick="clicVolverModuloMaterial();">Volver</a> </button>
        </header>
        
        <main>
            <div class="ventana">
                <h4>Actualizar stock de material:</h4>
            </div>
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
            $consulta = 'SELECT * FROM material';
            $resultado = mysqli_query($conexion, $consulta);
        
            //acceder a resultados
            //registros de todos los materiales
            if($fila = mysqli_num_rows($resultado) > 0) {
                
        ?>
                <!--encabezados de tabla hechos con html-->
                
                <form class ="tablaContenedor5Columnas" action="actualizarMaterial.php">
                    <div class="tablaTitulo5Columnas">Lista de Materiales</div>
                    <div class="tablaHeader">ID</div>
                    <div class="tablaHeader">Nombre</div>
                    <div class="tablaHeader">Stock</div>
                    <div class="tablaHeader">Tipo Material</div>
                    <div class="tablaHeader">Opciones</div>
        <?php
                //se muestra de forma asosiativa
                while($fila = mysqli_fetch_array($resultado, MYSQLI_ASSOC)){
        ?>          
                <!--items de tabla hechos con html y php-->    
                    <div class="tablaItem"> <?php echo $fila['id_mat'];?>
                        <?php $_SESSION['idMaterial'] = $fila['id_mat']; ?>
                    
                    </div>
                    
                    
                    <div class="tablaItem"> <?php echo $fila['nom_mat'];?></div>
                    <input class="tablaItem" type="text" value="<?php echo $fila['stock_mat']?>" name="stock">
                    <div class="tablaItem"> <?php echo $fila['fk_tipo'];?></div>
                    <div class="tablaItem">
                        <!--manda id de material-->
                    <?php ?>
                    <input type="submit" value="Actualizar">
                        <!--
                        <button> <a href="actualizarMaterial.php?id=<?php echo $fila['id_mat'];?>
                            & stock=<?php //echo $fila['stock_mat'];?>
                            ">Actualizar </a> </button>
                        <a href="#" onclick="clicVolverModuloBodeguero();">Volver</a>
                        *-->
                        <button> <a href="eliminarMaterial.php?id=<?php echo $fila['id_mat'];?>">Eliminar </a> </button>
                    </div>         
        <?php
                }
        ?>
                </form>
            
        <?php
            }else{
                echo "No existen registros";
            }
        
            //cerrar conexion
            mysqli_close($conexion);
            
        ?>
        </main>
    </body>
</html>