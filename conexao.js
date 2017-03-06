status_conexao = "";

function conectar(){
//	alert("Vo tenta criar");
	conexao = "ws://localhost:23884";
	//conexao = "wss://echo.websocket.org";
	
	websocket = new WebSocket(conexao);
	/*websocket.onopen = function(evt){abrirConexao(evt)};
	websocket.onclose = function(evt){fecharConexao(evt)};
	websocket.onmessage = function(evt){receberMsg(evt)};
	websocket.onerror = function(evt){imprimeErro(evt)};*/
	
	websocket.onopen = function(evt){parent.document.getElementById("campoMenssagem").innerHTML += "Conectando...</br>";};
	websocket.onclose = function(evt){parent.document.getElementById("campoMenssagem").innerHTML += "Desconectando...</br>";};
	websocket.onmessage = function(evt){receberMsg(evt);}
	websocket.onerror = function(evt){msg = "Erro: "+evt.data; escreverMsg(msg);};

}

function desconectar(){
	websocket.close();
}

function receberMsg(evt){
	escreverMsg(evt.data);
}

function escreverMsg(texto){
	if(texto !== undefined){
		var msg = texto;
	}else{
		var msg = parent.document.getElementById("newMenssagem").value;	
	}
	parent.document.getElementById("campoMenssagem").innerHTML += "Recebido: "+msg+"</br>";
}

function enviarMsg(){
	var msg = parent.document.getElementById("newMenssagem").value;	
	parent.document.getElementById("campoMenssagem").innerHTML += "Você: "+msg+"</br>";
	websocket.send(msg);
}

function verificaConexao(){
	parent.document.getElementById("campoMenssagem").innerHTML += "Status = "+websocket.readyState+"</br>";
	status_conexao = websocket.readyState;
	window.setTimeout("verificaConexao()",5000);
}

//window.setTimeout("verificaConexao()",1000);
window.setTimeout("conectar()",800);

window.onbeforeunload = saindo();

function saindo(){
	websocket.close();
	return "ate mais";
}