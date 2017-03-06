<?php
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
	}
?>