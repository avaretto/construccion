<html>
    <head>
        <style>
            table{
                width: 100%;
                border: 1px solid red;
                margin: auto;
            }
        </style>
    </head>
    
    <body>
        
        <?php
            session_start();
            session_destroy();
            error_reporting(0);
            header("Location:index.php");
        ?>
    </body>
</html>