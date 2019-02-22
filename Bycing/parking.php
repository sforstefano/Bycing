<?php
header("Content-Type: text/html;charset=utf-8");
include_once("accesDB.php");

class TParking{

    private $servidor = "localhost";
	private $usuari = "root";
	private $passw = "usbw";
    private $bd = "bycing";
                    
    public function llista_parkings(){
        $adb = new TAccesDB($this->servidor, $this->usuari, $this->passw, $this->bd);

        if($adb->connectat()){
            $instruccio = "select id, adresa from parking where num_bicis > 0";
            $adb ->consulta_multiple($instruccio);

            $res ="<select name='pk'>";

            $parking = $adb->obtenir_fila();
            //obtenim bicis lliures de la DB
            
            while($parking){
                $res=$res . "<option value='" . $parking["id"] . "'>".$parking["adresa"]."</option>";
				$parking = $adb->obtenir_fila();
            }
            $res = $res . "</select><br>";
			$adb->tancar_consulta_multiple();
        }else{
            $res=-1;
        }

        return $res;

    }



}




?>