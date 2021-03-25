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
                $_SESSION['idObrero'];
                $_SESSION['idPrestamo']=0;
            
                //echo $_SESSION['idBodeguero'];
                //echo $_SESSION['idObrero'];
                //echo $_SESSION['idPrestamo'];
            
                $obrero = $_SESSION['idObrero'];
                
                //validar que se encuentre una SESSION abierta
                if($_SESSION['idObrero'] == null || $_SESSION['idObrero'] =='' || $_SESSION['idObrero']==0) {
                    echo 'Debe iniciar sesión y buscar obrero';
                    die();
                }
            ?>
            
            <h3>Módulo de Obrero</h3> 
            <!-----------menú obrero-------------->
            <nav id="menuObrero">
                <button> <a href="#" onclick="clicVolverModuloBodeguero();">Volver</a> </button>
                
                <button> <a href="#" onclick="clicVerDatosObrero();">Ver datos Obrero</a> </button>
                
                <button> <a href="agregarPrestamo.php?" >Agregar préstamo</a> </button>
                
                <!--
                <button> <a href="#" onclick="clicCrearEntrega();">Agregar entrega material</a> </button>
                -->
                <button> <a href="#" onclick="clicVerPrestamo();">Ver préstamos</a> </button>
            </nav>
         
        </header>
        
        <main>
            <!--***mostrar datos de obrero-->
            <div id="verObrero">
                <fieldset>
                    <legend><strong>Datos Obrero</strong></legend>
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
                        $consulta = "SELECT * FROM obrero WHERE id_obr = '$obrero'";
                        /*
                        $consulta = "SELECT id_obr, rut_obr, nom_obr, ape_obr, fk_direccion 
                        FROM obrero 
                        WHERE id_obr = $obrero'";
                        */
                        $resultado = mysqli_query($conexion, $consulta);
                    
                        //acceder a resultados
            //muestra datos del obrero
            if($fila = mysqli_num_rows($resultado) > 0) {
                
        ?>
                <!--encabezados de tabla hechos con html-->
                
                <div class ="tablaContenedor4Columnas">
                    <div class="tablaTitulo4Columnas">Datos obrero</div>
                    <div class="tablaHeader">ID</div>
                    <div class="tablaHeader">Rut</div>
                    <div class="tablaHeader">Nombre</div>
                    <div class="tablaHeader">Apellido</div>
                    
        <?php
                //se muestra de forma asosiativa
                while($fila = mysqli_fetch_array($resultado, MYSQLI_ASSOC)){
        ?>          
                <!--items de tabla hechos con html y php-->    
                    <div class="tablaItem"> <?php echo $fila['id_obr'];?></div>
                    <div class="tablaItem"> <?php echo $fila['rut_obr'];?></div>
                    <div class="tablaItem"> <?php echo $fila['nom_obr'];?></div>
                    <div class="tablaItem"> <?php echo $fila['ape_obr'];?></div>
        <?php
                }
        ?>
                </div>
        <?php
            }
                    ?>
                </fieldset>
            </div>
        </main>
        
        <footer>
        </footer>
    </body>
</html>