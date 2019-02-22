<?php
header("Content-Type: text/html;charset=utf-8");

class TAccesDB{

    private $servidor;
		private $usuari;
		private $pass;
    private $bd;
		private $con;
		private $res;


  //connecta amb la BD. Retorna si hi ha o no conexió
	function __construct($servidor, $usuari, $contrasenya, $bd){
		$this->servidor = $servidor;
		$this->usuari = $usuari;
		$this->pass = $contrasenya;
		$this->bd = $bd;
		$this->con = mysqli_connect ($servidor, $usuari, $contrasenya, $bd);
		mysqli_set_charset($this->con,"utf8");
  }

  //retorn si hi a o  no connexio
	public function connectat(){
		return ($this->con != false);
	}

	//executa instruccio SQL
	public function executa_SQL($instruccio){
		$this->res = mysqli_query ($this->con, $instruccio);
		return $this->res;
	}

	public function consulta_dada ($instruccio){
			
			$this->res = mysqli_query ($this->con, $instruccio);
			$dada  ="";
			if ($this->res){
				echo("Entra a fer la consulta: ".$instruccio);
				$fila = mysqli_fetch_array($this->res,MYSQLI_BOTH);
				$dada = $fila[0];
			}
			
			mysqli_free_result($this->res);
		return($dada);
	}

	public function consulta_multiple ($instruccio){

		$this->res = mysqli_query ($this->con, $instruccio);
		
	}

	public function obtenir_fila (){
		$fila = null;
		$fila = mysqli_fetch_array($this->res, MYSQLI_BOTH);
	
		return ($fila);
	}

	public function tancar_consulta_multiple ()
	{
		mysqli_free_result($this->res);
	}
    
	
}







?>