<?php
include "resources/icons.php";
$user_id = $_SESSION['user']['id'];

#Add adds
if (isset($_POST['_action_']) && $_POST['_action_'] == 'add_adds') {
	$_SESSION['message'] = '';
	# htmlspecialchars — Convert special characters to HTML entities
	# http://php.net/manual/en/function.htmlspecialchars.php
	$query  = "INSERT INTO adds (title, description, archive, date)";
    $query .= " VALUES ('" . htmlspecialchars($_POST['title'], ENT_QUOTES) . "', '" . htmlspecialchars($_POST['description'], ENT_QUOTES) . "', 'N', '" . date("Y-m-d H:i:s") . "')";
	$result = @mysqli_query($MySQL, $query);

    $ID = mysqli_insert_id($MySQL);
    
    $query  = "INSERT INTO useradds (user_id, adds_id) VALUES ($user_id, $ID)";
    $result = @mysqli_query($MySQL, $query);

	# picture
	if ($_FILES['picture']['error'] == UPLOAD_ERR_OK && $_FILES['picture']['name'] != "") {

		# strtolower - Returns string with all alphabetic characters converted to lowercase. 
		# strrchr - Find the last occurrence of a character in a string
		$ext = strtolower(strrchr($_FILES['picture']['name'], "."));

		$_picture = $ID . '-' . rand(1, 100) . $ext;
		copy($_FILES['picture']['tmp_name'], "adds/" . $_picture);

		if ($ext == '.jpg' || $ext == '.png' || $ext == '.gif') { # test if format is picture
			$_query  = "UPDATE adds SET picture='" . $_picture . "'";
			$_query .= " WHERE id=" . $ID . " LIMIT 1";
			$_result = @mysqli_query($MySQL, $_query);
			$_SESSION['message'] .= '<div class="container messageInfo"><p><h3>Uspješno dodana slika.</h3></p></div>';
		}
	}

	
	$_SESSION['message'] .= '<div class="container messageInfo"><p><h3>Uspješno dodan oglas!</h3></p></div>';

	# Redirect
    header("Location: index.php?menu=7&action=4");
    exit;
}

# Update adds
if (isset($_POST['_action_']) && $_POST['_action_'] == 'edit_adds') {
	$query  = "UPDATE adds SET title='" . htmlspecialchars($_POST['title'], ENT_QUOTES) . "', description='" . htmlspecialchars($_POST['description'], ENT_QUOTES) . "'";
	$query .= " WHERE id=" . (int) $_POST['edit'];
	$query .= " LIMIT 1";
	$result = @mysqli_query($MySQL, $query);

	# picture
	if ($_FILES['picture']['error'] == UPLOAD_ERR_OK && $_FILES['picture']['name'] != "") {

		# strtolower - Returns string with all alphabetic characters converted to lowercase. 
		# strrchr - Find the last occurrence of a character in a string
		$ext = strtolower(strrchr($_FILES['picture']['name'], "."));

		$_picture = (int) $_POST['edit'] . '-' . rand(1, 100) . $ext;
		copy($_FILES['picture']['tmp_name'], "adds/" . $_picture);


		if ($ext == '.jpg' || $ext == '.png' || $ext == '.gif') { # test if format is picture
			$_query  = "UPDATE adds SET picture='" . $_picture . "'";
			$_query .= " WHERE id=" . (int) $_POST['edit'] . " LIMIT 1";
			$_result = @mysqli_query($MySQL, $_query);
			$_SESSION['message'] .= '<div class="container messageInfo"><p><h3>Uspješno dodana slika.</h3></p></div>';
		}
	}

	$_SESSION['message'] = '<div class="container messageInfo"><p><h3>Uspješno izmjenjen oglas!</h3></p></div>';

	# Redirect
    header("Location: index.php?menu=7&action=4");
    exit;
}
# End update adds

# Delete adds
if (isset($_GET['delete']) && $_GET['delete'] != '') {

	# Delete adds (Only admin can delete, user can only archive)
	$query  = "UPDATE adds SET archive = 'Y'";
	$query .= " WHERE id=" . (int) $_GET['delete'];
	$result = @mysqli_query($MySQL, $query);

	$_SESSION['message'] = '<div class="container messageInfo"><p><h3>Uspješno obrisan oglas!</h3></p></div>';

	# Redirect
    header("Location: index.php?menu=7&action=4");
    exit;
}
# End delete adds


#Show adds info
if (isset($_GET['id']) && $_GET['id'] != '') {
	$query  = "SELECT * FROM adds";
	$query .= " WHERE id=" . $_GET['id'];
	$query .= " ORDER BY date DESC";
	$result = @mysqli_query($MySQL, $query);
	$row = @mysqli_fetch_array($result);
	print '
		<div class="container">
			<h2>Pregled oglasa</h2>
			<h2>' . $row['title'] . '</h2>
			<div >
				<div class="row text-center">
					<img class="img-thumbnail" src="adds/' . $row['picture'] . '" alt="' . $row['title'] . '" title="' . $row['title'] . '">
				</div>
				<h3>' . $row['description'] . '</h3>
				<p><time datetime="' . $row['date'] . '">' . pickerDateToMysql($row['date']) . '</time></p>
				<hr style="height:2px;border-width:0;color:none;background-color:none">
			</div>
			<p><a class="btn btn-primary" href="index.php?menu=' . $menu . '&amp;action=' . $action . '">Nazad</a></p>
			<hr style="height:2px;border-width:0;color:none;background-color:none">
		</div>
		';
}

#Add adds 
else if (isset($_GET['add']) && $_GET['add'] != '') {

	print '
		<div class="container">
		<h2>Dodaj oglas</h2>
		<form action="" id="adds_form" name="adds_form" method="POST" enctype="multipart/form-data">
			<input type="hidden" id="_action_" name="_action_" value="add_adds">
			<div class="form-group">
			<label for="title">Naziv *</label>
			<input type="text" class="form-control form-control-lg rounded-0" id="title" name="title" placeholder="Naziv oglasa..." required>
			</div>
			<div class="form-group">
			<label for="description">Opis *</label>
			<textarea class="form-control form-control-lg rounded-0" id="description" name="description" placeholder="Opis oglasa..." required></textarea>
			</div>
			<div class="form-group custom-file-input">
			<label for="picture">Slika</label>
			<input type="file" id="picture" name="picture">
			</div>
			<hr style="height:2px;border-width:0;color:none;background-color:none">
			<a class="btn btn-primary" href="index.php?menu=' . $menu . '&amp;action=' . $action . '">Nazad</a>
			<input class="btn btn-success" type="submit" value="Dodaj">
			<hr style="height:2px;border-width:0;color:none;background-color:none">
		</form>
		</div>
		';
}
#Edit adds
else if (isset($_GET['edit']) && $_GET['edit'] != '') {
	$query  = "SELECT * FROM adds";
	$query .= " WHERE id=" . $_GET['edit'];
	$result = @mysqli_query($MySQL, $query);
	$row = @mysqli_fetch_array($result);
	$checked_archive = false;

	print '
		<div class="container">
		<h2>Editiranje  oglasa</h2>
		<form action="" id="adds_form_edit" name="adds_form_edit" method="POST" enctype="multipart/form-data">
			<input type="hidden" id="_action_" name="_action_" value="edit_adds">
			<input type="hidden" id="edit" name="edit" value="' . $row['id'] . '">
			
			<div class="form-group">
				<label for="title">Naslov</label>
				<input type="text" class="form-control form-control-lg rounded-0" id="title" name="title" value="' . $row['title'] . '" placeholder="Naziv oglasa..." required>
			</div>
			<div class="form-group">
				<label for="description">Description *</label>
				<textarea class="form-control form-control-lg rounded-0" id="description" name="description" placeholder="Opis oglasa..." required>' . $row['description'] . '</textarea>
			</div>
			<div class="form-group">
				<label for="picture">Slika</label>
				<input type="file" id="picture" name="picture">
			</div>			
			
	<hr style="height:2px;border-width:0;color:none;background-color:none">
			
			<a class="btn btn-primary" href="index.php?menu=' . $menu . '&amp;action=' . $action . '">Nazad</a>
			<input class="btn btn-success" type="submit" value="Spremi">
			<hr style="height:2px;border-width:0;color:none;background-color:none">
		</form>
		</div>
		';
} else {
	print '
		<div class="container content-wrapper">
		<h2> Moji oglasi</h2>
		<hr style="height:2px;border-width:0;color:none;background-color:none">
		<a class="btn btn-success" href="index.php?menu=' . $menu . '&amp;action=' . $action . '&amp;add=true" class="AddLink">Dodaj oglas</a>
		<hr style="height:2px;border-width:0;color:none;background-color:none">
		<div id="">
			<table class="table table-hover">
				<thead>
					<tr>
						<th width="16">Detalji</th>
						<th width="16">Izmjeni</th>
						<th width="16">Obriši</th>
						<th>Naslov</th>
						<th>Opis</th>
						<th>Datum</th>
						<th width="16">Status</th>
					</tr>
				</thead>
                <tbody>';
    
    $query  = "SELECT * FROM adds JOIN useradds on useradds.adds_id = adds.id WHERE user_id = $user_id AND adds.archive = 'N'";
	$query .= " ORDER BY date DESC";
	$result = @mysqli_query($MySQL, $query);
	while ($row = @mysqli_fetch_array($result)) {
		print '
					<tr>
						<td width="16"><a href="index.php?menu=' . $menu . '&amp;action=' . $action . '&amp;id=' . $row['id'] . '">'.$info.'</a></td>
						<td width="16"><a href="index.php?menu=' . $menu . '&amp;action=' . $action . '&amp;edit=' . $row['id'] . '">'. $pencil . '</a></td>
						<th width="16"><a href="index.php?menu=' . $menu . '&amp;action=' . $action . '&amp;delete=' . $row['id'] . '">'. $trash .'</a></th>
						
						<th>' . $row['title'] . '</th>
						<th>';
		if (strlen($row['description']) > 160) {
			echo substr(strip_tags($row['description']), 0, 160) . '...';
		} else {
			echo strip_tags($row['description']);
		}
		print '
						</th>
						
						<th>' . pickerDateToMysql($row['date']) . '</th>
						<th>';
		if ($row['archive'] == 'Y') {
			print '<a>'.$circleX.'</a>';
		} else if ($row['archive'] == 'N') {
			print '<a>'.$circleCheck.'</a>';
		}
		print '
						</th>
						
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
