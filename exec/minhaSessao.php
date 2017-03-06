<?php
Class minhaSessao{
	private static $instancia;
	private function __construct(){}
	private function __clone(){}
	
	public static function verificaInstancia(/*$instancia*/){
		/*if( !isset(self::$instancia) ){
			return new self;
		}else{
			return self::getInstancia($instancia);
		}*/
	}
	
	public static function getInstancia($instancia){
		//return self::$instancia;
		$obj = NULL;
		for($i=0;$i<count(self::$instancia);$i++){
			if(self::$instancia[$i][0] == $instancia){
				$obj[$i] = self::$instancia[$i];
				$i = count(self::$instancia)+1;
			}
		}
		return $obj;
		/*if( !isset(self::$instancia[$instancia]) ){
			return NULL;*/
			/*self::$instancia = Array($instancia=>NULL);
			self::$instancia[$instancia] = Array("menssagem"=>NULL,"enviar"=>NULL);*/
		/*}else{
			return self::$instancia[$instancia];
		}*/
	}
	
	public static function setInstancia($instancia/*,$valor*/){
		self::$instancia[] = $instancia;
		//self::$instancia[$instancia] = $valor;
	}
	
	public static function limpaInstancia($instancia,$chave){
		for($i=0;$i<count(self::$instancia);$i++){
			if(self::$instacia[$i] == $instacia[0]){
				unset(self::$instancia[$i]);
			}
		}
		/*if( ($instancia == NULL)&&($chave == NULL) ){
			self::$instancia = Array();
		}*/
	}
}

/*class minhaSessao
{
        private static $instance;
        private function __construct() { } // Evita que a classe seja instanciada publicamente
        private function __clone() { } // Evita que a classe seja clonada
        public static function getInstance()
        {
                if (!isset(self::$instance)) { // Testa se há instância definifa na propriedade
                        self::$instance = new self; // o new self cria uma instância da própria classe
                }
                return self::$instance;
        }
}*/
/*	Class minhaSessao{
		private static $sessao;
		public static $arr;
		private function __construct(){}
		private function __clone(){}
		
		public static function getSessao($sessaoPar){
			if( (isset(self::$sessao)) && (!isset($this->arr[$sessaoPar])) ){
				//self::setNovaSessao($sessaoPar);
				return self::arr[$sessaoPar];
				//return self::arr;
			}else if( (isset(self::$sessao)) && (isset($this->arr[$sessaoPar])) ){
				return self::arr[$sessaoPar];
				//return self::arr;
			}else{
				return new self;
			}
		}
		
		public static function setNovaSessao($sessaoPar){
			//self::arr[$sessaoPar] = NULL;
		}
		
		public static function setDados($sessaoPar,$dado){
			//self::arr[$sessaoPar] = $dado;
		}
	}*/
?>