<?php
	while(1==1){
		if(session_status() === PHP_SESSION_NONE){
			session_id("menssagem");
			session_start();
		}else if(session_status() === PHP_SESSION_DISABLED){
			session_id("menssagem");
			session_start();
		}else{
			
		}
		$_SESSION["receiver"] = null;
		$cliente = @stream_socket_client("tcp://127.0.0.1:22334",$errCod,$errStr,2);
		if(is_resource($cliente)){
			$menssagem = @fread($cliente,255);
			$_SESSION["receiver"] = $menssagem;
			if($menssagem == NULL){
				$menssagem = " não li nada";
			}
			$_SESSION["receiver"] = $menssagem;
		}else{
			echo "$errCod, $errStr";
		}
		echo $_SESSION["receiver"]."; ";
	}
?>