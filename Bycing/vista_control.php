<?php
header("Content-Type: text/html;charset=utf-8");

/*OPCIONS DE VISTES*/
$opcio = $_POST["opcio"];

switch ($opcio) {
    case 'registre':
        include_once("vista/registreUsuari.html");
        break;
    case 'baixa-usuari':
        include_once("vista/baixaUsuari.html");
         # code...
         break; 
    
    case 'agafar-bici':
        include_once("vista/agafarBici.html");
        break;

    case 'tornar-bici':
        include_once("vista/tornarBici.html");
        break;
    
    default:
        # code...
        break;
}

function mostraResultat($error){
    $missatge = "";
    switch($error){
        case 2:
        //usuari inserit
            $missatge = "S'ha inserit correctament al usuari";
            break;

        case 3:
            $missatge = "Ciutadà eliminat correctament";
            break;

        case 4:
            $missatge = "S'ha agafat la bici correctament";
            break;

        case -1:
        //conexio DB dolenta
            $missatge = "No s'ha pogut connectar a la BD...";
            break;
        
        case -2:
        //usuari registrat
            $missatge = "L'usuari ja está registrat";
            break;
        
        case -3:
        //contra erronia
            $missatge = "Les contrassenyes no coincideixen...";
            break;

        case -4:
        //usuari no existeix
            $missatge = "L'usuari no está registrat...";
            break;
        case -5:
        //ja te bici
            $missatge  ="L'usuari ja te una bicicleta";
            break;
        
    }
    if($error < 0){
        mostrarError($missatge);
    }else{
        mostrarExit($missatge);
    }
    

}

function mostrarError($text){
    echo("<h1 style='color:red;'>".$text."</h1>");
    //header( "refresh:5;url=index.html" );
}

function mostrarExit($text){
    echo("<h1 style='color:green;'>".$text."</h1>");
    //header( "refresh:5;url=index.html" );
}



/* /OPCIONS DE VISTES*/


?>