<html>
	<head>
		<meta charset="UTF-8"/>
		<script>
			function escrever(){
				var texto = "<?php 
	$texto = receber(); 
	if($texto <> NULL){
		echo $texto;
	}else{
		echo ' ';
	}
							?>";
				if(texto != ' '){
					parent.document.getElementById('historico').innerHTML += texto;
					var data = '<?php echo date("H:i:s");?>';
				}
			}
			
			function atualiza(){
				parent.escreveMensagem();
			}
		</script>
	</head>
	<body onload="escrever()">
		<form id="enviarConversa" name="enviarConversa" method="post" onsubmit='atualiza'>
			<input type="hidden" id="oculto" name="oculto"/>
		</div>
	</body>
</html>
<?php
	if( (isset($_REQUEST["oculto"])) && ( ($_REQUEST["oculto"] <> NULL) ) ){
		//echo '<script>alert("To no request");</script>';
		enviar();
	}
	function enviar(){
		//echo '<script>alert("To no enviar");</script>';
		$addr = gethostbyname("localhost");
		$cliente = @stream_socket_client("tcp://$addr:21464",$errNo,$errStr);

		if($cliente === false){
			echo "Erro ($errNo) - $errStr";
		}else{
			//echo "<script>alert('".$_REQUEST['oculto']."');</script>";
			fwrite($cliente,$_REQUEST['oculto']."\r\n");
		}
	}
	
	function receber(){
		$addr = gethostbyname("localhost");
		$cliente = @stream_socket_client("tcp://$addr:21464",$errNo,$errStr);

		if($cliente === false){
			$texto = "Erro $errStr ($errNo)";
		}else{
			$conexao = @stream_socket_accept($cliente,5);
			if($conexao){
				$texto = fread($conexao,250);
			}else{
				$texto = NULL;
			}
		}
		return $texto;
	}
?>