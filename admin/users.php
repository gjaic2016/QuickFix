<?php 
	include "resources/icons.php";
	# Update user profile
	if (isset($_POST['edit']) && $_POST['_action_'] == 'TRUE') {
		$query  = "UPDATE users SET firstname='" . $_POST['firstname'] . "', lastname='" . $_POST['lastname'] . "', email='" . $_POST['email'] . "', username='" . $_POST['username'] . "', country='" . $_POST['country'] . "', archive='" . $_POST['archive'] . "'";
        $query .= " WHERE id=" . (int)$_POST['edit'];
        $query .= " LIMIT 1";
        $result = @mysqli_query($MySQL, $query);
		# Close MySQL connection
		@mysqli_close($MySQL);
		
		$_SESSION['message'] = '<div class="container messageInfo"><p><h3>Uspješno ažuriran korisnički profil!</h3></p></div>';
		
		# Redirect
		header("Location: index.php?menu=6&action=1");
	}
	# End update user profile
	
	# Delete user profile
	
	if (isset($_GET['delete']) && $_GET['delete'] != '') {
	
		$query  = "DELETE FROM users";
		$query .= " WHERE id=".(int)$_GET['delete'];
		$query .= " LIMIT 1";
		$result = @mysqli_query($MySQL, $query);
		
		$_SESSION['message'] = '<div class="container messageInfo"><p><h3>Uspješno obrisan korisnički profil!</h3></p></div>';
		
		# Redirect
		header("Location: index.php?menu=6&action=1");
		exit;
	}
	
	# End delete user profile
	
	
	#Show user info
	if (isset($_GET['id']) && $_GET['id'] != '') {
		$query  = "SELECT * FROM users";
		$query .= " WHERE id=".$_GET['id'];
		$result = @mysqli_query($MySQL, $query);
		$row = @mysqli_fetch_array($result);
		print '<div class="container">
		<h2>Korisnički profil</h2>
		<p><b>Ime:</b> ' . $row['firstname'] . '</p>
		<p><b>Prezime:</b> ' . $row['lastname'] . '</p>
		<p><b>Korisničko ime:</b> ' . $row['username'] . '</p>';
		$_query  = "SELECT * FROM countries";
		$_query .= " WHERE country_code='" . $row['country'] . "'";
		$_result = @mysqli_query($MySQL, $_query);
		$_row = @mysqli_fetch_array($_result);
		print '
		<p><b>Država:</b> ' .$_row['country_name'] . '</p>
		<p><b>Datum:</b> ' . pickerDateToMysql($row['date']) . '</p>
		<p><a class="btn btn-primary" href="index.php?menu='.$menu.'&amp;action='.$action.'">Back</a></p></div>';
	}
	#Edit user profile
	else if (isset($_GET['edit']) && $_GET['edit'] != '') {
		$query  = "SELECT * FROM users";
		$query .= " WHERE id=".$_GET['edit'];
		$result = @mysqli_query($MySQL, $query);
		$row = @mysqli_fetch_array($result);
		$checked_archive = false;
		
		print '
		<div class="container">
		<h2>Ažuriranje korisničkog profila</h2>
		<form action="" id="registration_form" name="registration_form" method="POST">
			<input type="hidden" id="_action_" name="_action_" value="TRUE">
			<input type="hidden" id="edit" name="edit" value="' . $_GET['edit'] . '">
			
			<div class="form-group">
				<label for="fname">Ime</label>
				<input type="text" class="form-control form-control-lg rounded-0" id="fname" name="firstname" value="' . $row['firstname'] . '" placeholder="Your name.." required>
			</div>
			<div class="form-group">
				<label for="lname">Prezime</label>
				<input type="text" class="form-control form-control-lg rounded-0" id="lname" name="lastname" value="' . $row['lastname'] . '" placeholder="Your last natme.." required>
			</div>
			<div class="form-group">			
				<label for="email">E-mail *</label>
				<input type="email" class="form-control form-control-lg rounded-0" id="email" name="email"  value="' . $row['email'] . '" placeholder="Your e-mail.." required>
			</div>
			<div class="form-group">
				<label for="username">Korisničko ime<small>(Username must have min 5 and max 10 char)</small></label>
				<input type="text" class="form-control form-control-lg rounded-0" id="username" name="username" value="' . $row['username'] . '" pattern=".{5,10}" placeholder="Username.." required><br>
			</div>
			<div class="form-group">
			<label for="country">Država</label>
			<select name="country" class="form-control form-control-lg rounded-0" id="country">
				<option value="">molimo odaberite</option>';
				#Select all countries from database webprog, table countries
				$_query  = "SELECT * FROM countries";
				$_result = @mysqli_query($MySQL, $_query);
				while($_row = @mysqli_fetch_array($_result)) {
					print '<option value="' . $_row['country_code'] . '"';
					if ($row['country'] == $_row['country_code']) { print ' selected'; }
					print '>' . $_row['country_name'] . '</option>';
				}
			print '
			</select>
			</div>
			<label for="archive">Archive:</label><br />
            <input type="radio" name="archive" value="Y"'; if($row['archive'] == 'Y') { echo ' checked="checked"'; $checked_archive = true; } echo ' /> YES &nbsp;&nbsp;
			<input type="radio" name="archive" value="N"'; if($checked_archive == false) { echo ' checked="checked"'; } echo ' /> NO
			
			<hr style="height:2px;border-width:0;color:none;background-color:none">
			
			<a class="btn btn-primary" href="index.php?menu='.$menu.'&amp;action='.$action.'">Nazad</a>
			<input type="submit" class="btn btn-success" value="Spremi">
			<hr style="height:2px;border-width:0;color:none;background-color:none">
		</form>
		</div>';
	}
	else {
		print '
		<div class="container content-wrapper">
		<h2>Popis korisnika</h2>
		<hr style="height:2px;border-width:0;color:none;background-color:none">
		<a class="btn btn-success" href="index.php?menu=6&amp;action=3">Dodaj korisnika</a>
		<hr style="height:2px;border-width:0;color:none;background-color:none">
		<div id="users">
			<table class="table table-hover">
				<thead>
					<tr>
						<th width="16">Detalji</th>
						<th width="16">Izmjeni</th>
						<th width="16">Obriši</th>
						<th>Ime</th>
						<th>Prezime</th>
						<th>E-mail</th>
						<th>Država</th>
						<th width="16">Status</th>
					</tr>
				</thead>
				<tbody>';
				$query  = "SELECT * FROM users";
				$result = @mysqli_query($MySQL, $query);
				while($row = @mysqli_fetch_array($result)) {
					print '
					<tr>
						<td><a href="index.php?menu='.$menu.'&amp;action='.$action.'&amp;id=' .$row['id']. '">'.$peopleCircle.'</a></td>
						<td><a href="index.php?menu='.$menu.'&amp;action='.$action.'&amp;edit=' .$row['id']. '">'.$pencil.'</a></td>
						<td><a href="index.php?menu='.$menu.'&amp;action='.$action.'&amp;delete=' .$row['id']. '">'.$trash.'</a></td>
						<td><strong>' . $row['firstname'] . '</strong></td>
						<td><strong>' . $row['lastname'] . '</strong></td>
						<td>' . $row['email'] . '</td>
						<td>';
							$_query  = "SELECT * FROM countries";
							$_query .= " WHERE country_code='" . $row['country'] . "'";
							$_result = @mysqli_query($MySQL, $_query);
							$_row = @mysqli_fetch_array($_result, MYSQLI_ASSOC);
							print $_row['country_name'] . '
						</td>
						<td>';
							if ($row['archive'] == 'Y') { print '<a>'.$circleX.'</a>'; }
                            else if ($row['archive'] == 'N') { print '<a>'.$circleCheck.'</a>'; }
						print '
						</td>
					</tr>';
				}
			print '
				</tbody>
			</table>
		</div>
		</div>';
	}
	
	# Close MySQL connection
	@mysqli_close($MySQL);
?>