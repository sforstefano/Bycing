<?php
header("Content-Type: text/html;charset=utf-8");
include_once("accesDB.php");

class TUsuari{

    private $servidor = "localhost";
	private $usuari = "root";
	private $passw = "usbw";
    private $bd = "bycing";

    public function registreUsuari($nom, $dni, $direccio, $pass, $pass2){
        
        $adb = new TAccesDB($this->servidor, $this->usuari, $this->passw, $this->bd);
        $res = 0;
        
        if($adb->connectat()){
            //check que entra a la BD
            $primer = $this->estaRegistrat($dni);
            //mirar si esta registrat
            
            if(!$primer){
            //si no esta registrat

                    if($pass == $pass2){
                    //si les contrassenyes coincideixen
                        
                        $instruccio = "insert into ciutada values ('$dni', '$pass', '$nom', '$direccio')";
                        //inserim ciutada
                        if($adb->executa_SQL ($instruccio)){
                        //ciutadá inserit
                            $res = 2;
                        }

                    }else{
                    //les conrasenyes no coincideixen
                        $res = -3;
                    }
        
            }else{
            //si ja está registrat
                echo("Already registrat");
                $res = -2;
            }
        }else{
            echo("Conexio dolenta");
            $res=-1;
        }

        return $res;
    }

    public function baixaUsuari($dni, $pass, $pass2){
        $adb = new TAccesDB($this->servidor, $this->usuari, $this->passw, $this->bd);
        $res = "";
        if($adb->connectat()){
            
            $primer = $this->estaRegistrat($dni);
            //mirar si esta registrat
            if($primer){
            //si ho está...
                
                $primer = $this->checkPass($dni, $pass, $pass2);
                if($primer == 0){
                //les contrassenyes coincideixen
                    $instruccio = "delete from ciutada where DNI = '$dni'";

                    if($adb->executa_SQL ($instruccio)){
                    //la instruccio se executa correctament
                        $res = 3;
                        
                    }
                }else{
                //les contra no coincideixen
                    $res = -3;
                } 
            }else{
            //si no ho esta
                $res = -4;
            }

        }else{
            $res=-1;
        }

        return $res;

    }

    public function checkPass($dni, $pass, $pass2){
        $adb = new TAccesDB($this->servidor, $this->usuari, $this->passw, $this->bd);

        if($adb->connectat()){
            if($pass == $pass2){
                
                $instruccio = "select pass from ciutada where DNI = '$dni'<br/>";
                
                $passw = $adb->consulta_dada($instruccio);
                
                if($pass = $passw){
                    $res = 0;
                }else{
                    $res = -3;
                }
                
            }else{
            //les conrasenyes no coincideixen
                $res = -3;

            }

        }else{
        //no es connecta a la BD
            $res=-1;
        }

        return $res;


    }

    public function estaRegistrat($dni){
        $adb = new TAccesDB($this->servidor, $this->usuari, $this->passw, $this->bd);

        if($adb->connectat()){
            //check que accedeix per veure si está registrat
            $instruccio = "select count(*) from ciutada where DNI = '$dni'";

            $quants = $adb->consulta_dada($instruccio); 

        }
        return $quants;
        // 22/09 -> Comporbant pq no retirna la contrassneya del usuari, fins aqui funciona corctament
    }

    public function teBicicleta($dni){
        $adb = new TAccesDB($this->servidor, $this->usuari, $this->passw, $this->bd);

        if($adb->connectat()){
            $instruccio = "select count(*) from bicicleta where DNI_ciutada = '$dni'";
            $quants = $adb->consulta_dada($instruccio); 
        }

        return $quants;
    }



}




?>