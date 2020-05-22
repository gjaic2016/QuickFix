<?php 
	if ($_SESSION['user']['valid'] == 'true') {

		// Check if Admin; If not redirect to user menu
		if ($_SESSION['user']['isAdmin'] != 1) {
			header("Location: index.php?menu=7");
			exit;
		}

		if (!isset($action)) { $action = 1; }
		print '
		<div class="container">
			<ul>
				<a class="btn btn-primary" href="index.php?menu=6&amp;action=1">Korisnici</a>
				<a class="btn btn-primary" href="index.php?menu=6&amp;action=2">Oglasi</a>
			</ul>
		</div>	
			';
			# Admin Users
			if ($action == 1) { include("admin/users.php"); }
			
			# Admin Adds
			else if ($action == 2) { include("admin/adds.php"); }

			else if ($action == 3) { include("register.php"); }
		print '
		</div>';
	}
	else {
		$_SESSION['message'] = '<div class="container messageInfo"><p><h3>Molimo registrirajte se ili prijavite!</h3></p></div>';
		header("Location: index.php?menu=5");
		exit;
	}
