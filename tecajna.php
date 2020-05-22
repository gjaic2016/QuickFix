<?php 

$json_url = 'http://api.hnb.hr/tecajn/v2';
 
$json = file_get_contents($json_url);

// Show raw data from JSON
// var_dump(json_decode($json, TRUE));

// structured data from JSON
$data = json_decode($json, TRUE);

// Show structured data from JSON
// echo "<pre>";
// print_r($data);
// echo "</pre>";

$temp = '<div class="container"><h1>Tečajna lista HNB</h1></div>';

/*Initializing temp variable to design table dynamically*/
$temp = '<div class="container"><h1>Tečajna lista HNB</h1><table class="table table-hover">';
 
/*Defining table Column headers depending upon JSON records*/
$temp .= "<tr><th>Drzava</th>";
$temp .= "<th>Valuta</th>";
$temp .= "<th>Jedinica</th>";
$temp .= "<th>Kupovni tečaj</th>";
$temp .= "<th>Srednji tečaj</th>";
$temp .= "<th>Prodajni tečaj</th></tr>";

/*Dynamically generating rows & columns*/
for($i = 0; $i < sizeof($data); $i++)
{
$temp .= "<tr>";
$temp .= "<td>" . $data[$i]["drzava"] . "</td>";
$temp .= "<td>" . $data[$i]["valuta"] . "</td>";
$temp .= "<td>" . $data[$i]["jedinica"] . "</td>";
$temp .= "<td>" . $data[$i]["kupovni_tecaj"] . "</td>";
$temp .= "<td>" . $data[$i]["srednji_tecaj"] . "</td>";
$temp .= "<td>" . $data[$i]["prodajni_tecaj"] . "</td>";
$temp .= "</tr>";
}

/*End tag of table*/
$temp .= "</table></div>";
 
/*Printing temp variable which holds table*/
echo $temp;