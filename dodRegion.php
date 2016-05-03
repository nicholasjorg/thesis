<?php require("functions.php"); ?>
<?php require("getMunicipalityData.php"); ?>

<!-- Header -->
<?php require("header.php");?>
<!-- context php-->
<?php require("getUrlVariables.php");?>
<!-- context js -->
<script src = "js/dodForms.js"></script>

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
                        <div class ="radio"><label><input type="radio" checked="checked" id="radioHovedstaden" name="regions" value="Hovedstaden">Hovedstaden</label>
                        </div>
                        <div class="radio">
                          <label><input type="radio" id="radioMidtjylland" name="regions" value="Midtjylland">Midtjylland</label>
                        </div>
                        <div class="radio">
                          <label><input type="radio" id="radioNordjylland" name="regions" value="Nordjylland">Nordjylland</label>
                        </div>
                        <div class="radio">
                          <label><input type="radio" id="radioSjælland" name="regions" value="Sjælland">Sjælland</label>
                        </div>
                        <div class="radio">
                          <label><input type="radio" id="radioSyddanmark" name="regions" value="Syddanmark">Syddanmark</label>
                        </div>
                        <div class="radio">
                          <label><input type="radio" id="radioUdenfor Danmark" name="regions" value="UdenforDanmark">Udenfor Danmark</label>
                        </div>
                        <div class = "row">
                        <div class="onView-filter">
                            <h3 id><span id = "hey">OnDisplay</span></h3>
                            <p><div class = "col-sm-1"><input type="radio" name="onView" value="Begge" checked= "checked"/></div><label>Alle</label></p>
                            <p><div class = "col-sm-1"><input type="radio" name="onView" value="Til" /></div><label>True</label></p>
                            <p><div class = "col-sm-1"><input type="radio" name="onView" value="Fra" /></div><label>False</label></p>
                        </div>
                        </div>
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
        <div class = "col-sm-2 pull-right" id = "activeParameters">
            <h3> Aktive parametre </h3>
            <h5><u> Region:</u> </h5>
            <div id = "aktiveRegioner">
                <?php
                if (isset($_GET['region'])){
                    echo $region;
                }
                else echo "Hovedstaden";
                ?>
            </div>
            <h5><u> Årstal:</u> </h5>
            <div id = "aktiveÅr">
                1918 - 2016
            </div>
            <h5><u> Værktyper:</u></h5>
            <div id = "aktiveTyper">
                Alle
            </div>
            <h5><u> OnView:</u></h5>
            <div id = "onView">
                Alle
            </div>
        </div>
        <!-- Details on demand -->
        <div id="dod" style="display:none"></div>
    </div><!-- End of Row -->
</div><!-- End of container -->
<!-- Details on demand Div -->
<script src = "js/effects.js"></script>
<script src = "js/tabMenu.js"></script>
<script src = "js/parametersHistogram.js"></script>

<!--Script til at manipulere data via HTML inputs -->
<script>
    var newData = new Array();
    var Hovedstaden, Midtjylland, Nordjylland, Sjælland, Syddanmark, UdenforDanmark;
	var data = {Hovedstaden, Midtjylland, Nordjylland, Sjælland, Syddanmark, UdenforDanmark};
    var dataset;
    //Hvis nogle af nedstående variable er sat til null vil de ikke være gældende eller gælde for alle.
	var year, startYear, endYear, onView, classification, currentRegion, municipalities;
    <?php
    if (isset($_GET['year'])){
        echo 'year=' . $year;
        echo "updateActiveYears();";
    }
    if (isset($_GET['startYear'])){
        echo ' startYear=' . $startYear;
        echo ' endYear=' . $endYear;

        echo "updateActiveYears();";
    }
    ?>
    <?php
    if (isset($_GET['onView'])){
        echo "onView=".$onView;
        echo "updateOnView();";
    }
    ?>;
    //Filter arrays
    <?php
        if (isset($_GET['typer'])){
            echo "classification=".$typer;
            // echo "updateVærktyper();";
        }
        else echo 'classification = {Foto: true, Skulptur: true, Maleri: true, Tegning: true, Grafik: true, Smykker:true, Andet: true,
            Design: true, Relief: true, Akvarel: true, Tekstil: true, Keramik: true, Collage: true, Glas: true, Møbel: true,
            Digital:true, Video:true, "Integreret kunst":true, Indretning: true, Print:true, "Mixed Media":true, "Grafisk design":true,
            Performance:true, Installation:true, Lys:true};';
        echo "updateVærktyper(classification);";
    ?>
    <?php
        if (isset($_GET['region'])){
            echo "currentRegion=".$region;
        }
        else echo 'currentRegion="Hovedstaden";';
    ?>

    data.Hovedstaden = <?php echo $hovedstaden ?>;
    data.Midtjylland = <?php echo $midtjylland ?>;
    data.Nordjylland = <?php echo $nordjylland ?>;
    data.Sjælland = <?php echo $sjælland ?>;
    data.Syddanmark = <?php echo $syddanmark ?>;
    data.UdenforDanmark = <?php echo $udenfordanmark ?>;
 
    chooseRegion();
    console.log(municipalities);



    updateDashboardRegion("radio" + currentRegion);


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
        updateOnView();
        updateData();
    });

	//Ændre i year til single view ved klik på dropdown menu
	$('#selectSingleYear').change(function() {
		$('#selectStartYear').val("start");
		$('#selectEndYear').val("slut");
   		endYear = null;
    	startYear = null;
    	year = $(this).val();
    	if(year=="Alle") year=null;
        updateActiveYears();
    	updateData();
	});

	//Ændre i intervallet. Denne funktion kalder når knappen vælg trykkes
	$("#btnSubmit").click(function(){
		$('#selectSingleYear').val("Vaelg");
		year = null;
		startYear = $('#selectStartYear').val();
		endYear = $('#selectEndYear').val();
        updateActiveYears();
       	updateData();
    });

    function chooseRegion(){
        switch (currentRegion){
            case "Hovedstaden": dataset = data.Hovedstaden; break;
            case "Midtjylland": dataset = data.Midtjylland; break;
            case "Nordjylland": dataset = data.Nordjylland; break;
            case "Sjælland": dataset = data.Sjælland; break;
            case "Syddanmark": dataset = data.Syddanmark; break;
            case "UdenforDanmark": dataset = data.UdenforDanmark; break;
        }
        changeRegionMunicipalities();
    }

    function changeRegionMunicipalities(){

        for (var i = 0; i < Object.keys(dataset).length; i++) {
            
        }



        municipalities = new Array();
        for (var i = 0; i < Object.keys(dataset).length; i++) {
            if(!contains(municipalities, dataset[i].municipality)){
                    tmpArr = {municipality:dataset[i].municipality, display:true};
                    municipalities.push(tmpArr);
            }
        };
    }
    function contains(a, obj) {
        var i = Object.keys(a).length;
        while (i--) {
           if (a[i].municipality === obj) {
               return true;
           }
        }
        return false;
    }

    console.log(municipalities[1].municipality);


    function updateData(){
        newData = new Array();
        //Kopiere de relevante regioner og typer ind i newData

        // for (var i = 0; i < Object.keys(dataset).length; i++) {
        //     if(dataset[i].municipality == municipalities.municipality && municipalities.display == true)
        // };

        for (var i = 0; i < Object.keys(municipalities).length; i++) {
            if(municipalities[i].display == true){
                var typer = new Array();
                for(var type in classification){
                    if(classification[type] == true) typer.push({classifications:type, antal:0});
                }
                var tmpArr = {municipality:municipalities[i].municipality, antal:0, typer};
                newData.push(tmpArr);
            }
        };
        console.log(newData);

        if(onView == true)
            {newData = countData("true", "true", newData);}

        else if(onView == false)
            {newData = countData("false", "false", newData);}

        else if(onView == null)
            {newData = countData("true", "false", newData);}

        console.log(newData);
        drawDiagram(newData);
    }

    function countData(what, what2, newData){
        console.log("I count data");
        //Single år er valgt

        //kopieret ud af if && (dataset[i].onView == what || dataset[i].onView == what2)
            //if(year != null){
                for (var i = 0; i < Object.keys(municipalities).length; i++) {
                    for (var j = 0; j < Object.keys(dataset).length; j++) {
                        if(municipalities[i].municipality == dataset[j].municipality && classification[dataset[j].classifications] == true
                            && dataset[j].displayDate == year){
                            for (var h = 0; h < Object.keys(newData).length; h++) {
                                if(newData[h].municipality == dataset[j].municipality)
                                    newData[h].antal = parseFloat(newData[h].antal) + parseFloat(dataset[j].antal);
                                for (var g = 0; g < Object.keys(newData[h].typer).length; g++) {
                                    // console.log("nuværende antal i typer "+newData[h].typer[g].antal);
                                    // console.log("Vil tilføje "+ dataset[j].antal);
                                    newData[h].typer[g].antal =parseFloat(newData[h].typer[g].antal) + parseFloat(dataset[j].antal); break;
                                };
                            }
                        }

                    };
                };

            // //Interval år er valgt
            // else if(startYear != null && endYear != null){
            //     for (var i = 0; i < Object.keys(dataset).length; i++) {
            //         if(municipalities[dataset[i].municipality] == true && classification[dataset[i].classifications] == true
            //             && dataset[i].displayDate > startYear && dataset[i].displayDate < endYear
            //             && (dataset[i].onView == what || dataset[i].onView == what2) ){
            //             for (var j = 0; j < Object.keys(newData).length; j++) {
            //                 if(newData[j].municipality == dataset[i].municipality){
            //                     newData[j].antal = parseFloat(newData[j].antal) + parseFloat(dataset[i].antal);
            //                     for (var h = 0; h < Object.keys(newData[j].typer).length; h++) {
            //                         if(newData[j].typer[h].classifications == dataset[i].classifications){
            //                             newData[j].typer[h].antal =parseFloat(newData[j].typer[h].antal) + parseFloat(dataset[i].antal); break;
            //                         }

            //                     };
            //                 }
            //             };
            //         }
            //     };
            // }
            // //Intet år er valgt
            // else {
            //     for (var i = 0; i < Object.keys(dataset).length; i++) {
            //         if(municipalities[dataset[i].municipality] == true && classification[dataset[i].classifications] == true
            //             && (dataset[i].onView == what || dataset[i].onView == what2) ){
            //             for (var j = 0; j < Object.keys(newData).length; j++) {
            //                 if(newData[j].municipality == dataset[i].municipality){
            //                     newData[j].antal = parseFloat(newData[j].antal) + parseFloat(dataset[i].antal);
            //                     for (var h = 0; h < Object.keys(newData[j].typer).length; h++) {
            //                         if(newData[j].typer[h].classifications == dataset[i].classifications){
            //                             newData[j].typer[h].antal =parseFloat(newData[j].typer[h].antal) + parseFloat(dataset[i].antal); break;
            //                         }

            //                     };
            //                 }
            //             };
            //         }
            //     };
            // }
            return newData;
    }

	// updateData();

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
        var xScale = d3.scale.ordinal().domain(data.map(function (d){return d.municipality})).rangeRoundBands([margin.left, w-margin.left-margin.right], 0.1);

        //From tooltip.js
        svg.call(tip);

        //Tegner rectangels
        svg.selectAll("rect").data(data).enter()
        .append("svg:a")
        .attr("xlink:href", function(d){return "dodRegion.php?region="+d.region+"&year="+year+"&startYear="+startYear+"&endYear="+endYear+"&typer="+JSON.stringify(classification)+"&onView="+onView;})
        .append("rect")
        .attr("class",function(d,i){return "rectangle"})
        .attr("id",function(d,i){return d.municipality})
        .attr("x",function(d,i){ return xScale(d.municipality)})
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

    function drawPie(regionData){
        //d3.select("pieChart").remove();
        var color = d3.scale.category20();
        var pie = d3.layout.pie().value(function(d){return d.antal});
        var w = 300;
        var h = 300;
        var outerRadius = w/2;
        var innerRadius = 100;
        var arc = d3.svg.arc().innerRadius(innerRadius).outerRadius(outerRadius);
        var svg = d3.select("#dod").append("svg").attr("id","pieChart").attr("width",w).attr("height",h);
        var arcs = svg.selectAll("g.arc").data(pie(regionData)).enter().append("g").attr("class", "arc").attr("transform", "translate("+outerRadius+", "+outerRadius+")");
        arcs.append("path").attr("fill", function(d,i){return color(i);}).attr("d",arc);
        arcs.append("text").attr("transform",function(d){return "translate("+arc.centroid(d)+")";}).attr("text-anchor","middle").text(function(d){return d.classifications});
    }

</script>
</body>
<script src = "js/parametersHistogram.js"></script>
<script src = "js/dodForms.js"></script>
<script>
    $(".rectangle").hover(function(event) {
        //Finde region
        var region = this.id;
        //Lave datasæt
        for (var j = 0; j < Object.keys(newData).length; j++) {
            if (newData[j].region == region){
                //Lav grafen
                drawPie(newData[j].typer);
            }
        }
        //Lav Grafen
        //Append graf til div: dod
        //vis div: dod
        $("#dod").css({top: event.clientY, left: event.clientX}).show();
    }, function() {
        $("#dod").hide();
    });
</script>
</head>