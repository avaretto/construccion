<html>
    <head>
        <script src="js/javascript.js"></script>
        <link href="css/estilo.css"
              type="text/css" rel="stylesheet">
    </head>
    
    <body>
        <header>
            <?php
                session_start();
                error_reporting(0);
                $_SESSION['idBodeguero'];
                $_SESSION['idObrero'];
                $_SESSION['nomMaterial'];
                $_SESSION['opcVolver']=2;
                $_SESSION['opcActualizar']=2;
            
                //echo $_SESSION['idBodeguero'];    //mensaje
                //echo $_SESSION['idObrero'];       //mensaje
                //echo " opc= ";                    //mensaje
                //echo $_SESSION['opcVolver'];      //mensaje  
            ?>
        <h3>Búsqueda de Material</h3>
        <button> <a href="#" onclick="clicVolverModuloMaterial();">Volver</a> </button>
        </header>
        
        <?php
           //crear if para detectar si "nom" esta vacio o con datos
            if($_GET['nom'] == null){
                //echo "id desde nomMaterial";
                //echo 
                $nombre = $_SESSION['nomMaterial'];
            }else{
                //echo "id desde GET";
                //echo 
                $nombre = $_GET['nom'];
                $_SESSION['nomMaterial']=$nombre; // guarda "nomMaterial" actual en variable global
            }
            echo "Resultados para ";
            echo $_SESSION['nomMaterial'];
            echo ": ";

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
            $consulta = "SELECT * FROM material WHERE nom_mat like '%$nombre%'";
            $resultado = mysqli_query($conexion, $consulta);
        
            //acceder a resultados
            //validar resultado, redirije según resultado
            if(mysqli_num_rows($resultado) > 0){
            
        ?>
                <!--encabezados de tabla hechos con html-->
        
                <form class ="tablaContenedor5Columnas" action="actualizarMaterial.php">
                    <div class="tablaTitulo5Columnas">Material encontrado</div>
                    <div class="tablaHeader">ID</div>
                    <div class="tablaHeader">Nombre</div>
                    <div class="tablaHeader">Stock</div>
                    <div class="tablaHeader">Fk_tipo</div>
                    <div class="tablaHeader">Opciones</div>
                
        <?php
          
                //se muestra de forma asociativa
                while($fila = mysqli_fetch_array($resultado, MYSQLI_ASSOC)){ 
        ?>
                <!--items de tabla hechos con html y php-->
                    <div class="tablaItem"> <?php echo $fila['id_mat'];   ?> </div>
                    <div class="tablaItem"> <?php echo $fila['nom_mat'];   ?></div>
                    <input class="tablaItem" type="text" value="<?php echo $fila['stock_mat']?>" name="stock">
                    <div class="tablaItem"> <?php echo $fila['fk_tipo'];   ?></div>
                    
                    <div class="tablaItem">
                        <!--manda id de material-->
                        <input type="submit" value="Actualizar">
                        <!--
                        <button> <a href="actualizarMaterial.php?id=<?php echo $fila['id_mat'];?>">Actualizar </a> </button>
                        -->
                        
                        <button> <a href="eliminarMaterial.php?id=<?php echo $fila['id_mat'];?>">Eliminar </a> </button>
                    </div>         
        <?php 
                } 
        ?>
                </form>
        <?php
            }
            else{
                echo " No se encuentra el material";
            }
        
            //cerrar conexion
            mysqli_close($conexion);     
        ?>
    </body>
</html>