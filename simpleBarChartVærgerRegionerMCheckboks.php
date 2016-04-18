<?php require("functions.php"); ?>

<HTML>
<head>
<script type="text/javascript" src="d3/d3.js"></script>
<link rel="stylesheet" type="text/css" href="stylesheet.css">
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<!-- Latest compiled JavaScript -->
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</head>
<body>

<div class="bar col-sm-6"></div>

<div class="col-sm-6 form-filters">
<div class="checkbox checked">
  <label><input type="checkbox" checked="checked" id="Hovedstaden" name="Hovedstaden" value="Hovedstaden">Hovedstaden</label>
</div>
<div class="checkbox">
  <label><input type="checkbox"  checked="checked" id="Midtjylland" name="Midtjylland" value="Midtjylland">Midtjylland</label>
</div>
<div class="checkbox">
  <label><input type="checkbox" checked="checked" id="Nordjylland" name="Nordjylland" value="Nordjylland">Nordjylland</label>
</div>
<div class="checkbox">
  <label><input type="checkbox"  checked="checked" id="Sjælland" name="Sjælland" value="Sjælland">Sjælland</label>
</div>
<div class="checkbox">
  <label><input type="checkbox" checked="checked" id="Syddanmark" name="Syddanmark" value="Syddanmark">Syddanmark</label>
</div>
<div class="checkbox">
  <label><input type="checkbox" checked="checked" id="Udenfor Danmark" name="Udenfor Danmark" value="Udenfor Danmark">Udenfor Danmark</label>
</div>
</div>

<div id="result">
</div>

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

<script>
	var jsonarr = <?php echo $jsonobj; ?>;
	var jsonarrlength = Object.keys(jsonarr).length;
	//var filterJsonArr = jQuery.extend(true, {}, jsonarr);
	var filterJsonArr = JSON.parse(JSON.stringify(jsonarr));

	$('.form-filters input:checkbox').click(function() {
		var name = $(this).val().trim();
		var i = 0;
		var addIndex;
		for(var i; i < jsonarrlength; i++){
			var exists = false;
			if(filterJsonArr[i].region == name){exists=true;  break;}
			if(jsonarr[i].region == name) {addIndex = i; break;}
		}
	
 		if(exists == false){//console.log("exists er false"); 
			filterJsonArr[addIndex].region = jsonarr[addIndex].region;
			updateData();
 		}
 		else{//console.log("exists er true. Prøver at fjerne: "+name); 
 		filterJsonArr[i].region = null;
 		updateData();}
 		
 	
 		//console.log(Object.keys(filterJsonArr).length);

	
		//$('#result').html(filter_options.join('; '));
	});
	


	
//Laver svg element til at komme figuren
var svg = d3.select("body").append("svg");
//Sætter attributter
var w=500, h=500;
svg.attr("width", w).attr("height", h);

svg.selectAll("rect").data(filterJsonArr).enter().append("rect")
.attr("x",function(d,i){ return i*21 })
.attr("y", function (d){ return h-(d.antal/10)})
.attr("width", 20)
.attr("height", function (d){ return (d.antal/10)})
.attr("fill", "teal");

	
svg.selectAll("text")
.data(filterJsonArr)
.enter()
.append("text")
.text(function (d) { return d.region })
.attr("x",function(d,i){ return i*21 })
.attr("y", function (d){ return h-(d.antal/10)});
	
	
	function updateData(){
	d3.select("svg").remove();
	
	var newData = new Array();
	for(var h=0; h<Object.keys(filterJsonArr).length; h++){
		console.log(h);
		if(filterJsonArr[h].region != null){newData.push(filterJsonArr[h]);  }
	}
	
	//Laver svg element til at komme figuren
var svg = d3.select("body").append("svg");
//Sætter attributter
var w=500, h=500;
svg.attr("width", w).attr("height", h);

svg.selectAll("rect").data(newData).enter().append("rect")
.attr("x",function(d,i){ return i*21 })
.attr("y", function (d){ return h-(d.antal/10)})
.attr("width", 20)
.attr("height", function (d){ return (d.antal/10)})
.attr("fill", "teal");

	
svg.selectAll("text")
.data(newData)
.enter()
.append("text")
.text(function (d) { return d.region })
.attr("x",function(d,i){ return i*21 })
.attr("y", function (d){ return h-(d.antal/10)});
	}

</script>

</body>
</head>


