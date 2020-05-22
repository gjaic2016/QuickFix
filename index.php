<?php
# Stop Hacking attempt
define('__APP__', TRUE);

# Start session
session_start();

# Database connection
include("dbconn.php");

# Variables MUST BE INTEGERS
if (isset($_GET['menu'])) {
	$menu   = (int) $_GET['menu'];
}
if (isset($_GET['action'])) {
	$action   = (int) $_GET['action'];
}

# Variables MUST BE STRINGS A-Z
if (!isset($_POST['_action_'])) {
	$_POST['_action_'] = FALSE;
}


if (!isset($menu)) {
	$menu = 1;
}

# Resources
include_once("resources/datePickerUtil.php");
?>
<!DOCTYPE html>
<html>

<?php include "head.php";?>

<body style="width:100%">

	<main style="min-height: 400px;">
		<?php
		if (isset($_SESSION['message'])) {
			print $_SESSION['message'];
			unset($_SESSION['message']);
		}

		include "resources/pages.php";
		?>
	</main>
	<?php include "footer.php"; ?>
</body>

</html>