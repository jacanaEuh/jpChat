<!DOCTYPE HTML>
<html>
	<head>
		<script>
			window.setTimeout("aoCarregar()",5000);
			function aoCarregar(){
				var qtdNovaMsg = <?php
									if(session_status() === PHP_SESSION_NONE){
										session_id("menssagem");
										session_start();
									}else if(session_status() === PHP_SESSION_DISABLED){
										session_id("menssagem");
										session_start();
									}else{
									}
									if(isset($_SESSION["receiver"]) && ($_SESSION["receiver"] <> NULL)){
										echo count($_SESSION["receiver"]);
									}else{
										echo 0;
									}
								?>;
				document.body.innerHTML += "</br>Valor de Session = <?
																		if(isset($_SESSION["receiver"]) && ($_SESSION["receiver"] <> NULL)){
																			echo count($_SESSION["receiver"]);
																		}else{
																			echo "NADA";
																		}
								?>;";
				if(qtdNovaMsg > 0){
					alert("Você possui uma nova menssagem");
					parent.document.getElementById("historico").innerHTML += "</br> <?php echo $_SESSION["receiver"];?>";
					<?php 
						if(isset($_SESSION["receiver"]) && ($_SESSION["receiver"] <> NULL)){
							$_SESSION["receiver"] = NULL;
						}
					?>
				}
				window.setTimeout("aoCarregar()",5000);
			}
		</script>
	</head>
	<body>
		<?php 
			if(isset($_SESSION["receiver"]) ){
				echo $_SESSION["receiver"];
			}
		?>
		<!--<form id="formSender" name="formSender" action="self" method="POST">!-->
			<input type="text" name="menssagem" id="menssagem"/>
		<!--</form>!-->
	</body>
</html>