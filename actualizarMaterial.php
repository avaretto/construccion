<html>
    <head>
        <script src="js/javascript.js"></script>
        <link href="css/estilo.css" type="text/css" rel="stylesheet">
    </head>
    
    <body>
        <header>
            <?php 
                session_start();
                $_SESSION['idBodeguero'];
                $_SESSION['opcActualizar'];
                $_SESSION['idMaterial'];
                $opcActualizar = $_SESSION['opcActualizar'];
  
                //captura id de material a actualizar
                $material = $_SESSION['idMaterial'];
                
                $stock = $_GET['stock'];
                /*  
                echo $opcActualizar;
                echo "<br>";    
                echo $_SESSION['idBodeguero']; //mensaje
                echo "<br>";
                echo $material; //mensaje
                echo "<br>";
                echo $stock; //mensaje
                */
            ?>
            
            <h3>Actualizar Material</h3>
            <button> <a href="#" onclick="clicVerMaterial();">Volver</a> </button>
        </header>
        
        <main>
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
            //1.Mostrar material a actualizar
            $consulta1 = "SELECT * FROM material WHERE id_mat = '$material'";
            
            //consulta para Actualizar stock material
            
            
            $consulta2 = "UPDATE material SET stock_mat = '$stock' 
                        WHERE id_mat = '$material'";
            
            $resultado2 = mysqli_query($conexion, $consulta2);
            
            
            
            //redirije según opcActualizar
            if($opcActualizar == 1){
                header('location: listadoMaterial.php');
            }
            if($opcActualizar ==2){
                header('location: buscarMaterialM.php');
            }
            
            //header('location: listadoMaterial.php');
                
        ?>
        </main>
        
        <footer>
        </footer>
    </body>
    
    <footer>
    </footer>

</html>
