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
            //error_reporting(0);
                session_start();
                $_SESSION['idBodeguero'];
                $_SESSION['nomBodeguero'];
                $_SESSION['idObrero'] = 0; //se inicia en 0 por default que significa que no se puede ingresar
                
                //echo $_SESSION['idBodeguero'];// mensaje
                //echo $_SESSION['idObrero'];// mensaje
            
                //validar que se encuentre una SESSION abierta por seguridad
                if($_SESSION['idBodeguero'] == null || $_SESSION['idBodeguero'] =='' || $_SESSION['idBodeguero']==0) {
                    
                    echo 'Debe iniciar sesión';
                    die();
                }
                
            ?>
            <h3>Módulo de Bodeguero</h3>
            Bienvenido(a): <?php echo $_SESSION['nomBodeguero'];?>
            <!-----------menu bodeguero-------------->
            <nav id="menuBodeguero">
                <button> <a href="#" onclick="clicCerrarSesion();">Cerrar sesión</a> </button>
                
                <button> <a href="#" onclick="clicBuscarObrero();">Buscar obrero</a> </button>
                
                <button> <a href="#" onclick="clicVerPrestamos();">Ver préstamos</a> </button>
                
                <button> <a href="#" onclick="clicModuloHerramienta();">Herramientas</a> </button>
                
                <button> <a href="#" onclick="clicModuloMaterial();">Materiales</a> </button>
            </nav>
         
        </header>
        
        <main>   
            <!------------------------Buscar Obrero------------> 
            <div class="formulario" id="buscarObrero">
                <fieldset>
                    <legend><strong>Buscar Obrero</strong></legend>
                    
                    <!--formulario de búsqueda de Obrero-->
                    <form action="buscarObrero.php" method="get">
                        <input type="text" name="rut" placeholder="Ingrese rut de obrero" required>
                        <br>
                        <!--Manda rut del obrero a "buscarObrero.php"-->
                        <input class="boton" type="submit" name="envio" value="Buscar">
                    </form>
                </fieldset>
            </div>
        
        </main>
        
        <footer>
        </footer>
    </body>
</html>