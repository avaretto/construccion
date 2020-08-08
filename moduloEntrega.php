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
                $_SESSION['idEntrega'];
                //echo $_SESSION['idBodeguero'];
                //echo $_SESSION['idObrero'];
                //echo $_SESSION['idEntrega'];
                
                //validar que se encuentre una SESSION abierta
                if($_SESSION['idEntrega'] == null || $_SESSION['idEntrega'] =='' || $_SESSION['idEntrega']==0) {
                    echo 'Debe agregar una entrega de material';
                    die();
                }
                else{
                    
                }
            ?>
            <h3>Módulo de Entrega de material</h3>
            Entrega Número <?php echo $_SESSION['idEntrega']; ?> Agregado, busque un material para agregar
            
            <!-----------menú entrega-------------->
            <nav id="menuEntrega">
                <button> <a href="#" onclick="clicVolverModuloObrero();">Volver</a> </button>
                <button> <a href="#" onclick="clicBuscarMaterial();">Buscar Material</a> </button>
            </nav> 
        </header>
        
        <main>   
            <!------------------------Buscar Material------------> 
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