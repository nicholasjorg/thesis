<?php require("functions.php"); ?>
<?php require("getRegionData.php"); ?>

<!-- Header -->
<?php require("header.php");?>

<div class = "container">
    <div class = "row" id = "contentRow">
        <div class = "col-sm-4">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#home">Filter</a></li>
                <li><a href="#menu1">Zoom</a></li>
                <li><a href="#menu2">Compare</a></li>
                <li><a href="#menu3">Parameters</a></li>
                <li><a href="#menu4"></a></li>
            </ul>
            <div class="tab-content">
              <div id="home" class="tab-pane fade in active">
                <h3>Vælg regioner</h3>
                <div class="col-sm-4 form-filters">
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
              </div>
              <div id="menu1" class="tab-pane fade">
                <h3>Single year</h3>
                  <select id ="selectSingleYear">
                  <option value="Vaelg" display="none">Vælg år</option>
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
				<input id="btnSubmit" type="submit" value="Kør"/>
              </div>
              <div id="menu2" class="tab-pane fade">
                <h3>Compare</h3>
                <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
              </div>
              <div id="menu3" class="tab-pane fade">
                <h3>Menu 3</h3>
                <p>Eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
              </div>
            </div>
        </div>
    </div>
</div>

    <script src = "js/effects.js"></script>
    <script src = "js/tabMenu.js"></script>

	<!--Script til at manipulere data via HTML inputs -->
	<script>
		var regionSingleYear = <?php echo $regionSingleYear; ?>;
		var jsonarr = <?php echo $jsonobj; ?>;
		var jsonarrlength = Object.keys(jsonarr).length;
		//Kloner jsonarr til filterJsonArr
		var filterJsonArr = JSON.parse(JSON.stringify(jsonarr));
		var year, startYear, endYear;

		//Kører hver gang der ændres på en checkboks
		$('.form-filters input:checkbox').click(function() {
			var name = $(this).val().trim();
			var i = 0;
			var addIndex;
			//Looper igennem filterJsonArr. Tjekker om elementer eksisterer. Hvis ikke tilføjes det, ellers fjernes det.
			for(var i; i < jsonarrlength; i++){
				var exists = false;
				if(filterJsonArr[i].region == name){exists=true;  break;}
				if(jsonarr[i].region == name) {addIndex = i; break;}
			}

	 		if(exists == false){
				filterJsonArr[addIndex].region = jsonarr[addIndex].region;
				if(year != null && startYear == null) updateWithNewData(updateSingleYearData());
				else if(year == null && startYear != null) updateWithNewData(updateIntervalYearData());
				else updateWithNewData(updateRegionData());
	 		}
	 		else{
	 			filterJsonArr[i].region = null;
	 			if(year != null && startYear == null) updateWithNewData(updateSingleYearData());
				else if(year == null && startYear != null) updateWithNewData(updateIntervalYearData());
				else updateWithNewData(updateRegionData());
            }
		});

		//Ændre i year til single view ved klik på dropdown menu
		$('#selectSingleYear').change(function() {
			$('#selectStartYear').val("start");
			$('#selectEndYear').val("slut");
    		year = $(this).val();
    		endYear = null;
    		startYear = null;
    		if(year=="Alle"){year=null; updateWithNewData(updateRegionData()); return;}
    		updateWithNewData(updateSingleYearData());
		});

		//Ændre i intervallet. Denne funktion kalder når knappen vælg trykkes
		$("#btnSubmit").click(function(){
			$('#selectSingleYear').val("Vaelg");
			startYear = $('#selectStartYear').val();
			endYear = $('#selectEndYear').val();
			year = null;
        	updateWithNewData(updateIntervalYearData());
    	});

		function updateRegionData(){
			var newData = new Array();
			for(var h=0; h<Object.keys(filterJsonArr).length; h++){
				if(filterJsonArr[h].region == "needschanging") { filterJsonArr[h].region = null }
				if(filterJsonArr[h].region != null) { newData.push(filterJsonArr[h]); }
			}
			console.log(newData);
			return newData;
		}

		function updateSingleYearData(){
			var newYearData = JSON.parse(JSON.stringify(updateRegionData()));
			for(var i=0; i<Object.keys(newYearData).length; i++){
				newYearData[i].antal = 0;
				
				for(var j=0; j<Object.keys(regionSingleYear).length; j++){
				if(newYearData[i].region == regionSingleYear[j].region 
					&& regionSingleYear[j].displayDate==year){
					newYearData[i].antal = parseFloat(newYearData[i].antal) + parseFloat(regionSingleYear[j].antal);
					}
				}
			}			
			return newYearData;
		}

		function updateIntervalYearData(){
			var newIntervalData = JSON.parse(JSON.stringify(updateRegionData()));
			for(var i=0; i<Object.keys(newIntervalData).length; i++){
				newIntervalData[i].antal = 0;
				for(var j=0; j<Object.keys(regionSingleYear).length; j++){
					if(newIntervalData[i].region == regionSingleYear[j].region
						&& regionSingleYear[j].displayDate > startYear
						&& regionSingleYear[j].displayDate < endYear){
					newIntervalData[i].antal = parseFloat(newIntervalData[i].antal) + parseFloat(regionSingleYear[j].antal);
					}
				}
			}
			return newIntervalData;
		}


	updateWithNewData(updateRegionData());

	function updateWithNewData(data){
		//Fjerner gammel graf
        d3.select("svg").remove();

        //Sorterer newData ascending order
		data.sort(function(a,b){
			return parseFloat(a.antal) - parseFloat(b.antal);
		});
		

		//Sætter variable
		var margin = {top: 10, right: 0, bottom: 10, left: 40};
		var w = 500, h = 500;

		//Laver svg element til at komme figuren
		var svg = d3.select("#contentRow").append("svg").attr("id","graph").attr("width", w).attr("height", h);

		//Laver scale
		var min = data[0].antal;
		var max = data[Object.keys(data).length-1].antal;
		var yScale = d3.scale.linear().domain([0,max]).range([h-margin.top-margin.bottom,margin.top]).nice();
		var xScale = d3.scale.ordinal().domain(data.map(function (d){return d.region})).rangeRoundBands([margin.left, w-margin.left-margin.right], 0.1);

        //Bygger tooltip
        var tip = d3.tip()
          .attr('class', 'd3-tip')
          .offset([-10, 0])
          .html(function(d) {
            return "Klik for mere info om " +  d.region + " <span style='color:red'></span>";
        })

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
</head>


