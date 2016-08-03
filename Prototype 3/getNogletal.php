<?php
$jsonarray = array();
$sql = 'select * from indbyggertal';
$result = queryDB($sql);
	while ($row = mysqli_fetch_assoc($result)) {
    	$tmp = array(
    		kommune=>$row["Kommune"], region=>$row["Region"], 
    		1993=>$row["1993"], 1994=>$row["1994"], 1995=>$row["1995"], 1996=>$row["1996"], 
    		1997=>$row["1997"], 1998=>$row["1998"], 1999=>$row["1999"], 2000=>$row["2000"], 2001=>$row["2001"], 
    		2002=>$row["2002"], 2003=>$row["2003"], 2004=>$row["2004"], 2005=>$row["2005"], 2006=>$row["2006"], 
    		2007=>$row["2007"], 2008=>$row["2008"], 2009=>$row["2009"], 2010=>$row["2010"], 2011=>$row["2011"], 
    		2012=>$row["2012"], 2013=>$row["2013"], 2014=>$row["2014"], 2015=>$row["2015"], 2016=>$row["2016"]
    		);

    	array_push($jsonarray, $tmp);
    }
    $indbyggertal = json_encode($jsonarray);


$jsonarray2 = array();
$sql2 = 'select * from kulturbudget';
$result2 = queryDB($sql2);
    while ($row = mysqli_fetch_assoc($result2)) {
        $tmp = array(
            kommune=>$row["Kommune"], region=>$row["Region"], 
            1993=>$row["1993"], 1994=>$row["1994"], 1995=>$row["1995"], 1996=>$row["1996"], 
            1997=>$row["1997"], 1998=>$row["1998"], 1999=>$row["1999"], 2000=>$row["2000"], 2001=>$row["2001"], 
            2002=>$row["2002"], 2003=>$row["2003"], 2004=>$row["2004"], 2005=>$row["2005"], 2006=>$row["2006"], 
            2007=>$row["2007"], 2008=>$row["2008"], 2009=>$row["2009"], 2010=>$row["2010"], 2011=>$row["2011"], 
            2012=>$row["2012"], 2013=>$row["2013"], 2014=>$row["2014"], 2015=>$row["2015"], 2016=>$row["2016"]
            );

        array_push($jsonarray2, $tmp);
    }
    $kulturbudget = json_encode($jsonarray2);

?>