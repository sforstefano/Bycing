<?php
header("Content-Type: text/html;charset=utf-8");

include_once("control.php");
include_once("vista_control.php");

$opcio = $_POST["opcio"];
$c = new TControl();

switch ($opcio) {
    case 'registre_usuari':

        $nom = $_POST["nom_cognom"];
        $DNI = $_POST["DNI"];
        $direccio = $_POST["direccio"];
        $pass = $_POST["pass"];
        $pass2 = $_POST["pass2"];
        //recollir dades usuari que es vol registrar

        $missatge = $c->Registre($nom, $DNI, $direccio, $pass, $pass2);
        //regsitrar nou usuari

        mostraResultat($missatge);
        
        break;
       
    case 'eliminar_usuari':
        $DNI = $_POST["DNI"];
        $pass = $_POST["pass"];
        $pass2 = $_POST["pass2"];

        $missatge = $c->Baixa($DNI, $pass, $pass2);

        mostraResultat($missatge);
        //eliminar usuari


        break;

    case 'agafar_bici':
        $parking = $_POST['pk'];
        $DNI = $_POST['DNI'];
        $pass = $_POST['pass'];
        
        $missatge = $c->AgafarBici($parking, $DNI, $pass);

        mostraResultat($missatge);
        break;

    case 'deixar_bici':
        $bici = $_POST['idBici'];
        $DNI = $_POST['DNI'];
        $parking = $_POST['pk'];
        break;
    
    default:
        # code...
        break;
}


?>