<?php 
	print '
<div class="container">
	<div class="row">
		<div class="col-md-12 login-wrapper">
			<h1 class="text-center">Prijava</h1>
			<div class="row">
				<div class="col-md-6 col-xs-offset-3">
					<div class="card">
						<div class="card-body">
	
	
	';
	
	if ($_POST['_action_'] == FALSE) {
		print '
							<form action="" name="myForm" id="myForm" method="POST">
								
								<input type="hidden" id="_action_" name="_action_" value="TRUE">
									
								<div class="form-group">
									<label for="username">Korisničko ime:*</label>
									<input type="text" class="form-control form-control-lg rounded-0" id="username" name="username" value="" pattern=".{5,10}" required>
								</div>
									
								<div class="form-group">					
									<label for="password">Lozinka:*</label>
									<input type="password" class="form-control form-control-lg rounded-0" id="password" name="password" value="" pattern=".{4,}" required>	
								</div>
								<hr style="height:2px;border-width:0;color:none;background-color:none">
								<div class="form-group messageInfo">
								<input type="submit" class="btn btn-primary float-right" value="Prijavi">
								</div>
								<hr style="height:2px;border-width:0;color:none;background-color:none">
							</form>
		
						</div>
					</div>
				</div>	
			</div>
		</div>
	</div>
</div>		
		';
	}
	else if ($_POST['_action_'] == TRUE) {

		$query  = "SELECT * FROM users";
		$query .= " WHERE username='" .  $_POST['username'] . "'";
		$result = @mysqli_query($MySQL, $query);
		$row = @mysqli_fetch_array($result, MYSQLI_ASSOC);
		
		if($row['archive'] == "Y"){
			# User archived
			unset($_SESSION['user']);
			$_SESSION['message'] = '<div class="container messageInfo"><p><h3>Korisnik nije aktivan!</h3></p></div>';
			header("Location: index.php?menu=5");
			exit;
		}

		#password_verify https://secure.php.net/manual/en/function.password-verify.php
		if (password_verify($_POST['password'], $row['password'])) {
			$_SESSION['user']['valid'] = 'true';
			$_SESSION['user']['id'] = $row['id'];
			$_SESSION['user']['firstname'] = $row['firstname'];
			$_SESSION['user']['lastname'] = $row['lastname'];
			$_SESSION['user']['isAdmin'] = $row['isAdmin'];
			$_SESSION['message'] = '<div class="container messageInfo"><p><h3>Dobrodošli, ' . $_SESSION['user']['firstname'] . ' ' . $_SESSION['user']['lastname'] . '</h3></p></div>';
			
			if($row['isAdmin'] == 1){
				# Redirect to admin website
				header("Location: index.php?menu=6");
				exit;
			}else{
				# Redirect to user website
				header("Location: index.php?menu=7");
				exit;
			}

		}
		
		# Bad username or password
		else {
			unset($_SESSION['user']);
			$_SESSION['message'] = '<div class="container messageInfo"><p><h3>Pogrešno korisničko ime ili lozinka!</h3></p></div>';
			header("Location: index.php?menu=5");
			exit;
		}
	}

?>