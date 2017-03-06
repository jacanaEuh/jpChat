<?php
	$test = socket_create("localhost",1,2);
	$servidor = @stream_socket_server("tcp://127.0.0.1:23884",$errNo,$errStr);
	if(!isset($servidor)){
		throw new Exception("Nao foi Possivel iniciar o Servidor. $errNo - $errStr");
	}else{
		$i=0;
		while($i<5){
			$conexao = @stream_socket_accept($servidor,15);
			if($conexao){
				echo "tem alguem aqui\r\n";
				//echo $retorno = file_get_contents($conexao);
				$receiver = @fread($conexao,30000);
				echo $receiver;
				//$arrReceiver = explode(":",$receiver);
				$key = NULL;
				/*var_dump($arrReceiver);
				echo "\r\n".count($arrReceiver)."\r\n";
				for($i=0;$i<count($arrReceiver);$i++){
					if($arrReceiver[$i] == "Sec-WebSocket-Key"){
						$key = $arrReceiver[$i+1];//258EAFA5-E914-47DA-95CA-C5AB0DC85B11
					}
				}*/
				if(preg_match("/Sec-WebSocket-Key: (.*)\r\n/", $receiver, $match))
				$key = $match[1];
				echo $key."\r\n\r\n";
				$acceptKey = $key.'258EAFA5-E914-47DA-95CA-C5AB0DC85B11';
				$acceptKey = base64_encode(sha1($acceptKey, true));
				//$header = "GET / HTTP/1.1\r\nAccess-Control-Allow-Credentials:".'"true"'."\r\nAccess-Control-Allow-Headers:".'"content-type, authorization, x-websocket-extensions, x-websocket-version, x-websocket-protocol"'."\r\nAccess-Control-Allow-Origin:".'"http://http://localhost/Projetos/chat/"'."\r\nConnection:".'"Upgrade"'."\r\nDate:".'"'.date('Y-m-d H:i:s').'"'."\r\nSec-WebSocket-Accept:".'"DC9bZLh3iqzUBiMebb9c2wCa2J4="'."\r\nServer:".'"chat"'."\r\nUpgrade:".'"websocket"';
				//echo date('Y-m-d H:i:s')."\r\n";
				//echo date('D, d M Y H:i:s')." GMT\r\n";
				/*$header0 = "HTTP/1.1 101 Web Socket Protocol Handshake\r\n";
				$header1 = "Access-Control-Allow-Credentials:".'"true"'."\r\n";
				$header2 = "Access-Control-Allow-Headers:".'"content-type, authorization, x-websocket-extensions, x-websocket-version, x-websocket-protocol"'."\r\n";
				$header3 = "Access-Control-Allow-Origin:".'"http://localhost"'."\r\n";
				$header4 = "Connection:".'"Upgrade"'."\r\n";
				$header5 = "Date:".date('D, d M Y H:i:s')." GMT\r\n";
				$header6 = "Sec-WebSocket-Accept:".'"'.$acceptKey.'"'."\r\n";
				$header7 = "Server:".'"Kaazing Gateway"'."\r\n";
				$header8 = "Upgrade:".'"websocket"'."\r\n";*/
				
				$header0 = "HTTP/1.1 101 Web Socket Protocol Handshake\r\n";
				$header1 = "Access-Control-Allow-Credentials: true\r\n";
				$header2 = "Access-Control-Allow-Headers: content-type, authorization, x-websocket-extensions, x-websocket-version, x-websocket-protocol\r\n";
				$header3 = "Access-Control-Allow-Origin: http://localhost\r\n";
				$header4 = "Connection: Upgrade\r\n";
				$header5 = "Date: ".date('D, d M Y H:i:s')." GMT\r\n";
				$header6 = "Sec-WebSocket-Accept: $acceptKey\r\n";
				$header7 = "Conection: keep-alive\r\n";
				$header8 = "Server: Kaazing Gateway\r\n";
				$header9 = "Upgrade: websocket\r\n";
				
				$header = $header0.$header1.$header2.$header3.$header4.$header5.$header6.$header7.$header8.$header9;
				/*$header = "HTTP/1.1 101 Switching Protocols
Upgrade: websocket
Connection: Upgrade
Sec-WebSocket-Accept: ".base64_decode(sha1("258EAFA5-E914-47DA-95CA-C5AB0DC85B11",false))."
Sec-WebSocket-Protocol: chat";*/
				echo $header."\r\n";
				@fwrite($conexao,$header);
				//fclose($conexao);
			}else{
				echo "axei ngm\r\n";
			}
			$i++;
		}
	}
?>