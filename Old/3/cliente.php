<!DOCTYPE HTML>
<html language="pt-br">
	<head>
		<title>CLIENTE</title>
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
	$addr = gethostbyname("localhost");
	$client = stream_socket_client("tcp://$addr:21380",$errNo,$errStr);
	if($client === false){
		
	}else{
		
	}
?>