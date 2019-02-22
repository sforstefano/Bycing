<?php
header("Content-Type: text/html;charset=utf-8");
include_once("accesDB.php");
include_once("usuari.php");

class TBici{

    private $servidor = "localhost";
	private $usuari = "root";
	private $passw = "usbw";
    private $bd = "bycing";
                    
    public function agafarBicicleta($pk, $DNI, $pass){
        $adb = new TAccesDB($this->servidor, $this->usuari, $this->passw, $this->bd);
        $res = "";
        //echo("Id de Parking és: ".$pk." DNI del usuari es: ".$DNI." Password del usuari és: ".$pass);
        if($adb->connectat()){
            $user = new TUsuari();
            $error = $user->estaRegistrat($DNI);

            if($error){
            //si esta registrat 
                //echo("L'usuari está registrat");
                $error = $user->teBicicleta($DNI);

                if($error == 0){
                //si no te cap bicicleta
                    //echo("L'usuari no te cap bicicleta assignada");
                    $error = $user->checkPass($DNI, $pass, $pass);

                    if($error){
                        //echo("Id de Parking és: ".$pk." DNI del usuari es: ".$DNI." Password correcta del usuari és: ".$pass);
                        echo("Se");
                        $instruccio = "update parking set num_bicis = num_bicis-1  where id ='$pk')";
                        //al parking, li restem una bici

                        $instruccio2 = "update bicicleta set DNI_Ciutada = '$DNI', id_parking = null where id_parking = '$pk'";
                        
                        if($adb->executa_SQL ($instruccio)){
                        //s'ha recollit la bicilceta
                            echo("here");
                            $res = 4;
                        }
    
                    }else{
                    //les contrassenyes no coincideixen
                        echo("Passs not match");
                        $res = -3;
                    } 
                }else{
                //ja te bici
                    echo("L'usuari si te bicicleta assignada");
                    $res = -5;
                }
            }else{
            //no está registrat
                $res = -4;
            }
        }else{
            $res=-1;
        }

        return $res;                    
    
    }

    public function llista_bicis(){
        $adb = new TAccesDB($this->servidor, $this->usuari, $this->passw, $this->bd);

        if($adb->connectat()){
            
            $instruccio = "select id from bicicleta where id_parking IS NULL";
            $adb ->consulta_multiple($instruccio);

            $res ="<select name='idBici'>";

            $bici = $adb->obtenir_fila();
            //obtenim bicis lliures de la DB
            
            while($bici){
                $res=$res . "<option value='" . $bici["id"] . "'>Bicicleta ".$bici["id"]."</option>";
				$bici = $adb->obtenir_fila();
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