<?php

# Stop Hacking attempt
define('__APP__', TRUE);

# Start session
session_start();

# Database connection
include("dbconn.php");

$term = $_GET['term'];

$query = "SELECT title FROM adds where title LIKE '%$term%';";

$result = @mysqli_query($MySQL, $query);


//build array of results
for ($x = 0, $numrows = mysqli_num_rows($result); $x < $numrows; $x++) {
    $row = mysqli_fetch_assoc($result);
 
    $titles[$x] = array("id" => $row["title"], "label" =>$row["title"], "value" => $row["title"]);
}

//echo JSON to page
echo json_encode($titles);
