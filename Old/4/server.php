<?php
	$addr = gethostbyname("localhost");
	echo $addr."\r\n";
	$servidor = @stream_socket_server("tcp://$addr:21464",$errNo,$errStr);
	
	$destinatario = "%@dest:";
	
	$arrConexao = array();
	if($servidor === false){
		die("Erro $errStr ($errNo)");
	}
	
	$arrCliente = array("cliente"=>NULL,"conexoes"=>NULL,"ultEnvio"=>NULL,"name"=>NULL);
	//var_dump($arrCliente);
	$flag = true;
	while($flag){
		if(count($arrCliente["conexoes"]) > 0){
			$oDestinatario = "";
			$menssagem = "";
			echo "to no 1 if\r\n";
			for($totalClientes=0; $totalClientes < count($arrCliente["cliente"]); $totalClientes++){
				$conexao = @stream_socket_accept($arrCliente["cliente"][$totalClientes],3);
				$conexao2 = @stream_socket_accept($arrCliente["conexao"][$totalClientes],3);
				if($conexao === false){
					$texto = "";
				}else if(){
					
				}else if($conexao2 === false){
					$texto = "";
				}else{
					//$texto = @fread($arrCliente["cliente"][$totalClientes],255);
					$texto = @fread($conexao,255);
				}
				if(($texto)&&($texto <> "")){
					echo "Texto encontrado em Local: ".stream_socket_get_name($arrCliente["cliente"][$totalClientes],false)."\r\n";
					$oDestinatario = NULL;
					$eDestino = false;
					for($tamanhoTexto=0;$tamanhoTexto<strlen($texto);$tamanhoTexto++){
						if($texto[$tamanhoTexto]=="%"){
							echo "axei a primeira chave\r\n";
							$eDestino = true;
							$posDestino = 1;
							$proximaPos = $tamanhoTexto+1;
							for($contador = 1; $contador < strlen($destinatario);$contador++){
								if($texto[$proximaPos]==$destinatario[$posDestino]){
									$proximaPos++;
								}else{
									$eDestino = false;
									$proximaPos = strlen($destinatario)+1;
									echo "$texto[$proximaPos] e diferente de $destinatario[$posDestino]\r\n";
								}
								echo "proximaPos: $proximaPos = ".$texto[$proximaPos-1].", posDestino $posDestino = $destinatario[$posDestino]\r\n";
								$posDestino++;
							}
							echo "sai do loop\r\n\r\n";
						}
						if($eDestino == true){
							echo "chave encontrada\r\n";
							$posDestino = $tamanhoTexto + strlen($destinatario);
							//$flagDestino = true;
							while(isset($texto[$posDestino])){
								$oDestinatario = $texto[$posDestino];
								$posDestino++;
								echo "$oDestinatario\r\n";
							}
						}else{
							$menssagem = $menssagem.$texto[$tamanhoTexto];
						}
					}
					echo $menssagem."\r\n";
					if($oDestinatario <> NULL){
						enviar_menssagem($menssagem,$oDestinatario,$arrCliente["name"][$totalClientes]);
					}
				}
				else{
					$novaConexao = @stream_socket_accept($servidor,1);
					if($novaConexao){
						echo "encontrei uma conexao\r\n";
						for($totalClientes = 0; $totalClientes < count($arrCliente["conexoes"]); $totalClientes++){
							if(stream_socket_get_name($servidor,false) <> stream_socket_get_name($arrCliente["cliente"][$totalClientes],false)){
								$arrCliente["cliente"][] = $servidor;
								$arrCliente["conexoes"][] = @stream_socket_accept($servidor,10);
								$arrCliente["name"][] = stream_socket_get_name($servidor,false);
								echo "nova conexao aceita. Local: ".stream_socket_get_name($servidor,false)."\r\n";
							}else{
								echo "Nao fora aceita nenhuma nova conexa\r\n";
							}
						}
					}else{
						//echo "Nao encontrei nada diferente\r\n";
					}
				}
			}
		}else{
			$novaConexao = @stream_socket_accept($servidor,3);
			if($novaConexao){
				echo "encontrei uma conexao\r\n";
				$arrCliente["cliente"][] = $servidor;
				$arrCliente["conexoes"][] = @stream_socket_accept($servidor,10);
				$arrCliente["name"][] = stream_socket_get_name($servidor,false);
				echo "nova conexao aceita. Local: ".stream_socket_get_name($servidor,false)."\r\n";
			}else{
				//echo "Nao encontrei nada diferente\r\n";
			}
		}
	}
	
	function enviar_menssagem($menssagem,$destino,$conexoes){
		/*for($tamanhoClientes = 0; $tamanhoClientes < count($conexoes); $tamanhoClientes++){
			if(stream_socket_get_name($conexoes["conexoes"][$tamanhoClientes],false)== $destino){
				@fwrite($conexoes["conexoes"],$menssagem);
				echo "Para: $destino\r\nMenssagem: $menssagem";
			}
		}*/
		$destino = stream_socket_client("tcp://$conexoes",$errNo,$errStr);
		if($destino === false){
			echo "$errNo - $errStr\r\n";
		}else{
			@fwrite($destino,$menssagem);
			echo "Para: $destino\r\nMenssagem: $menssagem\r\n";
			fclose($destino);
		}
	}
		/*$conexao = @stream_socket_accept($servidor,30);
		if($conexao){
			$arrCliente["conexoes"][] = $conexao;
			$texto = @fread($conexao,255);
			echo "nova conexao encontrada. Endereço".stream_socket_get_name($servidor,false).". Texto: $texto\r\n";
		}
		for($i=0;$i<count($arrCliente["conexoes"]);$i++){
			@fwrite($arrCliente["conexoes"][$i],$texto);
		}
	}*/
	/*}else{
		while(true){
			$conexao = @stream_socket_accept($servidor,3600);
			if($conexao){
				$texto = @fread($conexao,128);
				echo "Servidor: ";
				var_dump($servidor);
				//echo "</br>\r\nCliente: ";
				//var_dump($cliente);
				echo "</br>\r\ntexto: ";
				echo $texto;
				@fclose($conexao);
			}else{
				echo "ninguem quis te conectar :(";
			}
		}
	}*/
?>