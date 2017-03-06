<?php
	$servidor = stream_socket_server("tcp://127.0.0.1:80",$errNo,$errStr);
	if( is_resource($servidor) ){
		echo "$errNo. $errStr";
	}else{
		$conexao = @stream_socket_accept($servidor,10);
		$uin = fopen("php://stdin", "r"); 
		if( is_resource($conexao) ){
			$conOpen = true;    //we run the read loop until other side closes connection
			while($conOpen) {    //the read loop

				$r = array($conexao, $uin);        //file streams to select from
				$w = NULL;    //no streams to write to
				$e = NULL;    //no special stuff handling
				$t = NULL;    //no timeout for waiting
				
				if(0 < stream_select($r, $w, $e, $t)) {    //if select didn't throw an error
					foreach($r as $i => $fd) {    //checking every socket in list to see who's ready
						if($fd == $uin) {        //the stdin is ready for reading
							$text = fgets($uin);
							fwrite($conexao, $text);
						}
						else {                    //the socket is ready for reading
							$text = fgets($conexao);
							if($text == "") {    //a 0 length string is read -> connection closed
								echo "Connection closed by peer\n";
								$conOpen = false;
								fclose($conexao);
								break;
							}
							echo "[Client says] " .$text;
						}
					}
				}
			}
		}
	}
?>