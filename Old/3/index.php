<!DOCTYPE HTML>
<html language="pt-br">
	<head>
		<title>TESTE STREAM_SOCKET</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<script language="javascript" type="text/javascript">
			//window.setTimeout('inicializar()',1700);

			window.setTimeout('enviar()',5000);
			window.setTimeout('receber()',7000);
			
			function receber(){
				var form;
				var texto;
				var iframe;
				//document.getElementById("historico").innerHTML += '</br>'+document.getElementById("menssagem").value;
				if(document.getElementById("iframes") != null){
					iframe = document.getElementById("iframes");
					if(iframe.contentDocument){
						form = iframe.contentDocument.getElementById("escrever");
						texto = iframe.contentDocument.getElementById("menssagem");
					}else{
						form = iframe.contentWindow.getElementById("escrever");
						texto = iframe.contentWindow.getElementById("menssagem");
					}
					texto.value = document.getElementById("menssagem").value;
					form.submit();
				}else{
					/*criarIFrame();
					iframe = document.getElementById("iframes");
					if(iframe.contentDocument){
						form = iframe.contentDocument.getElementById("escrever");
						texto = iframe.contentDocument.getElementById("menssagem");
					}else{
						form = iframe.contentWindow.getElementById("escrever");
						texto = iframe.contentWindow.getElementById("menssagem");
					}
					texto.value = "";
					form.submit();*/
				}
				//window.setTimeout('receber()',10000);
			}
			
			function enviar(){
				var form;
				var texto;
				var iframe;
				document.getElementById("historico").innerHTML += '</br>'+document.getElementById("menssagem").value;
				if(document.getElementById("iframec") != null){
					iframe = document.getElementById("iframec");
					if(iframe.contentDocument){
						form = iframe.contentDocument.getElementById("escrever");
						texto = iframe.contentDocument.getElementById("menssagem");
					}else{
						form = iframe.contentWindow.getElementById("escrever");
						texto = iframe.contentWindow.getElementById("menssagem");
					}
					texto.value = document.getElementById("menssagem").value;
					form.submit();
				}else{
					/*criarIFrame();
					iframe = document.getElementById("iframec");
					if(iframe.contentDocument){
						form = iframe.contentDocument.getElementById("escrever");
						texto = iframe.contentDocument.getElementById("menssagem");
					}else{
						form = iframe.contentWindow.getElementById("escrever");
						texto = iframe.contentWindow.getElementById("menssagem");
					}
					texto.value = document.getElementById("menssagem").value;
					form.submit();*/
				}
			}
			
			function criarIFrame(){
				var iframes;
				if(document.getElementById("iframes") == null){
					iframes = document.createElement("iframe");
					iframes.id = "iframes";
					iframes.style.display = 'none';
					iframes.src = "servidor.php";
					document.body.appendChild(iframes);
				}
				
				var iframec;
				if(document.getElementById("iframec")==null){
					iframec = document.createElement("iframe");
					iframec.id = "iframec";
					iframec.style.display = 'none';
					iframec.src = "cliente.php";
					document.body.appendChild(iframec);
				}
			}
			
			function verificar(tempo){
				enviar();
			}
			
			function inicializar(){
				criarIFrame();
				//enviar();
			}
		</script>
	</head>
	<body>
		<div id="historico" name="historico">
			<?php 
				/*$_SERVER['REQUEST_METHOD'] = 'POST';
				$chaves = array_keys($_SERVER);
				for($i=0;$i<count($chaves);$i++){
					echo "[$i] $ _SERVER['$chaves[$i]'] = ".$_SERVER[$chaves[$i]]."</br>";
				}*/
			?>
		</div>
		<div id="escrever" name="escrever" style="margin-top: 40%">
			<input type="text" size="200" id="menssagem" name="menssagem"/>
			<input type="button" onclick="enviar()" value="enviar"/>
		</div>
	</body>
</html>