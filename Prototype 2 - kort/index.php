<?php require("functions.php"); ?>
<?php require("getNogletal.php") ?>
<?php require ("getMunicipalityData.php"); ?>
<?php require ("getDataset.php"); ?>
<!-- Header -->
<?php require("header.php");?>

<script src="http://d3js.org/d3.v3.min.js" charset="utf-8"></script>

<!--<div class = "container">-->
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
                    <div class="col-sm-12 region-kommune">
                    <h3>Vælg detaljegrad</h3>
                        <div class="radio">
                          <label><input type="radio" checked="checked" id="displayRegioner"  name="displayRegioner" value="displayRegioner">Regioner</label>
                        </div>
                        <div class="radio">
                          <label><input type="radio" id="displayKommuner" name="displayKommuner" value="displayKommuner">Kommuner</label>
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
        <div class = "col-sm-6" id = "graphContent">
        <!--- <?php //echo file_get_contents("kort.svg"); ?> -->
        <!-- Graph will be appended here -->
        </div><!-- End of graph -->
        <div class = "col-sm-2 pull-right" id = "activeParameters">
            <h3>Farvekode</h3>
            <div id="farvekode"></div>
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
<script src = "js/tabMenu.js"></script>
<script src = "js/parametersHistogram.js"></script>

<!--Script til at manipulere data via HTML inputs -->
<script type="text/javascript">
var newData = new Array();
    var Hovedstaden=0, Midtjylland=0, Nordjylland=0, Sjælland=0, Syddanmark=0, UdenforDanmark=0;
    var dataset = <?php echo $dataset ?>;
    var indbyggerTabel = <?php echo $indbyggertal ?>;
    var indbyggertal;
    var active;
    var colors = {"min":"#b3d9ff", "q1":"#66b3ff", "q2":"#1a8cff", "q3":"#0066cc", "max":"#004080"};

    <?php 
	    $jsonarray = array();
	    $sql = 'SELECT kommune, region FROM indbyggertal group by region, kommune';
	    $result = queryDB($sql);
	    while ($row = mysqli_fetch_assoc($result)) {
	        $tmp = array(municipality=>$row["kommune"], region=>$row["region"]);
	        array_push($jsonarray, $tmp);
	    }
	    $regionMunicipality = json_encode($jsonarray);
	?>
    var regionMunicipality = <?php echo $regionMunicipality; ?>;
    
    //Hvis nogle af nedstående variable er sat til null vil de ikke være gældende eller gælde for alle.
	var year, startYear, endYear, classification, municipalities;
    var regionEllerKommune = "region";
    year = null;
    startYear = null;
    endYear = null;
    
    //Filter arrays
    classification = 
    {Foto: true, Skulptur: true, Maleri: true, Tegning: true, Grafik: true, Smykker:true, Andet: true,
    Design: true, Relief: true, Akvarel: true, Tekstil: true, Keramik: true, Collage: true, Glas: true, Møbel: true,
    Digital:true, Video:true, "Integreret kunst":true, Indretning: true, Print:true, "Mixed Media":true, 
    "Grafisk design":true, Performance:true, Installation:true, Lys:true};
    
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
    updateData();

    //updateDashboardRegion("radio" + currentRegion);

	//Kører hver gang der ændres på en checkboks under filter
	$('.region-kommune input:radio').click(function() {
		var name = $(this).val().trim();
        console.log(name);
		if(name==="displayRegioner"){
			regionEllerKommune = "region";
            giveColors();
		}
		else{
            regionEllerKommune = "kommune";
            giveColors();
		}
        // chooseRegion();
        // updateData();
        // updateMunicipalities();
	});

    function giveColors(region){
        console.log("Så skal der farve på drengen! med region: "+region);
        var q = calculateQuatil(region);
        updateFarvekode(q);
        //console.log("min: "+q.min+" q1: "+q.q1+" q2: "+q.q2+" q3: "+q.q1+" max: "+q.max);
        if (region != null){
            for (var i = 0; i < Object.keys(newData).length; i++) {
                if(newData[i].region == "UdenforDanmark") continue;
                var string = "#".concat(newData[i].kommune);
                //Giver forskellige farver baseret på værdi ifht. kvartil
                if(newData[i].region != region || newData[i].antal == 0)
                    $(string).css("fill", "grey");
                else if(newData[i].antal<=q.q1)
                    $(string).css("fill", colors.min);
                else if(newData[i].antal>=q.q1 && newData[i].antal<=q.q2)
                    $(string).css("fill", colors.q1);
                else if(newData[i].antal>=q.q2 && newData[i].antal<=q.q3)
                    $(string).css("fill", colors.q2);
                else if(newData[i].antal>=q.q3)
                    $(string).css("fill", colors.q3);
            }
        }
        else if(regionEllerKommune == "region"){
            for(var key in q){
                var string = ".".concat(q[key][0]);
                if(key == "min"){$(string).css("fill", colors.min);}
                else if(key == "q1"){$(string).css("fill", colors.q1);}
                else if(key == "q2"){$(string).css("fill", colors.q2);}
                else if(key == "q3"){$(string).css("fill", colors.q3);}
                else if(key == "max"){$(string).css("fill", colors.max);}
            }
        }
        else{
            for (var i = 0; i < Object.keys(newData).length; i++) {
                if(newData[i].region == "UdenforDanmark") continue;
                var string = "#".concat(newData[i].kommune);
                //Giver forskellige farver baseret på værdi ifht. kvartil
                if(newData[i].antal == 0)
                    $(string).css("fill", colors.min);
                else if(newData[i].antal<=q.q1)
                    $(string).css("fill", colors.q1);
                else if(newData[i].antal>=q.q1 && newData[i].antal<=q.q2)
                    $(string).css("fill", colors.q2);
                else if(newData[i].antal>=q.q2 && newData[i].antal<=q.q3)
                    $(string).css("fill", colors.q3);
                else if(newData[i].antal>=q.q3)
                    $(string).css("fill", colors.max);
            }
        }
    }


    function calculateQuatil(region){
        var quar = new Array();
        var min, q1, q2, q3, max;
        if(region != null){
            console.log("region er ikke null");
            for (var i = 0; i < Object.keys(newData).length; i++){ 
                if(newData[i].region == region) quar.push(newData[i].antal); 
            }
            quar = sortArray(quar);

            min = quar[0];
            q1 = quar[Math.floor((quar.length / 4))]; 
            q2 = median(quar);
            q3 = quar[Math.ceil((quar.length * (3 / 4)))];
            max = quar[quar.length-1];
        }
        else if(regionEllerKommune  == "region"){
            Hovedstaden=0, Midtjylland=0, Nordjylland=0, Sjælland=0, Syddanmark=0, UdenforDanmark=0;
            for (var i = 0; i < Object.keys(newData).length; i++) {
                switch (newData[i].region){
                    case "Hovedstaden": Hovedstaden = Hovedstaden + newData[i].antal; break;
                    case "Midtjylland": Midtjylland = Midtjylland + newData[i].antal; break;
                    case "Nordjylland": Nordjylland = Nordjylland + newData[i].antal; break;
                    case "Sjælland": Sjælland = Sjælland + newData[i].antal; break;
                    case "Syddanmark": Syddanmark = Syddanmark + newData[i].antal; break;
                    case "UdenforDanmark": UdenforDanmark = UdenforDanmark + newData[i].antal; break;
                }
            };
            quar.push(["Hovedstaden",Hovedstaden]);
            quar.push(["Midtjylland",Midtjylland]);
            quar.push(["Nordjylland",Nordjylland]);
            quar.push(["Sjælland",Sjælland]);
            quar.push(["Syddanmark",Syddanmark]);

            quar = sortArray(quar);

            min = quar[0];
            q1 = quar[1];
            q2 = quar[2];
            q3 = quar[3];
            max = quar[4];
        }
        else{
            for (var i = 0; i < Object.keys(newData).length; i++){ 
                quar.push(newData[i].antal); 
            }
            quar = sortArray(quar);

            min = quar[0];
            q1 = quar[Math.floor((quar.length / 4))]; 
            q2 = median(quar);
            q3 = quar[Math.ceil((quar.length * (3 / 4)))];
            max = quar[quar.length-1];
        }

        return {min, q1, q2, q3, max};
    }

    function sortArray(array){
        array.sort(function(a,b){
            return parseFloat(a[1]) - parseFloat(b[1]);
        });
        return array;
    }

    function median(values) {
        var half = Math.floor(values.length/2);
        if(values.length % 2) return values[half];
        else return (values[half-1] + values[half]) / 2.0;
    }


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
        }
        else{ 
            updateData();
            for (var key in indbyggertal[currentRegion]) {
                 indbyggertal[currentRegion][key] = 0;
            }
        }
    });

    function updateData(){
        newData = new Array();
        //Kopiere de relevante regioner og typer ind i newData
        for (var i = 0; i < Object.keys(regionMunicipality).length; i++) {
        	var keyKom = regionMunicipality[i].municipality;
        	var keyReg = regionMunicipality[i].region;
        	var typer = new Array();
        	for(var type in classification){
        		if(classification[type]==true) typer.push({classification:type, antal:0});
        	}
        	var tmpArr = {region:keyReg, kommune:keyKom, antal:0, typer};
            newData.push(tmpArr); 
        };

        newData = countData(newData);

        // //Sorterer data fra parametreret ascending order
        // newData.sort(function(a,b){
        //     return parseFloat(a.antal) - parseFloat(b.antal);
        // });
    
        drawMap(newData);
        
        document.getElementById("indbyggertalCheck").checked = false;
        document.getElementById("gennemsnit").checked = false;
        
    }
    function countData(newData){
        for (var i = 0; i < Object.keys(dataset).length; i++) {
            if(dataset[i].municipality == null){continue;}
            if((dataset[i].displayDate == year && dataset[i].displayDate != null)
                || (dataset[i].displayDate >= startYear && dataset[i].displayDate <=endYear)
                || (year == null && startYear == null && endYear == null)){
                for (var j = 0; j < Object.keys(newData).length; j++) {
                    if(newData[j].kommune == dataset[i].municipality){
                        for (var h = 0; h < Object.keys(newData[j].typer).length; h++) {
                            if(newData[j].typer[h].classification == dataset[i].classifications){
                                newData[j].typer[h].antal = parseFloat(newData[j].typer[h].antal) + parseFloat(dataset[i].antal); 
                                newData[j].antal = parseFloat(newData[j].antal) + parseFloat(dataset[i].antal);
                                break;
                            }
                        };
                        break;
                    }
                };
            }
        }
        console.log(newData);
    
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
        //drawDiagram(newData);
    }

function drawMap(newData){
    d3.select("svg").remove();
    var svg = d3.select("#graphContent").append("svg").attr({"width":472,"height":574});
        

    d3.xml("kort.svg", function(error, documentFragment) {
        if (error) {console.log(error); return;}
    
        var svgNode = documentFragment.getElementsByTagName("svg")[0];
    
        svg.node().appendChild(svgNode);

        var a = document.getElementById("SVGmap");
        // console.log(a);
        var b = a.querySelectorAll("g:not(#masterGroup)");
        //var b = a.querySelectorAll(".Nordjylland");
        // console.log(b);
        var c = a.getElementsByTagName("polygon");
        // console.log(c);

        var masterGroup = d3.select("#masterGroup");
        d3.selectAll(b).style("stroke","brown").attr("stroke-width","0.2").on("click", function(){ clicked(this);});

        giveColors();
    });
}

function updateFarvekode(q){
    console.log(q);
    var widthBox = 200;
    var heightBox = 120;
    d3.select("#svgFarve").remove();
    var svg = d3.select("#farvekode").append("svg").attr("id","svgFarve").attr("width", widthBox).attr("height", heightBox);
    // svg.append("rect").attr("x", 0).attr("y", 0).attr("width", widthBox/10).attr("height", 2016).style('fill', colors.min);
    // svg.append("p").text("Det her er min: "+q.min);
    // svg.append("rect").attr("x", 0).attr("y", 25).attr("width", widthBox/10).attr("height", 20).style('fill', colors.q1);
    // svg.append("rect").attr("x", 0).attr("y", 50).attr("width", widthBox/10).attr("height", 20).style('fill', colors.q2);
    // svg.append("rect").attr("x", 0).attr("y", 75).attr("width", widthBox/10).attr("height", 20).style('fill', colors.q3);
    // svg.append("rect").attr("x", 0).attr("y", 100).attr("width", widthBox/10).attr("height", 20).style('fill', colors.max);

    var bar = svg.selectAll("g")
      .data(q)
      .enter().append("g")
      //.attr("transform", function(d, i) { return "translate(0," + i * 20 + ")"; })
        .append("rect")
      .attr("width", 20)
      .attr("height", 20);

    // bar.append("text")
    //   .attr("x", function(d, i) { return i*20; })
    //   .attr("y", 0)
    //   .text(function(d) { return d; });


    // console.log("min: "+q.min);
    // console.log("q1: "+q.q1);
    // console.log("q2: "+q.q2);
    // console.log("q3: "+q.q3);
    // console.log("max: "+q.max);
}

function clicked(d) {
    var bbox = d3.select(d).node().getBBox();

    var rectAttr = {
        x: bbox.x,
        y: bbox.y,
        width: bbox.width,
        height: bbox.height,
      };
    var transX, transY;  
  
    if(active!=d && regionEllerKommune == "kommune"){
        d3.select("#masterGroup").transition().duration(1000).attr('transform', function(d) {
        var testScale = Math.max(rectAttr.width+10, rectAttr.height+10);
        var widthScale = 472 / testScale;
        var heightScale = 584 / testScale;
        var scale = Math.max(widthScale, heightScale);
        // console.log('scale',rectAttr)
        transX = -(rectAttr.x) * scale;
        transY = -(rectAttr.y) * scale;

        return 'translate(' + transX + ',' + transY + ')scale(' + scale + ')';
        }).attr('stroke-width', '0.2');
        active = d;
    }
    else if(active!=d && regionEllerKommune == "region"){ 
        var reg = d.className.baseVal;
        console.log(d.className);
        var string = ".".concat(reg);
        console.log(reg);

        var allChildNodes = d3.select("#masterGroup").selectAll(string)[0];

        //Udregner størrelsen af Border Box
        var x = d3.min(allChildNodes, function(d) {return d.getBBox().x;}),
            y = d3.min(allChildNodes, function(d) {return d.getBBox().y;}),
            width = d3.max(allChildNodes, function(d) {
                var bb = d.getBBox();
                return (bb.x + bb.width) - x;
            }),
            height = d3.max(allChildNodes, function(d) {
                var bb = d.getBBox();
                return (bb.y + bb.height) - y;
            });

            //Viser border box
            // d3.select("#masterGroup").append('rect')
            // .attr('x', x )
            // .attr('y', y)
            // .attr('width', width)
            // .attr('height', height)
            // .style('fill', '#000');
    
        d3.select("#masterGroup").transition().duration(1000).attr('transform', function (d){
            var testScale = Math.max(width, height);
            var widthScale = 472 / testScale;
            var heightScale = 584 / testScale;
            var scale = Math.max(widthScale, heightScale);
            // console.log('scale',rectAttr)
            transX = -(x) * scale;
            transY = -(y) * scale;

            return 'translate(' + transX + ',' + transY + ')scale(' + scale + ')';
        }).attr('stroke-width','0.2');
        giveColors(reg);
        regionEllerKommune = "kommune";
        active=d;
    }    

    else {
        d3.select("#masterGroup").transition().duration(1000).attr('transform', function(d) {
        return 'translate(' + 0 + ',' + 0 + ')scale(' + 1 + ')';
        });
        regionEllerKommune = "region";
        giveColors();
        active = null;
    }
    
}



function colorOneRegion(region){

}

</script>

</body>
</head>