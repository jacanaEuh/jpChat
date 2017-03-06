<?php
	$socket = @socket_create(AF_INET,SOCK_STREAM,SOL_TCP);
	@socket_set_option($socket,SOL_SOCKET,SO_REUSEADDR,1);
	if($socket < 0){
		echo "Não foi possível estabelecer uma conexão";
	}
	$bind = @socket_bind($socket,'localhost',23884);
	if($bind < 0){
		echo "Não foi possível ligar a conexão";
	}
	$listen = @socket_listen($socket,5);
	if($listen < 0){
		echo "Não foi possível escutar o servidor";
	}
	$arrConexao = array($socket);
	var_dump($arrConexao);
	while(1==1){
		echo "1- Procurando conexoes\r\n";
		$leia = $arrConexao;
		@socket_select($leia,$write,$except,5);
		echo "Write: ".$write."\r\n";
		echo "Except: ".$except."\r\n";
		if(in_array($socket,$leia)){
			$socket_cliente = @socket_accept($socket);
			$arrConexao[] = $socket_cliente;
			
			echo "2- Nova Conexão Encontrada\r\n";
			@socket_getpeername($socket_cliente,$ip,$port);
			
			echo "3- ip = $ip\r\nporta=$port\r\n\r\n";
			$receiver = @socket_read($socket_cliente,1024);
			
			echo "4- ".$receiver."\r\n\r\n";
			fazerHandShake($receiver,$socket_cliente);
			
			echo "Escrevendo 'TESTE'\r\n";
			$rst_envio = escreverMsgm($socket_cliente,mask("TESTE"));
			
			$encontre_socket = array_search($socket, $leia);
			unset($leia[$encontre_socket]);
		}
			
		foreach($leia as $socket_cliente){
			while(@socket_recv($socket_cliente,$buf,1024,0)>=1){
				echo "Recebido = ".unmask($buf)."\r\n";

				echo "Retornando a menssagem ".unmask($buf)."\r\n";
				$rst_envio = escreverMsgm($socket_cliente,mask( unmask($buf) ));
				break 2;
			}
			
			if(@socket_read($socket_cliente,1024,PHP_NORMAL_READ)){
				$encontre_socket = array_search($socket, $leia);
				unset($arrConexao[$encontre_socket]);
			}
		}
		echo "****\r\n";
	}
	if(is_resource($socket_cliente)){
		@socket_close($socket_cliente);
	}
	
	function fazerHandShake($receiver,$socket_conexao){
			/*$key = NULL;
			
			if(preg_match("/Sec-WebSocket-Key: (.*)\r\n/", $receiver, $match))
			$key = $match[1];
			echo "5- ".$key."\r\n\r\n";
			$acceptKey = $key.'258EAFA5-E914-47DA-95CA-C5AB0DC85B11';
			$acceptKey = base64_encode(sha1($acceptKey, true));*/
				
			/*
				*******EXEMPLO*******
				Connection: Upgrade
				Sec-WebSocket-Accept: proq86VKyFu4GopQmihGgjauPWg=
				Upgrade: websocket
			*/
			
			/*$header0 = "HTTP/1.1 101 Web Socket Protocol Handshake\r\n";
			//$header0 = "HTTP/1.1 101 Switching Protocols\r\n";
			//$header1 = "Access-Control-Allow-Credentials: true\r\n";
			//$header2 = "Access-Control-Allow-Headers: ".'"content-type, authorization, x-websocket-extensions, x-websocket-version, x-websocket-protocol"'."\r\n";
			//$header3 = "Access-Control-Allow-Origin: http://localhost\r\n";
			//$header4 = "Connection: Keep-alive,Upgrade\r\n";
			$header4 = "Connection: Keep-Alive,Upgrade\r\n";
			//$header5 = "Date: ".date('D, d M Y H:i:s')." GMT\r\n";
			$header6 = "Sec-WebSocket-Accept: $acceptKey\r\n";
			//$header7 = "Conection: keep-alive\r\n";
			//$header8 = "Server: Kaazing Gateway\r\n";
			//$header9 = "Upgrade: websocket\r\n";
			$header9 = "Upgrade: websocket\r\n";
			//$header10 = "Message: Bem vindo";
			$header11 = "WebSocket-Origin: localhost\r\n";
			$header12 = "WebSocket-Location: ws://localhost:23884/server.php\r\n";
			*/
			//$header = $header0.$header1.$header2.$header3.$header4.$header5.$header6./*$header7.*///$header8.$header9/*.$header10*/;
			//$header = $header0.$header4.$header6.$header9.$header11.$header12;
			//echo $header."\r\n";
			//echo "6- enviado handshake\r\n";
			//@socket_write($socket_conexao,$header,strlen($header));
			$headers = array();
			$lines = preg_split("/\r\n/", $receiver);
			foreach($lines as $line)
			{
				$line = chop($line);
				if(preg_match('/\A(\S+): (.*)\z/', $line, $matches))
				{
					$headers[$matches[1]] = $matches[2];
				}
			}

			$secKey = $headers['Sec-WebSocket-Key'];
			$secAccept = base64_encode(pack('H*', sha1($secKey . '258EAFA5-E914-47DA-95CA-C5AB0DC85B11')));
			//hand shaking header
			$upgrade  = "HTTP/1.1 101 Web Socket Protocol Handshake\r\n" .
			"Upgrade: websocket\r\n" .
			"Connection: Upgrade\r\n" .
			"WebSocket-Origin: localhost\r\n" .
			"WebSocket-Location: ws://localhost:23884\r\n".
			"Sec-WebSocket-Accept:$secAccept\r\n\r\n";
			@socket_write($socket_conexao,$upgrade,strlen($upgrade));
			
			echo "6.1 - ".@socket_last_error().@socket_strerror(@socket_last_error())."\r\n";
	}

	function escreverMsgm($socket_conexao,$msgm){
		@socket_write($socket_conexao,$msgm,strlen($msgm));
	}

		//Unmask incoming framed message
	function unmask($text) {
		$length = ord($text[1]) & 127;

		if($length == 126) {
			$masks = substr($text, 4, 4);
			$data = substr($text, 8);
		}
		elseif($length == 127) {
			$masks = substr($text, 10, 4);
			$data = substr($text, 14);
		}
		else {
			$masks = substr($text, 2, 4);
			$data = substr($text, 6);
		}
		$text = "";
		for ($i = 0; $i < strlen($data); ++$i) {
			$text .= $data[$i] ^ $masks[$i%4];
		}
		return $text;
	}

	//Encode message for transfer to client.
	function mask($text)
	{
		$b1 = 0x80 | (0x1 & 0x0f);
		$length = strlen($text);
		
		if($length <= 125)
			$header = pack('CC', $b1, $length);
		elseif($length > 125 && $length < 65536)
			$header = pack('CCn', $b1, 126, $length);
		elseif($length >= 65536)
			$header = pack('CCNN', $b1, 127, $length);
		return $header.$text;
	}
?>