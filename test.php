<?php require("functions.php"); ?>
<?php require("getRegionData.php"); ?>

<!-- Header -->
<?php require("header.php");?>

<div class = "container">
    <div class = "row">
        <div class = "col-sm-4">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#home">Regioner</a></li>
                <li><a href="#menu1">Årstal</a></li>
                <li><a href="#menu2">Værktyper</a></li>
            </ul>
            <div class="tab-content">
                <div id="home" class="tab-pane fade in active row">
                    <h3>Vælg regioner</h3>
                    <div class="col-sm-6 region-filters">
                    	<div class="checkbox">
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
                </div>
                <div class = "row">
                <div class="onView-filter">
                    <h3 id><span id = "hey">OnDisplay</span></h3>
                    <p><div class = "col-sm-1"><input type="radio" name="onView" value="Begge" checked= "checked"/></div><label>Alle</label></p>
                    <p><div class = "col-sm-1"><input type="radio" name="onView" value="Til" /></div><label>True</label></p>
                    <p><div class = "col-sm-1"><input type="radio" name="onView" value="Fra" /></div><label>False</label></p>
                </div>
                </div>
                <div id="menu1" class="tab-pane fade col-sm-8">
                    <h3>Single year</h3>
                    <select id ="selectSingleYear">
                    <option value="Vaelg">Vælg år</option>
                    <option value="Alle">Alle</option>
                    <?php
                        $result = getDisplayDateYears();
                        while ($row = mysqli_fetch_array($result)) {
                            echo '<option value='.$row["displayDate"].'>'.$row["displayDate"].'</option>';
                    }
                    ?>
				    </select>

                    <h3>Interval</h3>
                    <select id ="selectStartYear">
                    <option value="start">Start</option>
                    <?php
                    	$result = getDisplayDateYears();
                        while ($row = mysqli_fetch_array($result)) {
                            echo '<option value='.$row["displayDate"].'>'.$row["displayDate"].'</option>';
                        }
                    ?>
				    </select>
			        <select id ="selectEndYear">
                    <option value="slut">Slut</option>
                        <?php
                        	$result = getDisplayDateYears();
                            while ($row = mysqli_fetch_array($result)) {
                                echo '<option value='.$row["displayDate"].'>'.$row["displayDate"].'</option>';
                            }
                        ?>
			        </select>
			        <input id="btnSubmit" type="submit" value="Vælg"/>
                </div>
                <div id="menu2" class="tab-pane fade">
                    <h3>Værktyper</h3>
                    <div class = "row">
                    <div class="col-sm-12 classification-filters">

                    <?php
                        $result = getClassifications();
                            while ($row = mysqli_fetch_array($result)) {
                                    echo '<div class="col-sm-6">';
                                    echo    '<div class="checkbox">';
                                    echo    '<label><input type="checkbox" checked="checked" id="'.$row["classifications"].' name="'.$row["classifications"].'      value="'.$row["classifications"].'">'.$row["classifications"].'</label>';
                                    echo    '</div>';
                                    echo '</div>';
                            }
                    ?>
                    </div>
                    </div>
                </div>
                <div id="menu3" class="tab-pane fade">
                    <h3>Menu 3 </h3>
                    <p>Eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
                </div>
            </div>
        </div><!-- End of menu -->
        <div class = "col-sm-4" id = "graphContent">
        <!-- Graph will be appended here -->
        </div><!-- End of graph -->
        <div class = "col-sm-2 pull-right" id = activeParameters>
            <h3> Aktive parametre </h3>
            <h5><u> Regioner:</u> </h5>
            <div id = "aktiveRegioner">
                Alle
            </div>
            <h5><u> Årstal:</u> </h5>
            <div id = "aktiveÅr">
                1918 - 2016
            </div>
            <h5><u> Værktyper </u></h5>
            <div id = "aktiveTyper">
                Alle
            </div>
            <h5><u> OnDisplay </u></h5>
            <div id = "onDisplay">
                Begge
            </div>
        </div>
        <!-- Details on demand -->
        <div id="dod" style="display:none"></div>
    </div><!-- End of Row -->
</div><!-- End of container -->
<!-- Details on demand Div -->
<script src = "js/effects.js"></script>
<script src = "js/tabMenu.js"></script>

<!--Script til at manipulere data via HTML inputs -->
<script>

	var dataset = <?php echo $dataset ?>;
    //Hvis nogle af nedstående variable er sat til null vil de ikke være gældende eller gælde for alle.
	var year, startYear, endYear;
    onView = null;

    //Filter arrays
    var classification = {Foto: true, Skulptur: true, Maleri: true, Tegning: true, Grafik: true, Smykker:true, Andet: true,
        Design: true, Relief: true, Akvarel: true, Tekstil: true, Keramik: true, Collage: true, Glas: true, Møbel: true,
        Digital:true, Video:true, "Integreret kunst":true, Indretning: true, Print:true, "Mixed Media":true, "Grafisk design":true,
        Performance:true, Installation:true, Lys:true}
	var regions = {Hovedstaden:true, Midtjylland:true, Nordjylland:true, Sjælland:true, Syddanmark:true, UdenforDanmark:true};

	//Kører hver gang der ændres på en checkboks under filter
	$('.region-filters input:checkbox').click(function() {
		var name = $(this).val().trim();
		if(regions[name] == true) regions[name] = false;
        else regions[name] = true;
        updateRegioner(regions);
        updateData();
	});

	$('.classification-filters input:checkbox').click(function() {
		var name = $(this).val().trim();
        if(classification[name] == true) classification[name] = false;
        else classification[name] = true;
        updateVærktyper(classification);
        updateData();
	});

        $('.onView-filter input:radio').click(function() {
        var name = $(this).val().trim();
        if(name == "til") onView = true;
        else if(name == "fra") onView = false;
        else onView = null;
        updateData();
    });

	//Ændre i year til single view ved klik på dropdown menu
	$('#selectSingleYear').change(function() {
		$('#selectStartYear').val("start");
		$('#selectEndYear').val("slut");
   		endYear = null;
    	startYear = null;
    	year = $(this).val();
    	if(year=="Alle"){year=null; updateData(); return;}
    	updateData();
	});

	//Ændre i intervallet. Denne funktion kalder når knappen vælg trykkes
	$("#btnSubmit").click(function(){
		$('#selectSingleYear').val("Vaelg");
		year = null;
		startYear = $('#selectStartYear').val();
		endYear = $('#selectEndYear').val();
       	updateData();
    });

    function updateData(){
        var newData = new Array();
        //Kopiere de relevante regioner og typer ind i newData
        for (var key in regions) {
            if(regions[key]==true) {
                var typer = new Array();
                for(var type in classification){
                    if(classification[type]==true) typer.push({classifications:type, antal:0});
                }
                var tmpArr = {region:key, antal:0, typer};
                newData.push(tmpArr);
            }
        }

        if(onView == true)
            {newData = countData("true", "true", newData);}

        else if(onView == false)
            {newData = countData("false", "false", newData);}

        else if(onView == null)
            {newData = countData("true", "false", newData);}

        drawDiagram(newData);
    }

    function countData(what, what2, newData){
        //Single år er valgt
            if(year != null){
                console.log("I year != null. Year: "+year);
                for (var i = 0; i < Object.keys(dataset).length; i++) {
                    if(regions[dataset[i].region] == true && classification[dataset[i].classifications] == true
                        && dataset[i].displayDate == year && (dataset[i].onView == what || dataset[i].onView == what2) ){
                        for (var j = 0; j < Object.keys(newData).length; j++) {
                            if(newData[j].region == dataset[i].region){
                                newData[j].antal = parseFloat(newData[j].antal) + parseFloat(dataset[i].antal);
                                for (var h = 0; h < Object.keys(newData[j].typer).length; h++) {
                                    if(newData[j].typer[h].classifications == dataset[i].classifications){
                                        newData[j].typer[h].antal =parseFloat(newData[j].typer[h].antal) + parseFloat(dataset[i].antal); break;
                                    }

                                };
                            }
                        };
                    }
                };
            }
            //Interval år er valgt
            else if(startYear != null && endYear != null){
                console.log("I startYear != null");
                for (var i = 0; i < Object.keys(dataset).length; i++) {
                    if(regions[dataset[i].region] == true && classification[dataset[i].classifications] == true
                        && dataset[i].displayDate > startYear && dataset[i].displayDate < endYear
                        && (dataset[i].onView == what || dataset[i].onView == what2) ){
                        for (var j = 0; j < Object.keys(newData).length; j++) {
                            if(newData[j].region == dataset[i].region){
                                newData[j].antal = parseFloat(newData[j].antal) + parseFloat(dataset[i].antal);
                                for (var h = 0; h < Object.keys(newData[j].typer).length; h++) {
                                    if(newData[j].typer[h].classifications == dataset[i].classifications){
                                        newData[j].typer[h].antal =parseFloat(newData[j].typer[h].antal) + parseFloat(dataset[i].antal); break;
                                    }

                                };
                            }
                        };
                    }
                };
            }
            //Intet år er valgt
            else {
                for (var i = 0; i < Object.keys(dataset).length; i++) {
                    if(regions[dataset[i].region] == true && classification[dataset[i].classifications] == true
                        && (dataset[i].onView == what || dataset[i].onView == what2) ){
                        for (var j = 0; j < Object.keys(newData).length; j++) {
                            if(newData[j].region == dataset[i].region){
                                newData[j].antal = parseFloat(newData[j].antal) + parseFloat(dataset[i].antal);
                                for (var h = 0; h < Object.keys(newData[j].typer).length; h++) {
                                    if(newData[j].typer[h].classifications == dataset[i].classifications){
                                        newData[j].typer[h].antal =parseFloat(newData[j].typer[h].antal) + parseFloat(dataset[i].antal); break;
                                    }

                                };
                            }
                        };
                    }
                };
            }
            return newData;
    }
    /*
	function updateData(){
		var newData = new Array();
		//Laver newData indeholdende alle regioner som er true
        for (var key in regions) {
        	if(regions[key]==true) {
        		var tmpArr = {region:key, antal:0};
        		newData.push(tmpArr);
        	}
        }

        //Hvis single år er valgt
        if(year != null){
	        for (var i = 0; i < Object.keys(dataset).length; i++) {
	            if(regions[dataset[i].region] == true && classification[dataset[i].classifications] == true && dataset[i].displayDate == year){
	                for (var j = 0; j < Object.keys(newData).length; j++) {
	                	if(newData[j].region == dataset[i].region){
	                		newData[j].antal = parseFloat(newData[j].antal) + parseFloat(dataset[i].antal); break;}
	                };
	            }
	            else continue;
	        }
        }
        //Hvis årsinterval er valgt
        else if(startYear != null && endYear != null){
        	for (var i = 0; i < Object.keys(dataset).length; i++) {
	            if(regions[dataset[i].region] == true && classification[dataset[i].classifications] == true && dataset[i].displayDate > startYear && dataset[i].displayDate < endYear){
	                for (var j = 0; j < Object.keys(newData).length; j++) {
	                	if(newData[j].region == dataset[i].region){
	                		newData[j].antal = parseFloat(newData[j].antal) + parseFloat(dataset[i].antal); break;}
	                };
	            }
	            else continue;
	        }
        }
        //Hvis alle år er valgt
        else{
        	for (var i = 0; i < Object.keys(dataset).length; i++) {
                    if(regions[dataset[i].region] == true && classification[dataset[i].classifications] == true){
                        for (var j = 0; j < Object.keys(newData).length; j++) {
                        	if(newData[j].region == dataset[i].region){
                        		newData[j].antal = parseFloat(newData[j].antal) + parseFloat(dataset[i].antal); break;}
                        };
                    }
                    else continue;
            }
        }
        drawDiagram(newData);
	}
    */

	updateData();


	function drawDiagram(data){
		//Fjerner gammel graf
        d3.select("svg").remove();

        //Sorterer data fra parametreret ascending order
		data.sort(function(a,b){
			return parseFloat(a.antal) - parseFloat(b.antal);
		});

		//Sætter variable
		var margin = {top: 10, right: 0, bottom: 10, left: 40};
		var w = 500, h = 500;

		//Laver svg element til at komme figuren
		var svg = d3.select("#graphContent").append("svg").attr("id","graph").attr("width", w).attr("height", h);

		//Laver scale
		var min = data[0].antal;
		var max = data[Object.keys(data).length-1].antal;
		var yScale = d3.scale.linear().domain([0,max]).range([h-margin.top-margin.bottom,margin.top]).nice();
		var xScale = d3.scale.ordinal().domain(data.map(function (d){return d.region})).rangeRoundBands([margin.left, w-margin.left-margin.right], 0.1);

        //From tooltip.js
        svg.call(tip);

		//Tegner rectangels
		svg.selectAll("rect").data(data).enter()
        .append("svg:a")
        .attr("xlink:href", function(d){return "index.php?" + d.region;})
        .append("rect")
        .attr("class",function(d,i){return "rectangle"})
        .attr("id",function(d,i){return d.region})
		.attr("x",function(d,i){ return xScale(d.region)})
		.attr("y", function (d){ return yScale(d.antal)})
		.attr("width", xScale.rangeBand() )
		.attr("height", function (d){ return yScale(0) - yScale(d.antal) })
        .on('mouseover', tip.show)
        .on('mouseout', tip.hide);

        //Bygger akser
		var xAxis = d3.svg.axis().scale(xScale).orient("bottom");
		svg.append("g").attr("class", "axis").attr("transform","translate(0,"+(h-margin.top-margin.bottom)+")").call(xAxis);
		var yAxis = d3.svg.axis().scale(yScale).orient("left").ticks(15);
		svg.append("g").attr("class", "axis").attr("transform", "translate("+margin.left+",0)").call(yAxis);
	}
</script>
</body>
<script src = "js/parametersHistogram.js"></script>
<script>
    $(".rectangle").hover(function(event) {
        $("#dod").css({top: event.clientY, left: event.clientX}).show();
        console.log("HERE");
    }, function() {
        $("#dod").hide();
    });
</script>
</head>