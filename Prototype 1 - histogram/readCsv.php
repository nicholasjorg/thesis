<?php require("functions.php");
header('Content-Type: text/html; charset=utf-8');
$dataArr = array();
$result = getMunicipalities();

while ($row = mysqli_fetch_assoc($result)) {
	$tmp = array(municipality=>$row["municipality"]);
   	array_push($dataArr, $tmp);
}




function readCSV($csvFile){
	$file_handle = fopen($csvFile, 'r');
	while (!feof($file_handle) ) {
		$line_of_text[] = fgetcsv($file_handle, 1024);
	}
	fclose($file_handle);
	return $line_of_text;
}


// Set path to CSV file
$csvFile = 'indbyggertal.csv';

$csv = readCSV($csvFile);

for($i=0; $i<sizeof($csv); $i++){
	for($j=0; $j<sizeof($dataArr); $j++){
		if($csv[$i][0] == $dataArr[$j]["municipality"]){
			for($h=0; $h<23; $h++){
				//echo $h;
				$dataArr[$j]["municipality"][$h] = 1;
				echo $dataArr[$j]["municipality"][$h];
			}


		echo "Vi har en vinder";
		echo $csv[$i][0];
		echo $dataArr[$j]["municipality"];
		echo "<br/>";
	}
	}
}

echo '<pre>';
echo $csv[0][0];
print_r($csv);

echo '</pre>';

$dataset = json_encode($dataArr);
//echo $dataset;







?>