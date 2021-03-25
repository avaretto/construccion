function clicIniciarSesion(){
    //alert("clic menu");
    document.getElementById("iniciarSesion").style.display="block";
}

/*-----------------------------módulo bodeguero----------------------*/
function clicCerrarSesion(){
    //alert("clic menu");
    window.location.assign("cerrarSesion.php");
}
function clicBuscarObrero(){
    //alert("clic menu");
    document.getElementById("buscarObrero").style.display="block";  
}
function clicVerPrestamos(){
    //alert("clic menu");
    window.location.assign("listadoPrestamos.php");  
}
function clicModuloHerramienta(){
    //alert("clic menu");
    window.location.assign("moduloHerramienta.php");  
}
function clicModuloMaterial(){
    //alert("clic menu");
    window.location.assign("moduloMaterial.php");  
}

/*-------------------------------------------------------------------*/



/*-----------------------------módulo Obrero-------------------------*/
function clicVolverModuloBodeguero(){
    //alert("clic menu");
    //redirije a eliminar préstamos sin detalles
    window.location.assign("eliminarPrestamoVacio.php");
    //window.location.assign("moduloBodeguero.php");   
}
function clicVerDatosObrero(){
    //alert("clic menu");
    document.getElementById("verObrero").style.display="block";
    document.getElementById("buscarHerramienta").style.display="none";
}
function clicVerPrestamo(){
    //alert("clic menu");
    window.location.assign("listadoPrestamos.php");
}

/*-----------------------------módulo Préstamos-------------------------*/
function clicVolverModuloObrero(){
    //alert("clic menu");
    window.location.assign("moduloObrero.php");  
}
function clicVolverListadoDetPrestamo(){
    //alert("clic menu");
    window.location.assign("listadoDetPrestamo.php");  
}
function clicBuscarHerramienta(){
    //alert("clic menu");
    window.location.assign("listadoDetPrestamo.php");
}
function clicAgregarHerramienta(){
    //alert("clic menu");
}
function clicCrearEntrega(){
    //alert("clic menu");
    document.getElementById("crearPrestamo").style.display="none";  
    document.getElementById("crearEntrega").style.display="block";  
}

/*-----------------------------módulo Herramienta-------------------------*/
function clicVolverModuloHerramienta(){
    //alert("clic menu");
    window.location.assign("moduloHerramienta.php");  
}
function clicBuscarHerramientaM(){
    //alert("clic menu");
    document.getElementById("buscarHerramienta").style.display="block";
    document.getElementById("crearHerramienta").style.display="none"; 
}
function clicCrearHerramienta(){
    //alert("clic menu");
    document.getElementById("crearHerramienta").style.display="block";  
    document.getElementById("buscarHerramienta").style.display="none";
}
function clicVerHerramienta(){
    //alert("clic menu");
    window.location.assign("listadoHerramienta.php");   
}

/*-----------------------------módulo Material-------------------------*/
function clicVolverModuloMaterial(){
    //alert("clic menu");
    window.location.assign("moduloMaterial.php");  
}
function clicBuscarMaterialM(){
    //alert("clic menu");
    document.getElementById("buscarMaterial").style.display="block";
    document.getElementById("crearMaterial").style.display="none"; 
}
function clicCrearMaterial(){
    //alert("clic menu");
    document.getElementById("crearMaterial").style.display="block";
    document.getElementById("buscarMaterial").style.display="none"; 
}
function clicVerMaterial(){
    //alert("clic menu");
    window.location.assign("listadoMaterial.php");   
}