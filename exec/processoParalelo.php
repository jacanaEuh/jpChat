<?php
	include "minhaSessao.php";
	
	/*for($i=0;$i<count(self::$instancia);$i++){
		if(self::$instancia[$i] == $instancia){
			$obj[$i] = self::$instancia[$i];
			$i = count(self::$instancia)+1;
		}
	}*/
	
	//minhaSessao::verificaInstancia("teste");
	if(minhaSessao::getInstancia("teste") == NULL){
		echo "sá porra tava nula</br>";
		$arr = array("teste",array("menssagem"=>NULL,"enviar"=>NULL));
		minhaSessao::setInstancia($arr);
		echo "Nao ta mais</br>";
		var_dump(minhaSessao::getInstancia("teste"));
		echo "</br></br>";
	}else{
		echo "ta null nao</br>";
		var_dump(minhaSessao::getInstancia("teste"));
		echo "</br></br>";
	}

	//echo "getInstancia: ";
	//var_dump(minhaSessao::getInstancia("teste"));
	//echo "</br></br>";
	//session_name("teste");
	//session_id("teste1");
	//session_start();
	$so = php_uname();
	$windows = 'WINDOWS';
	$eWindows = false;
	$i=0;
	
	while($i<7){
		$maiusculoChar = upper($so[$i]);
		if($maiusculoChar == $windows[$i]){
			$eWindows = true;
		}else{
			$eWindows = false;
			$i = 7;
		}
		$i++;
	}
	
	if($eWindows){
		echo "Windows</br>";
	}else{
		echo "Linux</br>";
	}
	/*if(!isset($_SESSION["menssagem"])){
		$_SESSION["menssagem"] = NULL;
		echo "menssagem tava NULL</br>";
	}
	if(!isset($_SESSION["menssagem2"])){
		$_SESSION["menssagem2"] = NULL;
		echo "menssagem2 tava NULL</br>";
	}*/
	$imprimir = NULL;
	$aux = NULL;
	$retorno = exec("php c:/xampp/htdocs/Projetos/chat/arquivoParalelo.php teste &",$imprimir,$aux)."</br></br>";/*  >> {$_SESSION["menssagem"]} 2>{$_SESSION["menssagem"]}*/
//	echo var_dump($arrOut)."ARRAY</br></br>";
	echo "</br>$aux = aux</br></br>";
	echo var_dump($imprimir)." IMPRIMIR</br></br>";
	echo "'$retorno' = Retorno</br></br>";
	//echo var_dump($_SESSION["menssagem"])." = SESSION1</br>";
	//echo var_dump($_SESSION["menssagem2"])." = SESSION2</br>";
	//$_SESSION["menssagem"] = $imprimir;
	//$_SESSION["menssagem2"] = $aux;
	//session_destroy();
	//var_dump(minhaSessao::getSessao("teste"));
	//$arr = Array("menssagem"=>"oi2","enviar"=>"xau2");
	//minhaSessao::setInstancia("teste",$arr);
	sleep(3);
	$arr = array("teste2",array("menssagem"=>"Por enquanto ta OK","enviar"=>"Issae Jacana"));
	//minhaSessao::setInstancia("teste2",$arr);
	minhaSessao::setInstancia($arr);
	echo "Minha sessão1: ";
	var_dump(minhaSessao::getInstancia("teste"));
	echo "</br></br>";
	echo "Minha sessão2: ";
	var_dump(minhaSessao::getInstancia("teste2"));
	//minhaSessao::limpaInstancia(NULL,NULL);
	//var_dump(minhaSessao::getInstancia("teste"));
	
	//minhaSessao::setDados(minhaSessao::getSessao("teste"),$arr);
	//minhaSessao::getSessao("teste")["teste"] = $arr;
	//var_dump(minhaSessao::getSessao("teste"));
	echo "</br>";
	echo "</br>";
	echo "</br>";
	echo "</br>";
	echo "</br>";
	echo "</br>";
	echo "</br>";
	
	var_dump($_SERVER);
	phpinfo();
	
	function upper($char){
		$retorno = NULL;
		if($char == 'a'){
			$retorno = 'A';
		}else if($char == 'b'){
			$retorno = 'B';
		}else if($char == 'c'){
			$retorno = 'C';
		}else if($char == 'd'){
			$retorno = 'D';
		}else if($char == 'e'){
			$retorno = 'E';
		}else if($char == 'f'){
			$retorno = 'F';
		}else if($char == 'g'){
			$retorno = 'G';
		}else if($char == 'h'){
			$retorno = 'H';
		}else if($char == 'i'){
			$retorno = 'I';
		}else if($char == 'j'){
			$retorno = 'J';
		}else if($char == 'k'){
			$retorno = 'K';
		}else if($char == 'l'){
			$retorno = 'L';
		}else if($char == 'm'){
			$retorno = 'M';
		}else if($char == 'n'){
			$retorno = 'N';
		}else if($char == 'o'){
			$retorno = 'O';
		}else if($char == 'p'){
			$retorno = 'P';
		}else if($char == 'q'){
			$retorno = 'Q';
		}else if($char == 'r'){
			$retorno = 'R';
		}else if($char == 's'){
			$retorno = 'S';
		}else if($char == 't'){
			$retorno = 'T';
		}else if($char == 'u'){
			$retorno = 'U';
		}else if($char == 'v'){
			$retorno = 'V';
		}else if($char == 'w'){
			$retorno = 'W';
		}else if($char == 'y'){
			$retorno = 'Y';
		}else if($char == 'x'){
			$retorno = 'X';
		}else if($char == 'z'){
			$retorno = 'Z';
		}
		if($retorno){
			return $retorno;
		}else{
			return $char;
		}
	}
?>