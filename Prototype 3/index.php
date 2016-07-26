<?php require ("functions.php"); ?>
<?php require ("getNogletal.php") ?>
<?php require ("getMunicipalityData.php"); ?>
<?php require ("getDataset.php"); ?>
<!-- Header -->
<?php require("header.php");?>

<script src="http://d3js.org/d3.v3.min.js" charset="utf-8"></script>
<script src = "js/drawMap.js"></script>
<script src = "js/drawHistogram.js"></script>

<div class = "container-fluid">
    <div class = "row">
        <div class = "col-sm-4">
            <!-- Venstre menubar -->
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
                          <label><input type="radio" checked="checked" id="displayRegion"  name="displayRegOrKommu" value="displayRegioner">Regioner</label>
                        </div>
                        <div class="radio">
                          <label><input type="radio" id="displayKommune" name="displayRegOrKommu" value="displayKommuner">Kommuner</label>
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
                        <label><input type="checkbox" id="gennemsnitCheck" name="gennemsnit" value="gennemsnit">Gennemsnit</label>
                    </div>
                    <div class="checkbox" id="indbyggertalWrapper">
                        <label><input type="checkbox" id="indbyggertalCheck" value="indbyggertal">Indbyggertal</label>
                    </div>
                </div>
            </div>
        </div><!-- End of menu -->
        <!-- Menu til at beslutte visualisering -->
        <div class = "col-sm-6">
            <div class="col-sm-10" id="graphContent">
            <ul class="nav nav-tabs row">
                <li id="menuKort" class="active"><a href="#menuKort">Kort</a></li>
                <li id="menuHistogram"><a href="#menuHistogram">Histogram</a></li>
                <li id="menuInfo"><a href="#menuInfo">Info</a></li>
            </ul>
            <div id="displayKort" class="tab-content">
                <div class="col-sm-12 tab-pane fade in active row">Her skal vises Kort</div>
            </div>
            <div id="displayHistogram" class="tab-content">
                <div class="col-sm-12 tab-pane fade">Her vises histogram</div>
            </div>
            <div id="displayInfo" class="tab-content">
                <div class="col-sm-12 tab-pane fade">Her skal vises Info</div>
            </div>
        <!--- <?php //echo file_get_contents("kort.svg"); ?> -->
        <!-- Graph will be appended here -->
            </div>
        <div class="col-sm-2" id="tilbageKnap" style="display: none;"><button type="button" class="btn btn-primary">Regionsoversigt</button></div>
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
    var gennemsnit = false;
    var active;
    var currentRegion = null, currentMunicipality=null;
    var colors = {"min":"#b3d9ff", "q1":"#66b3ff", "q2":"#1a8cff", "q3":"#0066cc", "max":"#004080"};
    var currentMenu = "kort";

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

    var institutions = ["Andre", "Bolig", "Byrum", "Erhverv", "Fritid", "Kultur - øvrig", "Kultur - biblioteker", "Kultur - museer",
    "Kutlur - øvrig", "Landskab", "Offentlig administration - kommune", "Offentlig administration - region", "Offentlig administration - stat",
    "Religion", "Sundhed - hospitaler", "Sundhed - pleje", "Transport", "Turisme", "Uddannelse - førskole", "Uddannelse - grundskole",
    "Uddannelse - ungdomsuddannelse", "Uddannelse - videregående uddannelse"];
    

    updateData();

	//Kører hver gang der ændres på en checkboks under filter
	$('.region-kommune input:radio').click(function() {
		var name = $(this).val().trim();
        console.log(name);
		if(name==="displayRegioner"){
            //updateData();
		}
		else{
            // regionEllerKommune = "kommune";
		}
        // chooseRegion();
        // updateData();
        // updateMunicipalities();
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

	//Ændre i year til single view ved klik på dropdown menu
	$('#selectSingleYear').change(function() {
		$('#selectStartYear').val("start");
		$('#selectEndYear').val("slut");
   		endYear = null;
    	startYear = null;
    	year = $(this).val();
    	if(year=="Alle") year=null;
        //updateActiveYears();
    	updateData();
	});

	//Ændre i intervallet. Denne funktion kalder når knappen vælg trykkes
	$("#btnSubmit").click(function(){
		$('#selectSingleYear').val("Vaelg");
		year = null;
		startYear = $('#selectStartYear').val();
		endYear = $('#selectEndYear').val();
        //updateActiveYears();
       	updateData();
    });

    //Ændre i tabellen udfra indbyggertallet i kommunen.
    $("#indbyggertalCheck").click(function(){
        if($("#indbyggertalCheck").prop('checked')){
            document.getElementById("gennemsnitCheck").checked = false;
            if(year != null && year>=1993){
                indbyggertal = new Array();
                for(var i=0; i<Object.keys(indbyggerTabel).length; i++){
                    indbyggertal.push({kommune:indbyggerTabel[i].kommune, antal:parseFloat(indbyggerTabel[i][year])});
                }
                updateIndbyggerDiagram(newData, indbyggertal);
            }
            else if(startYear>=1993 && endYear<=2016){
                indbyggertal = new Array();
                for(var i=0; i<Object.keys(indbyggerTabel).length; i++){
                    indbyggertal.push({kommune:indbyggerTabel[i].kommune, antal:parseFloat(indbyggerTabel[i][endYear])});
                }
                updateIndbyggerDiagram(newData, indbyggertal);
            }
            else{
                alert("Du har valgt et år hvor der ikke findes data. \n Derfor vælges årene 1993 - 2016");
                startYear = 1993;
                endYear = 2016;
                indbyggertal = new Array();
                for(var i=0; i<Object.keys(indbyggerTabel).length; i++){
                    indbyggertal.push({kommune:indbyggerTabel[i].kommune, antal:parseFloat(indbyggerTabel[i][endYear])});
                }
                updateIndbyggerDiagram(newData, indbyggertal);
            }
        }
        else{
            indbyggertal = null; 
            updateData();
        }
    });

    $("#gennemsnitCheck").click(function(){
        if($("#gennemsnitCheck").prop('checked')) {
            document.getElementById("indbyggertalCheck").checked = false;
            gennemsnit = true;
            drawDiagram(newData);
        }
        else{
            gennemsnit = false;
            updateData();
            }
    });

    //Tilbageknap i histogram. Kom fra kommuneniveau til regionsniveau
    $("#tilbageKnap").click(function(){
        $('#tilbageKnap').hide();
        currentRegion = null;
        drawDiagram(newData);
        console.log("CurrentRegion: "+currentRegion);
    });

    $("#menuKort").click(function(){
        currentMenu = "kort";
        drawDiagram(newData);
        $("#displayHistogram").hide();
        $("#displayKort").show();
        console.log("CurrentRegion: "+currentRegion);
    });
    $("#menuHistogram").click(function(){
        currentMenu = "histogram";
        drawDiagram(newData);
        $("#displayKort").hide();
        $("#displayHistogram").show();
    });
    $("#menuInfo").click(function(){
    });

    function sortArray(array){
        array.sort(function(a,b){
            return parseFloat(a[1]) - parseFloat(b[1]);
        });
        return array;
    }

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
            var institioner = new Array();
            for (var h = 0; h < institutions.length; h++){
                institioner.push({institution:institutions[h], antal:0})
            }
        	var tmpArr = {region:keyReg, kommune:keyKom, antal:0, typer, institioner};
            newData.push(tmpArr); 
        };

        newData = countData(newData);

        drawDiagram(newData);
        
        document.getElementById("indbyggertalCheck").checked = false;
        document.getElementById("gennemsnitCheck").checked = false;
        
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
                        for (var h = 0; h < Object.keys(newData[j].institioner).length; h++) {
                            if(newData[j].institioner[h].institution == dataset[i].institutionCode){
                                newData[j].institioner[h].antal = parseFloat(newData[j].institioner[h].antal) + parseFloat(dataset[i].antal); 
                                break;
                            }
                        };
                        break;
                    }
                };
            }
        }
        // console.log(newData);
    
        return newData;
    }

    function drawDiagram(data){
        if(currentMenu == "kort"){
            drawMap(data);
        }
        else if(currentMenu == "histogram"){
            drawHistogram(data);
        }
    }

    function updateIndbyggerDiagram(data, indbyggertal){
        for(var i=0; i<Object.keys(data).length; i++){
            for (var j = 0; j < Object.keys(indbyggertal).length; j++) {
                if(data[i].kommune == indbyggertal[j].kommune){
                    data[i].antal = data[i].antal / indbyggertal[j].antal;
                    break;
                }
            };
        }
        drawDiagram(data);
    }



</script>

</body>
</head>