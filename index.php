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
                //abre SESSION de obrero y bodeguero para manejar la seguridad de las ventanas
                session_start();
                $SESSION['idBodeguero']=0; //se inicia en 0 por default que significa que no se puede ingresar
                $SESSION['idObrero']=0; //se inicia en 0 por default que significa que no se puede ingresar
                //echo $SESSION['idBodeguero']; //mensaje
                //echo $SESSION['idObrero']; //mensaje
            ?>
             <img src="imagenes/logo01v4.png" width="150px" height="50px">
            <h2>Gestor de Herramientas y Materiales</h2>
        </header>
        
        <main>
            <!------------------------Iniciar sesión------------>
            <div class="formulario" id="iniciarSesion">
                <fieldset>
                    <legend><strong>Iniciar Sesión</strong></legend>
                    
                    <!--formulario de inicio sesión-->
                    <form action="iniciarSesion.php" method="post">
                        <input type="text" name="rut" placeholder="Rut" required>
                        <br>
                        <input type="text" name="pw" placeholder="clave" required>
                        <br>
                        <!--Manda rut y clave a "iniciarSesion.php"-->
                        <input class="boton" type="submit" name="enviar" value="Iniciar Sesión">
                    </form>
                </fieldset>
            </div>    
   
        </main>
        
        <footer>
        </footer>
    </body>
</html>