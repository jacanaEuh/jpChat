<!DOCTYPE HTML>
<html language="pt-br">
	<head>
		<title>SERVIDOR</title>
		<meta charset="ISO-88951">
		<script language="javascript" type="text/javascript">
		</script>
	</head>
	<body>
		<form id="escrever" name="escrever" method="POST">
			<input type="text" size="200" id="menssagem" name="menssagem"/>
		</form>
	</body>
</html>
<?php
	$server = @stream_socket_server('tcp://127.0.0.1:21280',$errCodeC,$errStrC);
	if(!is_resource($server)){
		echo "$errStrC - $errCodeC";
	}else{
		while(true){
			$conexao = @stream_socket_accept($server,3);
			if($conexao){
				if(isset($_REQUESST["menssagem"])){
					fwrite($conexao,$_REQUESST["menssagem"]);
					fread($conexao,255);
					echo stream_get_contents($conexao);
				}
			}else{
				//false;
			}
			//sleep(10);
		}
	}/*
	Class servidor{
		private $servidor;
		private $site = '127.0.0.1';
		private $porta = '80';
		private $errNo;
		private $errStr;
		
		public function __construct(){
			$this->servidor = @stream_socket_server("tcp://$this->site:$this->porta",$this->errNo,$this->errStr);
			@stream_set_blocking($this->servidor,0);
			
		}
		function abrirConexao(){
			$this->servidor = @stream_socket_server("tcp://$this->site:$this->porta",$this->errNo,$this->errStr);
		}
		
		public function enviar($texto){
			//$this->abrirConexao();
			if($this->errNo <> null){
				return "Error $this->errNo. $errStr";
			}else{
				$conexao = @stream_socket_accept($this->cliente);
				if($conexao){
					return stream_get_contents($conexao);
				}else{
					return "Não conectado";
				}
			}
		}
	}*/
?>