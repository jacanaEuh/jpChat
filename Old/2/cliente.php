<?php
	Class cliente{
		private $cliente;
		private $site = '127.0.0.1';
		private $porta = '80';
		private $errNo;
		private $errStr;
		
		public function __construct(){
			$this->cliente = @stream_socket_client("tcp://$this->site:$this->porta",$this->errNo,$this->errStr);
			@stream_set_blocking($this->cliente,0);
			
		}
		function abrirConexao(){
			$this->cliente = @stream_socket_client("tcp://$this->site:$this->porta",$this->errNo,$this->errStr);
			@stream_set_blocking($this->cliente,0);
		}
		
		public function enviar($texto){
			//$this->abrirConexao();
			if($this->errNo <> null){
				return "Error $this->errNo. $errStr";
			}else{
				$conexao = @stream_socket_accept($this->cliente);
				if($conexao){
					/*$header = "HTTP/1.0 200 OK\n"
							."Server: mine\n"
							."Content-Type: text/html\n"
							."\n";
					$body = "Aloooo";
					fwrite($conexao,$header.$body);*/
					fwrite($client, "GET / HTTP/1.0\r\nHost: www.example.com\r\nAccept: */*\r\n\r\n");
					echo stream_get_contents($client);
					//return stream_get_contents($conexao);
				}else{
					return "Não conectado";
				}
			}
		}
	}
?>