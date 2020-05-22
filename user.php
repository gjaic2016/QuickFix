<?php 
	if ($_SESSION['user']['valid'] == 'true') {
		if (!isset($action)) { $action = 4; }
		// print '
		// <div class="container">	
		// </div>	
		// 	';
			
			if ($action == 4) { include("users/useradds.php"); }

		print '
		</div>';
	}
	else {
		$_SESSION['message'] = '<div class="container messageInfo"><p><h3>Molimo registrirajte se ili prijavite!</h3></p></div>';
		header("Location: index.php?menu=5");
		exit;
	}
?>