<?php
	session_start();
	
	include "cliente.php";
	include "servidor.php";
	
	$resultado = NULL;
	if( isset($_SESSION["cliente"]) ){
		if( isset($_POST["texto"]) ){
			$servidor = unserialize($_SESSION["servidor"]);
			$cliente = unserialize($_SESSION["cliente"]);
			
			$servidor->abrirConexao();
			$cliente->abrirConexao();
			
			//$resultado = $servidor->enviar($_POST["texto"]);
			$resultado = $cliente->enviar($_POST["texto"]);
			var_dump($resultado);
		}
	}else{
		$cliente = new cliente();
		$servidor = new servidor();
		$_SESSION["cliente"] = serialize($cliente);
		$_SESSION["servidor"] = serialize($servidor);
		var_dump("oi");
	}
	//session_destroy();
?>
<html>
	<head>
		<script>
			window.setTimeout(validar,500);
			function validar(){
				var validador = document.getElementById("validador").value;
				if(validador != ""){
					escrever(validador);
				}
			}
			function escrever(valor){
				if(valor == ""){
					valor = document.getElementById('texto').value;
				}else{
					var oldText = parent.document.getElementById("historico").innerHTML;
					var newText = oldText+"\r\n</br>"+valor;
				}
				alert(valor);
				parent.document.getElementById("historico").innerHTML = newText;
			}
		</script>
	</head>
	<body>
		<form id="enviar" method="post">
			<input type="text" id="texto" name="texto" value=""/>
		</form>
		<input type="hidden" id="validador" name="validador" value="<?php if( isset($_POST['texto']) ){ echo $resultado;}?>"/>
	</body>
</html>