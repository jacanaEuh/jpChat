<?php
	$servidorR = @stream_socket_server("tcp://127.0.0.1:21334",$errNo,$errStr);
	if($servidorR === false){
		die("Erro $errNo");
	}
	$aux = stream_socket_get_name($servidorR,true);

	$clienteId = array("nome"=>NULL,"conexao"=>NULL);
	$arrCliente = array($clienteId);
	$i=0;
	while(/*$i<30*/1==1){
		if( ( $novoCliente = @stream_socket_accept($servidorR,10,stream_socket_get_name($servidorR,false)) ) ){
			if(is_resource($novoCliente)){
				$eNovo = true;
				for($k = 0;$k < count($arrCliente); $k++){
					if( (array_key_exists("nome",$arrCliente[$k])) && ($arrCliente[$k]["nome"] == stream_socket_get_name($servidorR,false)) ){
						$eNovo = false;
						$destinatario = getDestinatario($novoCliente);
						echo "Menssagem de Cliente novo: ".$destinatario["menssagem"]."\r\nPara: ".$destinatario["destino"]."\r\n";
						$servidorS = @stream_socket_server("tcp://127.0.0.1:22334",$errNo,$errStr);
						$clienteEnviar = @stream_socket_accept($servidorS,10,stream_socket_get_name($servidorR,false));
						@fwrite($clienteEnviar,"Recebi Cliente veio");
					}
					echo count($arrCliente)."\r\n";
				}
				if($eNovo){
						/*if($arrCliente[0] == NULL){
							$arrCliente[0] = array("nome"=> stream_socket_get_name($servidorR,false),"conexao"=>$novoCliente);
							$destinatario = getDestinatario($novoCliente);
							echo "Menssagem: ".$destinatario["menssagem"]."\r\nPara: ".$destinatario["destino"]."\r\n";
							@fwrite($novoCliente,"Recebi Primeiro Cliente");
						}else{*/
							$arrCliente[] = array("nome"=> stream_socket_get_name($servidorR,false),"conexao"=>$novoCliente);
							$destinatario = getDestinatario($novoCliente);
							echo "Menssagem: ".$destinatario["menssagem"]."\r\nPara: ".$destinatario["destino"]."\r\n";
							$servidorS = @stream_socket_server("tcp://127.0.0.1:22334",$errNo,$errStr);
							$clienteEnviar = @stream_socket_accept($servidorS,10,stream_socket_get_name($servidorR,false));
							@fwrite($clienteEnviar,"Recebi Novo Cliente");
						//}
				}
			}
		}
		$i++;
	}
	
	function getDestinatario($stream){
		$flagDest = "%@dest:";
		$tamanhoFlagDest = strlen($flagDest);
		$textoStream = @fread($stream,255);
		$tamanhoTexto = strlen($textoStream);
		
		$menssagem = NULL;
		$destinatario = NULL;
		$resultado = array("menssagem"=>NULL,"destino"=>NULL);
		
		$oCara = NULL;
		
		for($i = 0; $i < $tamanhoTexto; $i++){
			if($textoStream[$i] == $flagDest[0]){
				$posTexto = $i+1;
				$oCara = true;
				for($k=1; $k < $tamanhoFlagDest; $k++){
					if($textoStream[$posTexto] == $flagDest[$k]){
					}else{
						$oCara = false;
						$k = $tamanhoFlagDest+1;
					}
					$posTexto++;
				}
				if($oCara){
					$inicioCara = $posTexto;
					while($inicioCara < $tamanhoTexto){
						$destinatario = $destinatario.$textoStream[$inicioCara];
						$inicioCara++;
					}
					$i = $tamanhoTexto+1;
				}else{
					$oCara = NULL;
					$menssagem = $menssagem.$textoStream[$i];
				}
			}else{
				$menssagem = $menssagem.$textoStream[$i];
			}
		}
		$resultado["menssagem"] = $menssagem;
		$resultado["destino"] = $destinatario;
		return $resultado;
	}
	
	function getEndereco($endereco){
		
	}
?>