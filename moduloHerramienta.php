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
            
            <h3>Módulo de Herramientas</h3>
            <!-----------menú Herramienta-------------->
            <nav id="menuHerramienta">
                <button> <a href="#" onclick="clicVolverModuloBodeguero();">Volver</a> </button>
                
                <button> <a href="#" onclick="clicBuscarHerramientaM();">Buscar Herramienta</a> </button>
                
                <button> <a href="#" onclick="clicCrearHerramienta();">Crear Herramienta</a> </button>
                
                <button> <a href="#" onclick="clicVerHerramienta();">Ver Herramientas</a> </button>
                
            </nav>
         
        </header>
        
        <main>
            <!------------------------Buscar Herramienta----------->
            <div class="formulario" id="buscarHerramienta">
                <fieldset>
                    <legend><strong>Buscar Herramienta</strong></legend>
                    
                    <!--formulario buscar herramienta-->
                    <form action="buscarHerramientaM.php">
                        <input type="text" name="nom" placeholder="Ingrese nombre a buscar" required>
                        <br>
                        <!--manda nombre a buscar-->
                        <input class="boton" type="submit" name="envio" value="Buscar">
                    </form>
                </fieldset>
            </div>
            <!------------------------Crear Herramienta------------> 
            <div class="formulario" id="crearHerramienta">
                <fieldset>
                    <legend><strong>Crear Herramienta</strong></legend>
                    
                    <!--formulario crear Herramienta-->
                    <form action="crearHerramienta.php" method="get">
                        Nombre:
                        <!--manda id de tipo herramienta-->
                        <input type="text" name="nom" placeholder="Ingrese nombre herramienta" required>
                        <br>
                        
                        <!--***Cargar tipos de herramienta en drop down list-->
                        <!--DROP DOWN LIST tipos herramienta-->
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
                            $consulta = 'SELECT * FROM tipo_herramienta';
                            $resultado = mysqli_query($conexion, $consulta);
                        ?>
                            
                        <?php
                            foreach($resultado as $tipo):
                        ?>          
                                    <!--manda id de tipo herramienta-->
                                    <option value="<?php echo $tipo['id_tip']?>"><?php echo $tipo['nom_tip']?></option>
                        <?php
                            endforeach
                        ?>
                                </select>
                            
                        </label>
                        <br>
                        <!--Manda datos a "crearHerramienta.php"-->
                        <input class="boton" type="submit" name="envio" value="Crear">
                    </form>
                </fieldset>
            </div>
        
        </main>
        
        <footer>
        </footer>
    </body>
</html>