<?php
include_once("usuari.php");
include_once("parking.php");
include_once("bici.php");


class TControl{

    public function Registre($nom, $dni, $direccio, $pass, $pass2){
        $u = new TUsuari();
        //checked que entra
        $error = $u->registreUsuari($nom, $dni, $direccio, $pass, $pass2);
        //registre'm l'usuari

        return $error;
    }

    public function Baixa($dni, $pass, $pass2){
        $u = new TUsuari();
        $error = $u->baixaUsuari($dni, $pass, $pass2);

        return $error;
    }

    public function AgafarBici($pk, $DNI, $pass){
        $u = new TBici();
        $error = $u->agafarBicicleta($pk, $DNI, $pass);

        return $error;
    }

    public function llista_parkings(){
        $u = new TParking();
        $error = $u->llista_parkings();

        return $error;
    }

    public function llista_bicis(){
        $u = new TBici();
        $error = $u->llista_bicis();
    }


    
}




?>