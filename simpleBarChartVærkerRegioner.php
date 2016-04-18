<?php require("functions.php"); ?>

<HTML>
<head>
<script type="text/javascript" src="d3/d3.js"></script>
<link rel="stylesheet" type="text/css" href="stylesheet.css">
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
</head>
<body>

<div class="bar"></div>



<?php
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


<script type="text/javascript">

var jsonarr = <?php echo $jsonobj; ?>;
//for(var i=0; i<jsonarr.length; i++)
	//alert(jsonarr[i].antal);
	
//Laver svg element til at komme figuren
var svg = d3.select("body").append("svg");
//Sætter attributter
var w=500, h=500;
svg.attr("width", w).attr("height", h);

svg.selectAll("rect").data(jsonarr).enter().append("rect")
.attr("x",function(d,i){ return i*21 })
.attr("y", function (d){ return h-(d.antal/10)})
.attr("width", 20)
.attr("height", function (d){ return (d.antal/10)})
.attr("fill", "teal");


	
svg.selectAll("text")
.data(jsonarr)
.enter()
.append("text")
.text(function (d) { return d.region })
.attr("x",function(d,i){ return i*21 })
.attr("y", function (d){ return h-(d.antal/10)});


svg.selectAll("text2")
.data(jsonarr)
.enter()
.append("text2")
.text(function (d) { return d.antal })
.attr("x",function(d,i){ return i*21 })
.attr("y", function (d){ return h-(d.antal/10)-10});		
	
</script>






</body>
</head>


