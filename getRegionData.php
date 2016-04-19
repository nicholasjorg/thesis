	<?php
	//Henter data omkring regioner / antal værker
		$jsonarray = array();
		//Bygger SQL statement
		$var1 = "region";
		$var2 = "count(*)";
		$sql = 'SELECT '.$var1.', '.$var2.' FROM allData group by region';
		$result = queryDB($sql);

		while ($row = mysqli_fetch_array($result)) {
			//Indsæt de forskellige variable, ændre count(*), da det ellers fucker op i JS
			$tmparr = array($var1=>$row[$var1], antal=>$row[$var2]);
			array_push($jsonarray,$tmparr);
			}
		$jsonobj = json_encode($jsonarray);
	?>
	
	<?php
	//Henter data omkring regioner / antal værker fordelt over enkelte år.
		$jsonarray = array();
		//Bygger SQL statement
		$var1 = "region";
		$var2 = "displayDate";
		$var3 = "count(*)";
		$sql = 'SELECT '.$var1.', '.$var2.', '.$var3.' FROM allData WHERE '.$var1.' is not null AND '.$var2.' is not null GROUP BY '.$var1.', '.$var2;
		$result = queryDB($sql);
		while ($row = mysqli_fetch_array($result)) {
		//Indsæt de forskellige variable, ændre count(*), da det ellers fucker op i JS
			$tmparr = array($var1=>$row[$var1], $var2=>$row[$var2], antal=>$row[$var3]);
			array_push($jsonarray,$tmparr);
		}	
		$regionSingleYear = json_encode($jsonarray);
	?>