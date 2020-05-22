<?php 

	print '
<div class="container">
	<div class="row">
		<div class="col-md-12 login-wrapper">
			
			<div class="row">
				<div class="col-md-4 col-md-offset-4">
					<div class="card text-center" style="width: 40rem;">
					
						<h1 class="text-center">Registracija</h1>
						
						<div class="card-body">
	
	';
	
	if ($_POST['_action_'] == FALSE) {
		print '
		<form action="" id="registration_form" name="registration_form" method="POST">
			<input type="hidden" id="_action_" name="_action_" value="TRUE">
			
			<div class="form-group">
				<label for="fname">Ime</label>
				<input type="text" class="form-control form-control-lg rounded-0" id="fname" name="firstname" placeholder="ime.." required>
			</div>
			<div class="form-group">
				<label for="lname">Prezime</label>
				<input type="text" class="form-control form-control-lg rounded-0" id="lname" name="lastname" placeholder="prezime.." required>
			</div>
			<div class="form-group">	
				<label for="email">E-mail</label>
				<input type="email" class="form-control form-control-lg rounded-0" id="email" name="email" placeholder="e-mail.." required>
			</div>
			<div class="form-group">
				<label for="username">Korisničko ime<small>(Korisničko ime mora sadržati min 5 i max 10 znakova)</small></label>
				<input type="text" class="form-control form-control-lg rounded-0" id="username" name="username" pattern=".{5,10}" placeholder="korisnicko ime.." required><br>
			</div>
			<div class="form-group">						
				<label for="password">Lozinka<small>(Lozinka mora sadržati min 4 znaka)</small></label>
				<input type="password" class="form-control form-control-lg rounded-0" id="password" name="password" placeholder="lozinka.." pattern=".{4,}" required>
			</div>
			<div class="form-group">
				<label for="country">Zemlja</label>
				<select name="country" class="form-control form-control-lg rounded-0" id="country">
					<option value="">molimo odaberite</option>';
					#Select all countries from database webprog, table countries
					$query  = "SELECT * FROM countries";
					$result = @mysqli_query($MySQL, $query);
					while($row = @mysqli_fetch_array($result)) {
						print '<option value="' . $row['country_code'] . '">' . $row['country_name'] . '</option>';
					}
				print '
				</select>
			</div>
			<div class="form-group">
				<input type="submit" class="btn btn-success float-right" value="Registriraj">
			</div>
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
		$query .= " WHERE email='" .  $_POST['email'] . "'";
		$query .= " OR username='" .  $_POST['username'] . "'";
		$result = @mysqli_query($MySQL, $query);
		$row = @mysqli_fetch_array($result, MYSQLI_ASSOC);
		
		if ($row['email'] == '' || $row['username'] == '') {
			# password_hash https://secure.php.net/manual/en/function.password-hash.php
			# password_hash() creates a new password hash using a strong one-way hashing algorithm
			$pass_hash = password_hash($_POST['password'], PASSWORD_DEFAULT, ['cost' => 12]);
			
			$query  = "INSERT INTO users (firstname, lastname, email, username, password, country)";
			$query .= " VALUES ('" . $_POST['firstname'] . "', '" . $_POST['lastname'] . "', '" . $_POST['email'] . "', '" . $_POST['username'] . "', '" . $pass_hash . "', '" . $_POST['country'] . "')";
			$result = @mysqli_query($MySQL, $query);
			
			# ucfirst() — Make a string's first character uppercase
			# strtolower() - Make a string lowercase
			echo '<p>' . ucfirst(strtolower($_POST['firstname'])) . ' ' .  ucfirst(strtolower($_POST['lastname'])) . ', hvala na registraciji. </p></div>
			<hr>';
		}
		else {
			echo '<p>Korisnik s navedenim e-mailom već postoji!</p>';
		}
	}
