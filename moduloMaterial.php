<html>
    <head>
        <link href="css/estilo.css"
              type="text/css" rel="stylesheet">
        <script src="js/javascript.js"></script>
        <meta charset = "utf-8">
    </head>
    <body>
        
        <header>
            <?php
                session_start();
                $_SESSION['idBodeguero'];
            
                //echo $_SESSION['idBodeguero'];// mensaje
            
                //validar que se encuentre una SESSION abierta por seguridad
                if($_SESSION['idBodeguero'] == null || $_SESSION['idBodeguero'] =='' || $_SESSION['idBodeguero']==0) {
                    echo 'Debe iniciar sesión';
                    die();
                } 
            ?>
            
            <h3>Módulo de Materiales</h3>
            <!-----------menú Materiales-------------->
            <nav id="menuMaterial">
                <button> <a href="#" onclick="clicVolverModuloBodeguero();">Volver</a> </button>
                
                <button> <a href="#" onclick="clicBuscarMaterialM();">Buscar Material</a> </button>
                
                <button> <a href="#" onclick="clicCrearMaterial();">Crear Material</a> </button>
                
                <button> <a href="#" onclick="clicVerMaterial();">Ver Materiales</a> </button>
                
            </nav>
         
        </header>
        
        <main>
            <!------------------------Buscar Material----------->
            <div class="formulario" id="buscarMaterial">
                <fieldset>
                    <legend><strong>Buscar Material</strong></legend>
                    
                    <!--formulario buscar Material-->
                    <form action="buscarMaterialM.php">
                        <input type="text" name="nom" placeholder="Ingrese nombre a buscar" required>
                        <br>
                        <!--manda nombre a buscar-->
                        <input class="boton" type="submit" name="envio" value="Buscar">
                    </form>
                </fieldset>
            </div>
            <!------------------------Crear Material------------> 
            <div class="formulario" id="crearMaterial">
                <fieldset>
                    <legend><strong>Crear Material</strong></legend>
                    
                    <!--formulario crear Material-->
                    <form action="crearMaterial.php" method="get">
                        Nombre:
                        <!--manda id de tipo Material-->
                        <input type="text" name="nom" placeholder="Ingrese nombre Material" required>
                        <br>
                        Cantidad:
                        <input type="text" name="stock" placeholder="Ingrese cantidad" required>
                        <br>
                        
                        <!--***Cargar tipos de Material en drop down list-->
                        <!--DROP DOWN LIST tipos Material-->
                        Tipo:
                        <label> <select name="tipo">
                            
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
                            //consulta
                            $consulta = 'SELECT * FROM tipo_material';
                            $resultado = mysqli_query($conexion, $consulta);
                        ?>
                            
                        <?php
                            foreach($resultado as $tipo):
                        ?>          
                                    <!--manda id de tipo Material-->
                                    <option value="<?php echo $tipo['id_tip']?>"><?php echo $tipo['nom_tip']?></option>
                        <?php
                            endforeach
                        ?>
                                </select>
                            
                        </label>
                        <br>
                        <!--Manda datos a "crearMaterial.php"-->
                        <input class="boton" type="submit" name="envio" value="Crear">
                    </form>
                </fieldset>
            </div>
        
        </main>
        
        <footer>
        </footer>
    </body>
</html>