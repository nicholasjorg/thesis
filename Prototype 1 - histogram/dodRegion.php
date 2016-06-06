<?php require("functions.php"); ?>
<?php require("getMunicipalityData.php"); ?>
<?php require("getNogletal.php"); ?>


<!-- Header -->
<?php require("header.php");?>
<!-- context php-->
<?php require("getUrlVariables.php");?>
<!-- context js -->
<script src = "js/dodForms.js"></script>

<div class = "container">
    <div class = "row text-center">
        <h1><span style="visibility: hidden">Region:&nbsp;</span><span id = "overskrift">Hovedstaden</span></h1>
    </div>
    <div class = "row">
        <div class = "col-sm-4">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#home">Region</a></li>
                <li><a href="#menu1">Årstal</a></li>
                <li><a href="#menu2">Værktyper</a></li>
                <li><a href="#menu3">Statistik</a></li>
            </ul>
            <div class="tab-content">
                <div id="home" class="tab-pane fade in active row">
                    <div class="col-sm-12 region-filters">
                    <h3>Region</h3>
                        <div class ="radio"><label><input type="radio" checked="checked" onchange="updateSingleRegion(this);" id="radioHovedstaden" name="regions" value="Hovedstaden">Hovedstaden</label>
                        </div>
                        <div class="radio">
                          <label><input type="radio" onchange="updateSingleRegion(this);" id="radioMidtjylland"  name="regions" value="Midtjylland">Midtjylland</label>
                        </div>
                        <div class="radio">
                          <label><input type="radio" onchange="updateSingleRegion(this);" id="radioNordjylland" name="regions" value="Nordjylland">Nordjylland</label>
                        </div>
                        <div class="radio">
                          <label><input type="radio" onchange="updateSingleRegion(this);" id="radioSjælland" name="regions" value="Sjælland">Sjælland</label>
                        </div>
                        <div class="radio">
                          <label><input type="radio" onchange="updateSingleRegion(this);" id="radioSyddanmark" name="regions" value="Syddanmark">Syddanmark</label>
                        </div>
                        <div class="radio">
                          <label><input type="radio" onchange="updateSingleRegion(this);" id="radioUdenfor Danmark" name="regions" value="UdenforDanmark">Udenfor Danmark</label>
                        </div>
                    </div>
                    <div class = "row">
                        <div id="kommuner" class="col-sm-12">Her ligger kommunerne i den valgte region
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
                            <div class ="row">
                                <div class="col-sm-6">
                                    <div class="checkbox"><label><input type ="checkbox"checked="checked" id ="Væg" name ="Væg" value ="Væg"><b>Væg</b></label>
                                    </div>
                                    <div class="checkbox subCheck"><label><input class = "subVæg" type ="checkbox"checked="checked" id ="Foto" name ="Foto" value =""Foto>Foto</label>
                                    </div>
                                    <div class="checkbox subCheck"><label><input class = "subVæg" type ="checkbox"checked="checked" id ="Maleri" name ="Maleri" value ="Maleri">Maleri</label>
                                    </div>
                                    <div class="checkbox subCheck"><label><input class = "subVæg" type ="checkbox"checked="checked" id ="Tegning" name ="Tegning" value ="Tegning">Tegning</label>
                                    </div>
                                    <div class="checkbox subCheck"><label><input class = "subVæg" type ="checkbox"checked="checked" id ="Grafik" name ="Grafik" value ="Grafik">Grafik</label>
                                    </div>
                                    <div class="checkbox subCheck"><label><input class = "subVæg" type ="checkbox"checked="checked" id ="Collage" name ="Collage" value ="Collage">Collage</label>
                                    </div>
                                    <div class="checkbox subCheck"><label><input class = "subVæg" type ="checkbox"checked="checked" id ="Akvarel" name ="Akvarel" value ="Akvarel">Akvarel</label>
                                    </div>
                                    <div class="checkbox subCheck"><label><input class = "subVæg" type ="checkbox"checked="checked" id ="Print" name ="Print" value ="Print">Print</label>
                                    </div>
                                    <div class="checkbox subCheck"><label><input class = "subVæg" type ="checkbox"checked="checked" id ="Grafisk design" name ="Grafisk design" value ="Grafisk design">Grafisk Design</label>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <!-- Rum -->
                                    <div class="checkbox"><label><input type ="checkbox"checked="checked" id ="Rum" name ="Rum" value ="Rum"><b>Rum</b></label>
                                    </div>
                                    <div class="checkbox subCheck"><label><input class="subRum" type ="checkbox"checked="checked" id ="Lys" name ="Lys" value ="Lys">Lys</label>
                                    </div>
                                    <div class="checkbox subCheck"><label><input class="subRum" type ="checkbox"checked="checked" id ="Indretning" name ="Indretning" value ="Indretning">Indretning</label>
                                    </div>
                                    <div class="checkbox subCheck"><label><input class="subRum" type ="checkbox"checked="checked" id ="Integreret kunst" name ="Integreret kunst" value ="Integreret kunst">Integreret kunst</label>
                                    </div>
                                    <div class="checkbox subCheck"><label><input class="subRum" type ="checkbox"checked="checked" id ="Møbel" name ="Møbel" value ="Møbel">Møbel</label>
                                    </div>
                                    <div class="checkbox subCheck"><label><input class="subRum" type ="checkbox"checked="checked" id ="Skulptur" name ="Skulptur" value ="Skulptur">Skulptur</label>
                                    </div>
                                    <div class="checkbox subCheck"><label><input class="subRum" type ="checkbox"checked="checked" id ="Relief" name ="Relief" value ="Relief">Relief</label>
                                    </div>
                                    <div class="checkbox subCheck"><label><input class="subRum" type ="checkbox"checked="checked" id ="Installation" name ="Installation" value ="Installation">Installation</label>
                                    </div>
                                </div>
                            </div><!-- END ROW-->
                                <div class ="row">
                                    <div class="col-sm-6">
                                        <!-- Immateriel-->
                                        <div class="checkbox"><label><input type ="checkbox"checked="checked" id ="Immateriel" name ="Immateriel" value ="Immateriel"><b>Immateriel</b></label>
                                        </div>
                                        <div class="checkbox subCheck"><label><input class ="subImmateriel" type ="checkbox"checked="checked" id ="Performance" name ="Performance" value ="Performance">Performance</label>
                                        </div>
                                        <div class="checkbox subCheck"><label><input class ="subImmateriel" type ="checkbox"checked="checked" id ="Mixed Media" name ="Mixed Media" value ="Mixed Media">Mixed Media</label>
                                        </div>
                                        <div class="checkbox subCheck"><label><input class ="subImmateriel" type ="checkbox"checked="checked" id ="Video" name ="Video" value ="Video">Video</label>
                                        </div>
                                        <div class="checkbox subCheck"><label><input class ="subImmateriel" type ="checkbox"checked="checked" id ="Digital" name ="Digital" value ="Digital">Digital</label>
                                        </div>
                                    </div>
                                    <div class ="col-sm-6">
                                        <!-- Genstand-->
                                        <div class="checkbox"><label><input type ="checkbox"checked="checked" id ="Genstand" name ="Genstand" value ="Genstand"><b>Genstand</b></label>
                                        </div>
                                        <div class="checkbox subCheck"><label><input class="subGenstand" type ="checkbox"checked="checked" id ="Smykker" name ="Smykker" value ="Smykker">Smykker</label>
                                        </div>
                                        <div class="checkbox subCheck"><label><input class="subGenstand" type ="checkbox"checked="checked" id ="Design" name ="Design" value ="Design">Design</label>
                                        </div>
                                        <div class="checkbox subCheck"><label><input class="subGenstand" type ="checkbox"checked="checked" id ="Tekstil" name ="Tekstil" value ="Tekstil">Tekstil</label>
                                        </div>
                                        <div class="checkbox subCheck"><label><input class="subGenstand" type ="checkbox"checked="checked" id ="Keramik" name ="Keramik" value ="Keramik">Keramik</label>
                                        </div>
                                        <div class="checkbox subCheck"><label><input class="subGenstand" type ="checkbox"checked="checked" id ="Glas" name ="Glas" value ="Glas">Glas</label>
                                        </div>
                                    </div>
                                </div>
                                <div class ="row">
                                    <div class ="col-sm-6">
                                        <div class="checkbox"><label><input type ="checkbox"checked="checked" id ="Andet" name ="Andet" value ="Andet"><b>Andet</b></label>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
                <div id="menu3" class="tab-pane fade">
                    <div class="checkbox" id ="gennemsnitWrapper">
                        <label><input type="checkbox" id="gennemsnit" name="gennemsnit" value="gennemsnit">Gennemsnit</label>
                    </div>
                    <div class="checkbox" id="indbyggertalWrapper">
                        <label><input type="checkbox" id="indbyggertalCheck" value="indbyggertal">Indbyggertal</label>
                    </div>
                </div>
            </div>
        </div><!-- End of menu -->
        <div class = "col-sm-4" id = "graphContent">
        <!-- Graph will be appended here -->
        </div><!-- End of graph -->
        <div class = "col-sm-2 pull-right" id = "activeParameters">
            <h3> Region: </h3>
            <div id = "aktiveRegion">
                <?php
                if (isset($_GET['region'])){
                    echo $_GET['region'];
                }
                else echo "Hovedstaden";
                ?>
            </div>
            <h3>Årstal:</h3>
            <div id = "aktiveÅr">
                1918 - 2016
            </div>
            <h3> Værktyper:</h3>
            <div id = "aktiveTyper">
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
    var indbyggerTabel = <?php echo $indbyggertal ?>;
    var indbyggertal;
    
    //Hvis nogle af nedstående variable er sat til null vil de ikke være gældende eller gælde for alle.
	var year, startYear, endYear, classification, currentRegion, municipalities;
    <?php
    if (isset($_GET['year'])){
        echo 'year=' . $year;
        echo "updateActiveYears();";
    }
    else echo 'year=null';
    if (isset($_GET['startYear'])){
        echo ' startYear=' . $startYear;
        echo ' endYear=' . $endYear;
        echo "updateActiveYears();";
    }
    ?>
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

    function createIndbyggertalKommuner(){
        var tmpMuni = <?php echo $municipalities ?>;
        indbyggertal = {Hovedstaden, Midtjylland, Nordjylland, Sjælland, Syddanmark, UdenforDanmark};

        indbyggertal.Hovedstaden = {};
        indbyggertal.Midtjylland = {};
        indbyggertal.Nordjylland = {};
        indbyggertal.Sjælland = {};
        indbyggertal.Syddanmark = {};
        indbyggertal.UdenforDanmark = {};

        for (var i = 0; i < Object.keys(tmpMuni).length; i++) {
            var muni = tmpMuni[i].municipality;
            switch (tmpMuni[i].region){
            case "Hovedstaden": indbyggertal.Hovedstaden[muni] = 0; break;
            case "Midtjylland": indbyggertal.Midtjylland[muni] = 0; break;
            case "Nordjylland": indbyggertal.Nordjylland[muni] = 0; break;
            case "Sjælland": indbyggertal.Sjælland[muni] = 0; break;
            case "Syddanmark": indbyggertal.Syddanmark[muni] = 0; break;
            case "UdenforDanmark": indbyggertal.UdenforDanmark[muni] = 0; break;
            }
        }
    }

    function createMunicipalities(){
        var tmpMuni = <?php echo $municipalities ?>;
        municipalities = {Hovedstaden, Midtjylland, Nordjylland, Sjælland, Syddanmark, UdenforDanmark};

        municipalities.Hovedstaden = {};
        municipalities.Midtjylland = {};
        municipalities.Nordjylland = {};
        municipalities.Sjælland = {};
        municipalities.Syddanmark = {};
        municipalities.UdenforDanmark = {};

        for (var i = 0; i < Object.keys(tmpMuni).length; i++) {
            var muni = tmpMuni[i].municipality;
            switch (tmpMuni[i].region){
            case "Hovedstaden": municipalities.Hovedstaden[muni] = true; break;
            case "Midtjylland": municipalities.Midtjylland[muni] = true; break;
            case "Nordjylland": municipalities.Nordjylland[muni] = true; break;
            case "Sjælland": municipalities.Sjælland[muni] = true; break;
            case "Syddanmark": municipalities.Syddanmark[muni] = true; break;
            case "UdenforDanmark": municipalities.UdenforDanmark[muni] = true; break;
            }
        }
    }

    createMunicipalities();
    createIndbyggertalKommuner();
    chooseRegion();
    updateMunicipalities();
    updateData();

    updateDashboardRegion("radio" + currentRegion);

	//Kører hver gang der ændres på en checkboks under filter
	$('.region-filters input:radio').click(function() {
		var name = $(this).val().trim();
        currentRegion = name;
        console.log(currentRegion);
        chooseRegion();
        updateData();
        updateMunicipalities();
	});

    $('.classification-filters input:checkbox').click(function() {
        var name = $(this).val().trim();
        //Hvis det er flere
        if(name === "Væg" || name === "Rum" || name === "Immateriel" || name === "Genstand"){
            var className = "sub"+name;
            var relevantCheckboxes = $(".sub"+name);
            if($("#"+name).is(':checked')){
                //Put alle på
                relevantCheckboxes.prop("checked",true);
                var ids = $("."+className).map(function() { return this.id; });

                for(var i = 0; i<ids.length;i++){
                    classification[ids[i]]=true;
                }
                updateVærktyper(classification);
                updateData();
            }
            else{
                //Tag alle fra
                relevantCheckboxes.prop("checked",false);
                var ids = $("."+className).map(function() { return this.id; });
                for(var i = 0; i<ids.length;i++){
                    classification[ids[i]]=false;
                }
                updateVærktyper(classification);
                updateData();
            }
            return;
        }
        //Hvis det er en single
        if(classification[name] == true) classification[name] = false;
        else classification[name] = true;
        updateVærktyper(classification);
        updateData();
    });

    $("#kommuner").on("click", "input", function(){
        var id = $(this).val().trim();
        if(municipalities[currentRegion][id] == true) municipalities[currentRegion][id] = false;
        else municipalities[currentRegion][id] = true;
        console.log(municipalities[currentRegion]);
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

    //Ændre i tabellen udfra indbyggertallet i kommunen.
    $("#indbyggertalCheck").click(function(){
        if($("#indbyggertalCheck").prop('checked')){
            if(year != null && year>=1993){
                for(var i=0; i<Object.keys(indbyggerTabel).length; i++){
                    if(indbyggerTabel[i].region == currentRegion){
                        for (var key in indbyggertal[currentRegion]) {
                            if(indbyggerTabel[i].kommune == key)
                                indbyggertal[currentRegion][key] = parseFloat(indbyggerTabel[i][year]);
                            else
                                continue;
                        }
                    }
                }
                updateIndbyggerDiagram(newData);
            }
            else if(startYear>=1993 && endYear<=2016){
                for(var i=0; i<Object.keys(indbyggerTabel).length; i++){
                    if(indbyggerTabel[i].region == currentRegion){
                        console.log(indbyggerTabel[i].region + currentRegion);
                        for (var key in indbyggertal[currentRegion]) {
                            if(indbyggerTabel[i].kommune == key)
                                indbyggertal[currentRegion][key] = parseFloat(indbyggerTabel[i][endYear]);
                            else
                                continue;
                        }
                    }
                }
                updateIndbyggerDiagram(newData);

            }
            else{
                alert("Du har valgt et år hvor der ikke findes data. Vælg et år eller interval mellem 1993 og 2016");
                document.getElementById("indbyggertalCheck").checked = false;
            }
            console.log(indbyggertal);
        }
        else{ 
            updateData();
            for (var key in indbyggertal[currentRegion]) {
                 indbyggertal[currentRegion][key] = 0;
            }
        }
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
    }

    function updateMunicipalities(){
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("kommuner").innerHTML = xmlhttp.responseText;
            }
        };
        xmlhttp.open("GET","changeMuni.php?data="+JSON.stringify(municipalities[currentRegion]),true);
        xmlhttp.send();
    }

    function updateData(){
        newData = new Array();
        //Kopiere de relevante regioner og typer ind i newData
        for(key in municipalities[currentRegion]){
            if(municipalities[currentRegion][key] == false) continue;
            if(municipalities[currentRegion][key] == true){
                var typer = new Array();
                for(var type in classification){
                    if(classification[type]==true) typer.push({classifications:type, antal:0});
                }
            }
            var tmpArr = {kommune:key, antal:0, typer};
            newData.push(tmpArr);
        }

        newData = countData(newData);
        //Sorterer data fra parametreret ascending order
        newData.sort(function(a,b){
            return parseFloat(a.antal) - parseFloat(b.antal);
        });
        drawDiagram(newData);

        document.getElementById("indbyggertalCheck").checked = false;
        document.getElementById("gennemsnit").checked = false;
    }

    function countData(newData){
        for (var i = 0; i < Object.keys(dataset).length; i++) {
            if(dataset[i].municipality == null){continue;}
            for(kommune in municipalities[currentRegion]){
                if(municipalities[currentRegion][kommune] == false) continue;
                if (municipalities[currentRegion][kommune] == true && dataset[i].displayDate == year && dataset[i].displayDate != null
                || (municipalities[currentRegion][kommune] == true && dataset[i].displayDate >= startYear && dataset[i].displayDate <= endYear )
                || (municipalities[currentRegion][kommune] == true && year == null && startYear == null && endYear == null)) {
                    for (var h = 0; h < Object.keys(newData).length; h++) {
                        if(newData[h].kommune == dataset[i].municipality){
                            newData[h].antal = parseFloat(newData[h].antal) + 1; break;
                        }
                    };
                break;
                }
            }

        };
            return newData;
    }

    function updateIndbyggerDiagram(newData){
        for(var i=0; i<Object.keys(newData).length; i++){
            var key = newData[i].kommune;
            if(indbyggertal[currentRegion][key] == 0)
                newData[i].antal = 0;
            else
                newData[i].antal = newData[i].antal / indbyggertal[currentRegion][key];
        }
        drawDiagram(newData);
    }


    function drawDiagram(data){
        //Fjerner gammel graf
        d3.select("svg").remove();

        //Sætter variable
        var margin = {top: 10, right: 0, bottom: 100, left: 40};
        var w = 500, h = 600;

        //Laver svg element til at komme figuren
        var svg = d3.select("#graphContent").append("svg").attr("id","graph").attr("width", w).attr("height", h);


        //Laver scale
        var min = data[0].antal;
        var max = data[Object.keys(data).length-1].antal;
        var yScale = d3.scale.linear().domain([0,max]).range([h-margin.top-margin.bottom,margin.top]).nice();
        var xScale = d3.scale.ordinal().domain(data.map(function (d){return d.kommune})).rangeRoundBands([margin.left, w-margin.left-margin.right], 0.1);

        //From tooltip.js
        svg.call(tip);

        //Tegner rectangels
        svg.selectAll("rect").data(data).enter()
        //.append("svg:a")
        //.attr("xlink:href", function(d){return "dodRegion.php?region="+d.region+"&year="+year+"&startYear="+startYear+"&endYear="+endYear+"&typer="+JSON.stringify(classification);})
        .append("rect")
        .attr("class",function(d,i){return "rectangle"})
        .attr("id",function(d,i){return d.kommune})
        .attr("x",function(d,i){ return xScale(d.kommune);})
        .attr("y", function (d){ return yScale(d.antal)})
        .attr("width", xScale.rangeBand() )
        .attr("height", function (d){ return yScale(0) - yScale(d.antal) });
        // .on('mouseover', tip.show)
        // .on('mouseout', tip.hide);

        //Bygger akser
        var xAxis = d3.svg.axis().scale(xScale).orient("bottom");
        svg.append("g")
        .attr("class", "axis")
        .attr("transform","translate(0,"+(h-margin.top-margin.bottom)+")")
        .call(xAxis)
        .selectAll("text")
        .style("text-anchor", "end")
        .attr("dx", "-.8em")
        .attr("dy", ".15em")
        .attr("transform", function(d) {
            return "rotate(-65)"
        });

        var yAxis = d3.svg.axis().scale(yScale).orient("left").ticks(15);
        svg.append("g").attr("class", "axis").attr("transform", "translate("+margin.left+",0)").call(yAxis);

    }

    function drawPie(regionData){
        d3.select("svg").remove();
        var color = d3.scale.category20();
        var pie = d3.layout.pie().value(function(d){return d.antal});
        var w = 400;
        var h = 400;
        var outerRadius = w/2;
        var innerRadius = 0;
        var arc = d3.svg.arc().innerRadius(innerRadius).outerRadius(outerRadius);
        var svg = d3.select("#graphContent").append("svg").attr("id","graf").attr("width",w).attr("height",h);
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