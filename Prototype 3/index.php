<?php require ("functions.php"); ?>
<?php require ("getNogletal.php") ?>
<?php require ("getMunicipalityData.php"); ?>
<?php require ("getDataset.php"); ?>
<!-- Header -->
<?php require("header.php");?>

<script src="http://d3js.org/d3.v3.min.js" charset="utf-8"></script>
<script src = "js/drawMap.js"></script>
<script src = "js/drawHistogram.js"></script>
<script src = "js/leftMenu.js"></script>
<script src = "js/whereAreWe.js"></script>
<script src = "js/info.js"></script>
<script src = "js/drawLineChart.js"></script>
<script src = "js/loadScreen.js"></script>

<!-- Hjælper med gennemsnitsstreg på histogram -->
<script src="http://labratrevenge.com/d3-tip/javascripts/d3.tip.v0.6.3.js"></script>
<div class="loader"></div>
<div class = "container-fluid">
    <div class = "row">
        <div class = "col-sm-3">
            <!-- Venstre menubar -->
            <ul id = "leftMenu" class="nav nav-tabs">
                <li id="leftMenuNiveau" class="active"><a href="#home">Niveau</a></li>
                <li><a href="#menu1">Årstal</a></li>
                <li><a href="#menu2">Typer</a></li>
                <li id ="liStatistik"><a href="#menu3">Statistik</a></li>
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
                <h3>Enkelt årstal</h3>
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
                    <label><input type="checkbox" id="gennemsnitCheck" name="gennemsnit" value="gennemsnit">Vis gennemsnit</label>
                </div>
                <div class="checkbox" id ="medianWrapper">
                    <label><input type="checkbox" id="medianCheck" name="median" value="median">Vis median</label>
                </div>
                <div class="checkbox" id="indbyggertalWrapper">
                    <label><input type="checkbox" id="indbyggertalCheck" value="indbyggertal">Antal værker udregnet pr. indbygger</label>
                </div>
                <div class="checkbox" id ="KulturWrapper">
                    <label><input type="checkbox" id="kulturCheck" name="kulturBudget" value="kulturBudget">Kulturbudget pr. indbygger</label>
                </div>
            </div>
        </div>
    </div><!-- End of menu -->
    <!-- Menu til at beslutte visualisering -->
    <div class = "col-sm-6">
        <!-- <div class="col-sm-10" id="loadScreen"> <img src="gears.svg"> </div> -->
        <div class="col-sm-10" id="graphContent">
            <ul id="menuUL" class="nav nav-tabs row">
                <li id="menuKort" class="active"><a id="menuKortButton" class="menuButton" href="#menuKort">Kort</a></li>
                <li id="menuHistogram"><a id="menuHistogramButton" class="menuButton" href="#menuHistogram">Histogram</a></li>
                <li id="menuInfo"><a id="menuInfoButton" class="menuButton" href="#menuInfo">Type antal</a></li>
                <li id="menuLineChart"><a id="menuLineChartButton" class="menuButton" href="#menuLineChart">Line chart</a></li>
            </ul>
            <div class="pull-right">
                <input id="dataSelector" list="datalist" placeholder="Search">
                <!-- Data komme fra jQuery kode -->
                <datalist id="datalist"> </datalist>
            </div>
            <div id="whereAmI">Her skal være filsystem</div>
                <div id="displayKort" class="tab-content">
                    <div class="col-sm-12 tab-pane fade in active row"><div id="tooptipKort" style="display:none"></div></div>
                </div>
                <div id="displayHistogram" class="tab-content">
                    <div class="col-sm-12 tab-pane fade"></div>
                </div>
                <div id="displayLineChart" class="tab-content">
                    <div class="col-sm-12 tab-pane fade">
                    </div>
                </div>
                <div id="displayInfo" class="tab-content">
                    <div class="col-sm-12 tab-pane fade">
                        <h3> Værktyper:</h3>
                        <div id = "aktiveTyper">
                            Alle
                        </div>
                    </div>
                </div>
                <div id="graphWrapper">
                    <!-- Graph will be appended here -->
                    <div id="chartRadioButtons">
                        <div class="lineChartRadio">
                            <form>
                                <div class="radio"><label><input checked="checked" type="radio" name="skiftChart" value="akkumuleret">Akkumuleret</label></div>
                                <div class="radio"><label><input type="radio" name="skiftChart" value="enkelt">Enkelt</label></div>
                            </form>
                        </div>
                    </div>
                </div>
                <div id="loadScreen">
                    <h2>Loading data... </h2>
                </div>
            </div><!-- End of graph -->
        </div>

        <!-- Venstre menun -->
        <div class = "col-sm-2 pull-right" id = "activeParameters">
            <div id="farvekodeWrapper">
                <h3>Farvekode</h3>
                    <div id="farvekode">
                    </div>
                </div>
            <h3>Årstal:</h3>
            <div id = "aktiveÅr">
                1918 - 2016
            </div>
            <!-- Details on demand -->
            <div id="dod" style="display:none"></div>
            <div id="gennemsnitsInfo"></div>
        </div><!-- End of Row -->
    </div><!-- End of container -->
<!-- Details on demand Div -->
<script src = "js/tabMenu.js"></script>
<script src = "js/parametersHistogram.js"></script>


<script type="text/javascript">
$(window).load(function() {
    $(".loader").fadeOut("slow");
})
</script>
<!--Script til at manipulere data via HTML inputs -->
<script type="text/javascript">
var newData = new Array();
    // var Hovedstaden=0, Midtjylland=0, Nordjylland=0, Sjælland=0, Syddanmark=0, UdenforDanmark=0;
    var dataset = <?php echo $dataset ?>;
    var indbyggerTabel = <?php echo $indbyggertal ?>;
    var kulturbudgetTabel = <?php echo $kulturbudget ?>;
    var gennemsnit = false, median = false, kunKommune = false;
    var active, yellowIs;
    var currentRegion = null, currentMunicipality=null;
    var colors = {"min":"#b3d9ff", "q1":"#66b3ff", "q2":"#1a8cff", "q3":"#0066cc", "max":"#004080"};
    var currentMenu = "kort", hvilkenLineChart = "akkumuleret";

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


   var year, startYear, endYear, classification, municipalities;
    year = null, startYear = null, endYear = null;

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
		if(name==="displayRegioner"){
            kunKommune = false;
            drawDiagram(newData);
        }
        else{
            kunKommune = true;
            drawDiagram(newData);
        }
    });

    $(".lineChartRadio input:radio").click(function() {
        hvilkenLineChart = $(this).val();
        drawLineChart(newData);
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
       updateData();
   });

	//Ændre i intervallet. Denne funktion kalder når knappen vælg trykkes
	$("#btnSubmit").click(function(){
        if($('#selectStartYear').val() === "start" || $('#selectEndYear').val() === "slut")
            {alert("Du skal vælge et start år og et slut år"); return;}
        if($('#selectStartYear').val() > $('#selectEndYear').val())
            {alert("Startåret skal være før slutåret."); return;}
        $('#selectSingleYear').val("Vaelg");
        year = null;
        startYear = $('#selectStartYear').val();
        endYear = $('#selectEndYear').val();
        updateData();
    });

    //Ændre i tabellen udfra indbyggertallet i kommunen.
    $("#indbyggertalCheck").click(function(){
        if($("#indbyggertalCheck").prop('checked')){
            document.getElementById("gennemsnitCheck").checked = false;
            document.getElementById("medianCheck").checked = false;
            document.getElementById("kulturCheck").checked = false;
            var indbyggertal = new Array();
            if(year != null && year>=1993){
                for(var i=0; i<Object.keys(indbyggerTabel).length; i++){
                    indbyggertal.push({kommune:indbyggerTabel[i].kommune, antal:parseFloat(indbyggerTabel[i][year])});
                }
                updateIndbyggerDiagram(newData, indbyggertal);
            }
            else if(startYear>=1993 && endYear<=2016){
                for(var i=0; i<Object.keys(indbyggerTabel).length; i++){
                    indbyggertal.push({kommune:indbyggerTabel[i].kommune, antal:parseFloat(indbyggerTabel[i][endYear])});
                }
                updateIndbyggerDiagram(newData, indbyggertal);
            }
            else{
                alert("Du har valgt et år hvor der ikke findes data. \nDerfor vælges årene 1993 - 2016");
                startYear = 1993;
                endYear = 2016;
                for(var i=0; i<Object.keys(indbyggerTabel).length; i++){
                    indbyggertal.push({kommune:indbyggerTabel[i].kommune, antal:parseFloat(indbyggerTabel[i][endYear])});
                }
                $('#selectEndYear').val(endYear);
                $('#selectStartYear').val(startYear);
                updateIndbyggerDiagram(newData, indbyggertal);
            }
        }
        else{
            indbyggertal = null;
            updateData();
            //drawDiagram(newData);
        }
    });

$("#gennemsnitCheck").click(function(){
    if($("#gennemsnitCheck").prop('checked')) {
        gennemsnit = true;
        median = false;
        document.getElementById("medianCheck").checked = false;
        drawDiagram(newData);
    }
    else{
        gennemsnit = false;
        $("#gennemsnitsInfo").empty();
        document.getElementById("gennemsnitCheck").checked = false;
        drawDiagram(newData);
    }
});

$("#medianCheck").click(function(){
    if($("#medianCheck").prop('checked')) {
        median = true;
        gennemsnit = false;
        document.getElementById("gennemsnitCheck").checked = false;
        drawDiagram(newData);
    }
    else{
        median = false;
        $("#gennemsnitsInfo").empty();
        document.getElementById("medianCheck").checked = false;
        drawDiagram(newData);
    }
});

    //Ændre i dataene ud fra kulturbudgettet
    $("#kulturCheck").click(function(){
        if($("#kulturCheck").prop('checked')) {
            document.getElementById("gennemsnitCheck").checked = false;
            document.getElementById("indbyggertalCheck").checked = false;
            var kulturbudget = new Array();
            if(year != null && year>=1993){
                for(var i=0; i<Object.keys(kulturbudgetTabel).length; i++){
                    kulturbudget.push({kommune:kulturbudgetTabel[i].kommune, antal:parseFloat(kulturbudgetTabel[i][year])});
                }
                updateIndbyggerDiagram(newData, kulturbudget);
            }
            else if(startYear>=1993 && endYear<=2016){
                for(var i=0; i<Object.keys(kulturbudgetTabel).length; i++){
                    kulturbudget.push({kommune:kulturbudgetTabel[i].kommune, antal:parseFloat(kulturbudgetTabel[i][endYear])});
                }
                updateIndbyggerDiagram(newData, kulturbudget);
            }
            else{
                alert("Du har valgt et år hvor der ikke findes data. \nDerfor vælges årene 1993 - 2016");
                startYear = 1993;
                endYear = 2016;
                for(var i=0; i<Object.keys(kulturbudgetTabel).length; i++){
                    kulturbudget.push({kommune:kulturbudgetTabel[i].kommune, antal:parseFloat(kulturbudgetTabel[i][endYear])});
                }
                $('#selectEndYear').val(endYear);
                $('#selectStartYear').val(startYear);
                updateIndbyggerDiagram(newData, kulturbudget);
            }
        }
        else{
            kulturbudget = null;
            updateData();
            document.getElementById("kulturCheck").checked = false;
            //drawDiagram(newData);
        }
    });

$("#menuKort").click(function(){
    currentMenu = "kort";
     $("#graphWrapper").fadeOut(function(){
        $("#loadScreen").fadeIn(function(){
                drawDiagram(newData);
            $("#loadScreen").fadeOut(function(){
                $("#graphWrapper").fadeIn(function(){
                })
            })
        })
    })
});
$("#menuHistogram").click(function(){
    currentMenu = "histogram";
     $("#graphWrapper").fadeOut(function(){
        $("#loadScreen").fadeIn(function(){
                drawDiagram(newData);
            $("#loadScreen").fadeOut(function(){
                $("#graphWrapper").fadeIn(function(){
                })
            })
        })
    })
});
$("#menuInfo").click(function(){
    currentMenu = "info";
     $("#graphWrapper").fadeOut(function(){
        $("#loadScreen").fadeIn(function(){
                drawDiagram(newData);
            $("#loadScreen").fadeOut(function(){
                $("#graphWrapper").fadeIn(function(){
                })
            })
        })
    })
});

$("#menuLineChart").click(function(){
    currentMenu = "lineChart";
    $("#graphWrapper").fadeOut(function(){
        $("#loadScreen").fadeIn(function(){
                drawDiagram(newData);
            $("#loadScreen").fadeOut(function(){
                $("#graphWrapper").fadeIn(function(){
                })
            })
        })
    })
});


var lastHovered;
    // Hover på kommuner i kortet.
    $(document).on('mouseenter','.Hovedstaden, .Sjælland, .Syddanmark, .Nordjylland, .Midtjylland, .rectangle',function(e){
        var countRegion = {"Hovedstaden":0, "Midtjylland":0, "Nordjylland":0, "Sjælland":0, "Syddanmark":0};
        if("#".concat(currentMunicipality) != lastHovered) $(lastHovered).css("stroke-width", 0.2);
        for (var j = 0; j < Object.keys(newData).length; j++) {
            if(kunKommune === true || currentRegion !== null || median === true){
                if (newData[j].kommune == this.id){
                    if(currentMenu === "kort") {
                        $("#dod").empty().append("<h3>Info:</h3><b>Region: </b>"+this.className.baseVal+"<br /><b>Kommune: </b>"+this.id+"<br /> <b>Antal værker: </b>"+newData[j].antal);
                        lastHovered = "#".concat(newData[j].kommune);
                        $(lastHovered).css("stroke-width", 0.7);
                    }
                    else if(currentMenu === "histogram") $("#dod").empty().append("<h3>Info:</h3><b>Kommune: </b>"+this.id+"<br /> <b>Antal værker: </b>"+newData[j].antal);
                            //$(string).css("fill", "grey").css("stroke-width", 0.7);
                            break;
                        }
                    }
                    else{
                        switch(newData[j].region){
                            case "Hovedstaden": countRegion.Hovedstaden = countRegion.Hovedstaden+newData[j].antal; break;
                            case "Sjælland": countRegion.Sjælland = countRegion.Sjælland+newData[j].antal; break;
                            case "Midtjylland": countRegion.Midtjylland = countRegion.Midtjylland+newData[j].antal; break;
                            case "Syddanmark": countRegion.Syddanmark = countRegion.Syddanmark+newData[j].antal; break;
                            case "Nordjylland": countRegion.Nordjylland = countRegion.Nordjylland+newData[j].antal; break;
                            default: console.log("i default"); continue;
                        }
                        if(currentMenu === "kort") {
                    //Generer infoboks
                    $("#dod").empty().append("<h3>Info:</h3><b>Region: </b>"+this.className.baseVal+"<br /> <b>Antal værker: </b>"+countRegion[this.className.baseVal]);
                    //Hover på regioner i kortet
                    lastHovered = ".".concat(this.className.baseVal);
                    $(lastHovered).css("stroke-width", 0.7);

                }
                else $("#dod").empty().append("<h3>Info:</h3><b>Region: </b>"+this.id+"<br /> <b>Antal værker: </b>"+countRegion[this.id]);
            }
        }
        $("#dod").css({top: event.clientY, left: event.clientX}).show();
    });

    //Mouse leave
     $(document).on('mouseleave','.Hovedstaden, .Sjælland, .Syddanmark, .Nordjylland, .Midtjylland',function(e){
         $(lastHovered).css("stroke-width", 0.2);
         $("#dod").empty();
    });


//Kode som sytrer search field
for (var i = 0; i < Object.keys(newData).length; i++) {
    $("#dropdownSearch").append('<option data-tokens="'+newData[i].kommune+'">'+newData[i].kommune+'</option>');
    $("#datalist").append('<option value='+newData[i].kommune+'></option>');
}
$("#dataSelector").on('input',function() {
    var val = $(this).val();
    for (var i = 0; i < Object.keys(newData).length; i++) {
        if(val === newData[i].kommune){
            currentRegion = newData[i].region;
            currentMunicipality = newData[i].kommune;
            drawDiagram(newData);
            return;
        }
    };
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
        		if(classification[type] === true) typer.push({classification:type, antal:0});
        	}
            var institioner = new Array();
            for (var h = 0; h < institutions.length; h++){
                institioner.push({institution:institutions[h], antal:0})
            }
            var displayDate = new Array();
            for (var j = 1918; j <= 2016; j++){
                displayDate.push({displayDate:j, antal:0})
            }
            var tmpArr = {region:keyReg, kommune:keyKom, antal:0, typer, institioner, displayDate};
            newData.push(tmpArr);
        };

        newData = countData(newData);

        $("#graphWrapper").fadeOut(function(){
            $("#loadScreen").fadeIn(function(){
                    drawDiagram(newData);
                $("#loadScreen").fadeOut(function(){
                    $("#graphWrapper").fadeIn(function(){
                    })
                })
            })
        })


        document.getElementById("indbyggertalCheck").checked = false;
        document.getElementById("gennemsnitCheck").checked = false;

    }
    function countData(newData){
        for (var i = 0; i < Object.keys(dataset).length; i++) {
            if(classification[dataset[i].classifications] == false) { continue; }
            if(dataset[i].municipality == null) { continue; }
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
                        for (var h = 0; h < Object.keys(newData[j].displayDate).length; h++) {
                            if(newData[j].displayDate[h].displayDate == dataset[i].displayDate){
                                newData[j].displayDate[h].antal = parseFloat(newData[j].displayDate[h].antal) + parseFloat(dataset[i].antal);
                                break;
                            }
                        };
                        break;
                    }
                };
            }
        }

        return newData;
    }

    function drawDiagram(data){
        console.log(data);

        d3.select("table").remove();
        $("#chartRadioButtons").hide();

        if(currentMunicipality !== null){
            for (var i = 0; i < Object.keys(data).length; i++) {
                if(currentMunicipality === data[i].kommune && data[i].antal === 0){
                    alert("Intet data fundet"); currentMenu = "kort";
                    $("#menuUL").children().removeClass("active");
                    $("#menuKort").addClass("active");
                    $("#farvekodeWrapper").fadeIn();
                    $("#liStatistik").fadeIn();
                    }
            };
        }

        if(currentMenu == "kort"){
            drawMap(data);
        }
        else if(currentMenu == "histogram"){
            drawHistogram(data);
        }
        else if(currentMenu == "info"){
            showInfo(data);
        }
        else if(currentMenu == "lineChart"){
            drawLineChart(data);
        }

        whereAmI();
        updateActiveYears();
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

    function goToNiveau(){
        $("#leftMenu").children().removeClass("active");
        $("#leftMenuNiveau").addClass("active");
    }

    $(".menuButton").click(function(){
        switch(this.id){
            case "menuHistogramButton":
                $("#farvekodeWrapper").fadeOut();
                $("#liStatistik").fadeIn();
                break;
            case "menuKortButton":
                $("#farvekodeWrapper").fadeIn();
                $("#liStatistik").fadeIn();
                break;
            case "menuInfoButton":
                $("#farvekodeWrapper").fadeOut();
                $("#liStatistik").fadeOut();
                if($("#liStatistik").hasClass("active")){
                    goToNiveau();
                }
                break;
            case "menuLineChartButton":
                $("#farvekodeWrapper").fadeIn();
                $("#liStatistik").fadeOut();
                if($("#liStatistik").hasClass("active")){
                    goToNiveau();
                }
                break;
        }
    });

    </script>

</body>
</head>