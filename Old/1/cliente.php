<html>
	<head>
		<script>
			function escrever(valor){
				//alert(valor);
				var oldText = parent.document.getElementById("historico").innerHTML;
				var newText = oldText+"\r\n</br>"+valor;
				parent.document.getElementById("historico").innerHTML = newText;
			}
		</script>
	</head>
	<body onload="escrever('<?php
	$cliente = @stream_socket_client("tcp://127.0.0.1:80",$errNo,$errStr,10);
	if( !is_resource($cliente) ){
		echo "ERROR ($errNo)";
	}else{
		if( isset($_POST['texto']) ){
			echo $_POST['texto'];
			$conexaoC = @stream_socket_accept($cliente,10);
			$uinC = fopen("php://stdin", "r"); 
			if( is_resource($conexaoC) ){
				$conOpenC = true;    //we run the read loop until other side closes connection
				while($conOpenC) {    //the read loop

					$rC = array($conexaoC, $uinC);        //file streams to select from
					$wC = NULL;    //no streams to write to
					$eC = NULL;    //no special stuff handling
					$tC = NULL;    //no timeout for waiting
					
					if(0 < stream_select($rC, $wC, $eC, $tC)) {    //if select didn't throw an error
						foreach($rC as $iC => $fdC) {    //checking every socket in list to see who's ready
							if($fdC == $uinC) {        //the stdin is ready for reading
								$textC = fgets($uinC);
								fwrite($conexaoC, $textC);
							}
							else {                    //the socket is ready for reading
								$textC = fgets($conexaoC);
								if($textC == "") {    //a 0 length string is read -> connection closed
									echo "Connection closed by peer\n";
									$conOpenC = false;
									fclose($conexaoC);
									break;
								}
								echo "[Client says] " .$textC;
							}
						}
					}
				}
			}
		}else{
			echo 'Conectado';
		}
	}?>')">
		<form id="enviar" method="post">
			<input type="text" id="texto" name="texto" value=""/>
		</form>
	</body>
</html>