<?php require("functions.php"); ?>
<?php require("getRegionData.php"); ?>
<HTML>
<head>
<script type="text/javascript" src="d3/d3.js"></script>
<link rel="stylesheet" type="text/css" href="stylesheet.css">
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
	<!-- Latest compiled JavaScript -->
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <!-- d3 script -->
    <script src="http://labratrevenge.com/d3-tip/javascripts/d3.tip.v0.6.3.js"></script>

</head>
<body>
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
                  <option value="null">Alle</option>
                    <?php
                    $result = getDisplayDateYears();
                    while ($row = mysqli_fetch_array($result)) {
                        echo '<option value='.$row["displayDate"].'>'.$row["displayDate"].'</option>';
                    }
                    ?>
				</select>
				<h3>Single year</h3>
                <select id ="selectSingleYear">
                <option value="null">Alle</option>
                <?php
                	$result = getDisplayDateYears();
                    while ($row = mysqli_fetch_array($result)) {
                        echo '<option value='.$row["displayDate"].'>'.$row["displayDate"].'</option>';
                    }
                ?>
				</select>
				<select id ="selectSingleYear">
                <option value="null">Alle</option>
                <?php
                	$result = getDisplayDateYears();
                    while ($row = mysqli_fetch_array($result)) {
                        echo '<option value='.$row["displayDate"].'>'.$row["displayDate"].'</option>';
                    }
                ?>
				</select>
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
		console.log(regionSingleYear);
		var jsonarr = <?php echo $jsonobj; ?>;
		var jsonarrlength = Object.keys(jsonarr).length;
		//Kloner jsonarr til filterJsonArr
		var filterJsonArr = JSON.parse(JSON.stringify(jsonarr));
		var year;

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
				if(year == null) updateWithNewData(updateRegionData());
                else updateWithNewData(updateSingleYearData());
	 		}
	 		else{
	 			filterJsonArr[i].region = null;
	 			if(year == null) updateWithNewData(updateRegionData());
                else updateWithNewData(updateSingleYearData());
            }
		});

		//Ændre i year til single view
		$('#selectSingleYear').change(function() {
    		year = $(this).val();
    		if(year == null) updateWithNewData(updateRegionData());
        	else updateWithNewData(updateSingleYearData());
		});

		function updateRegionData(){
			var newData = new Array();
			for(var h=0; h<Object.keys(filterJsonArr).length; h++){
				if(filterJsonArr[h].region == "needschanging") { filterJsonArr[h].region = null }
				if(filterJsonArr[h].region != null) { newData.push(filterJsonArr[h]); }
			}
			return newData;
		}

		function updateSingleYearData(){
			var newYearData = new Array();
			for(var i=0; i<Object.keys(filterJsonArr).length; i++){
				for(var j=0; j<Object.keys(regionSingleYear).length; j++){
				if(filterJsonArr[i].region == regionSingleYear[j].region && regionSingleYear[j].displayDate==year) newYearData.push(regionSingleYear[j]);
				}
			}
			return newYearData;
		}

	updateWithNewData(updateRegionData());

	function updateWithNewData(data){
		console.log(data);
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
		svg.selectAll("rect").data(data).enter().append("rect")
        .attr("class",function(d,i){return "rectangle"})
        .attr("id",function(d,i){return d.region})
		.attr("x",function(d,i){ return xScale(d.region)})
		.attr("y", function (d){ return yScale(d.antal)})
		.attr("width", xScale.rangeBand() )
		.attr("height", function (d){ return yScale(0) - yScale(d.antal) })
        .on('mouseover', tip.show)
        .on('mouseout', tip.hide)

		//Bygger akser
		var xAxis = d3.svg.axis().scale(xScale).orient("bottom");
		svg.append("g").attr("class", "axis").attr("transform","translate(0,"+(h-margin.top-margin.bottom)+")").call(xAxis);
		var yAxis = d3.svg.axis().scale(yScale).orient("left").ticks(15);
		svg.append("g").attr("class", "axis").attr("transform", "translate("+margin.left+",0)").call(yAxis);
	}
</script>
</body>
</head>


