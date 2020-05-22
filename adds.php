<?php
	
	
	if (isset($action) && $action != '') {
		$query  = "SELECT * FROM adds";
		$query .= " WHERE id=" . $_GET['action'];
		$result = @mysqli_query($MySQL, $query);
		$row = @mysqli_fetch_array($result);
			print '
			<div class="adds">
				<img src="adds/' . $row['picture'] . '" alt="' . $row['title'] . '" title="' . $row['title'] . '">
				<h2>' . $row['title'] . '</h2>
				<p>'  . $row['description'] . '</p>
				<time datetime="' . $row['date'] . '">' . pickerDateToMysql($row['date']) . '</time>
				<hr>
			</div>';
	}
	else {


		?>

<!-- <div class="ui-widget">
  <label for="search">Pretraži: </label>
  <input id="search">
</div> -->

		<?php



		print '<div class="container"><h1>Oglasi</h1></div>';
		$query  = "SELECT * FROM adds";
		$query .= " WHERE archive='N'";
		$query .= " ORDER BY date DESC";
		$result = @mysqli_query($MySQL, $query);
		while($row = @mysqli_fetch_array($result)) {
			print '
			<div class="container">
				<hr>
				<div class="center-block col-md-4">';
				if(!empty($row['picture'])) {
					print ' 
					<img src="adds/' . $row['picture'] . '" alt="' . $row['title'] . '" title="' . $row['title'] . '" style="height:200px; width:100%"">
					';
				} else {
					print '
					<img src="img/noimage.jpeg">	
					';
				}
			print '	
				<h2>' . $row['title'] . '</h2>
				</div>
				<div class="center-block col-md-8"><h3>';

				if(strlen($row['description']) > 300) {
					echo substr(strip_tags($row['description']), 0, 300).'... <a href="index.php?menu=' . $menu . '&amp;action=' . $row['id'] . '">More</a>';
				} else {
					echo strip_tags($row['description']);
				}
			print '
				</h3></div>
				
				<div class="col-md-4">
				<time datetime="' . $row['date'] . '">' . pickerDateToMysql($row['date']) . '</time>
				</div>
				
			
			</div>
			';
		}
	}
?>