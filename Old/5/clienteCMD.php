<?php
	echo "Conectado!\r\n";
	$menssagem = " ";
	while($menssagem <> "exit"){
		$cliente = stream_socket_client("tcp://127.0.0.1:21334",$errCod,$errStr);
		if(is_resource($cliente)){
			echo "Digite: ";
			$menssagem = fgets(STDIN);
			fwrite($cliente,"$menssagem%@dest:admin");
		}else{
			echo "$errCod,$errStr";
		}
	}
?>