<?php
	include "minhaSessao.php";
	//session_name("teste");
	//session_id("teste1");
//	session_start();
	/*for($i=0;$i<4000;$i++){
		 echo "oi
 Jacana";*/
	$arr = array("teste",array("menssagem"=>"Oi","enviar"=>"Xau"));

	minhaSessao::setInstancia(/*$argv[1],*/$arr);

	var_dump(minhaSessao::getInstancia("teste")[0]);
	//session_destroy();
	//}
?>