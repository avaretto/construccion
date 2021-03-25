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
                $_SESSION['idPrestamo'];
                //echo $_SESSION['idBodeguero'];
                //echo $_SESSION['idObrero'];
                //echo $_SESSION['idPrestamo'];
                
                //validar que se encuentre una SESSION abierta
                if($_SESSION['idPrestamo'] == null || $_SESSION['idPrestamo'] =='' || $_SESSION['idPrestamo']==0) {
                    echo 'Debe agregar un préstamo';
                    die();
                }
                else{
                    
                }
            ?>
            <h3>Módulo de Préstamos</h3>
            Préstamo Número <?php echo $_SESSION['idPrestamo']; ?> Agregado, busque una herramienta para agregar
            
            <!-----------menú préstamos-------------->
            <nav id="menuPrestamo">
                <button> <a href="#" onclick="clicVolverModuloObrero();">Volver</a> </button>
                <button> <a href="#" onclick="clicBuscarHerramienta();">Buscar Herramienta</a> </button>
            </nav> 
        </header>
        
        <main>   
            <!------------------------Buscar Herramienta------------> 
            <div id="buscarHerramienta">
                <fieldset>
                    <legend>Buscar Herramienta</legend>
                    
                    <!--formulario de Buscar Herramienta-->
                    <form action="buscarHerramienta.php" method="get">
                        <input type="text" name="nomHer" placeholder="nombre herramienta">
                        <!--manda nombre de la Herramienta al archivo "buscarHerramienta.php"-->
                        <input type="submit" name="envio" value="Buscar">
                    </form>
                </fieldset>
            </div>           
        </main>
        
        <footer>
        </footer>
    </body>
</html>