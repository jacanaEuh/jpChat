<?php 
//	session_id("menssagens");
//	session_start();
//	$_SESSION["sender"] = NULL;
	if(isset($_POST["menssagem"]) && ($_POST["menssagem"] <> NULL)){
		//echo "entrei";
		//$_SESSION["sender"] = $_POST["menssagem"];
		$cliente = @stream_socket_client("tcp://127.0.0.1:21334",$errCod,$errStr,4);
		if(is_resource($cliente)){
			$menssagem = @fwrite($cliente,$_POST["menssagem"]);
			@fclose();
		}
	}
	//var_dump($_SERVER);
?>
<!DOCTYPE HTML>
<html>
	<head>
	</head>
	<body>
		<?php 
			//if(isset($_SESSION["receiver"]) ){
				//echo $_SESSION["receiver"];
			//}
		?>
		<form id="formSender" name="formSender" method="POST">
			<?php //echo $_SESSION["sender"]?>
			<input type="text" name="menssagem" id="menssagem"/>
		</form>
	</body>
</html>