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
                $_SESSION['nomMaterial'];
                $_SESSION['idMaterial'];

                //variable capturada desde archivo "moduloEntrega.php"
         
                //crear if para detectar si "nom" esta vacio o con datos
                if($_GET['nomMat'] == null){
                    //echo "id desde nomMat";
                    $nombre = $_SESSION['nomMaterial'];
                }else{
                    //echo "id desde GET";
                    $nombre = $_GET['nomMat'];
                    $_SESSION['nomMaterial']=$nombre; // guarda nombre de material actual en variable global
                }
            
                //echo $_SESSION['nomMaterial'];
                //echo $_SESSION['idBodeguero'];
                //echo $_SESSION['idObrero'];
                //echo $_SESSION['nomMaterial'];
                //echo $_SESSION['idMaterial']=$_GET['id'];
            
            ?>
            
            <h3>Búsqueda de Material</h3>
            <button> <a href="#" onclick="clicVolverListadoDetEntrega();">Volver</a> </button>
        </header>
        <main>
            <div id="actualizarStockMat" class="ventana">
                <div id="cerrar"> <a href="#" onclick="clicCerrar();"> <img src="imagenes/cerrar02.png"
                                           height="20px" width="20px"> </a> </div>
                <h4>Actualizar stock de material:</h4>
                <form action="agregarMaterial.php">
                    Cantidad:
                    <br>
                    <input type="text" name="cant" required>
                    <input type="submit" name="enviar" value="Aceptar">
                </form>
            </div>
        
        <?php
            //validar que exista en ID de material
            
            if($_SESSION['idMaterial'] == null){
                echo "id vacio";
                
            }else{
                //si existe id, desplegar div de actualizar stock
                echo "id existente";
        ?>     
                <script>
                    document.getElementById("actualizarStockMat").style.display="block";
                </script>
         <?php   
            }
            
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
            $consulta = "SELECT * FROM material WHERE nom_mat LIKE '%$nombre%' and stock_mat > 0";
        
            $resultado = mysqli_query($conexion, $consulta);
        
            //acceder a resultados
            //validar resultado, redirije según resultado
            if(mysqli_num_rows($resultado) > 0){
            
        ?>
                <!--encabezados de tabla hechos con html-->
        
                <div class ="tablaContenedor5Columnas">
                    <div class="tablaTitulo5Columnas">Materiales encontrados</div>
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
                    <div class="tablaItem"> <?php echo $fila['stock_mat']; ?></div>
                    <div class="tablaItem"> <?php echo $fila['fk_tipo'];   ?></div>
                    
                    <!--manda id material al archivo "agregarMaterial"-->
                    <button> <a href="buscarMaterial.php?id=<?php echo $fila['id_mat'];?> " >Agregar</a> </button>
        <?php 
                } 
        ?>
                </div>
        <?php
            }
            else{
                echo "No se encuentra el material";
                //header('location: moduloMaterial.php');
            }
        
            //cerrar conexion
            mysqli_close($conexion);
            
        ?>
        </main>
    </body>
</html>