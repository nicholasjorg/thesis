var doNotShow = new Array();
var chartData;
var oldData;
var lineColors, lineColorRegion;
var colorData;

function drawLineChart(data){
	oldData = data;
	chartData = new Array();
	// console.log("currentRegion : "+currentRegion+"  currentMunicipality : "+currentMunicipality);
	//Bygger datastruktur til lineChart
	var sumThis;
	var lastMuni;
	lineColors = [];
	lineColorRegion = [];
	colorData = [];

	var color20 = d3.scale.category20();

	lineColorRegion["Hovedstaden"] = color20(0);
	lineColorRegion["Nordjylland"] = color20(6);
	lineColorRegion["Midtjylland"] = color20(2);
	lineColorRegion["Syddanmark"] = color20(3);
	lineColorRegion["Sjælland"] = color20(4);
	
	//Giver random farver som key-value til alle kommuner.
	for (var i = 0; i < Object.keys(data).length; i++) {
		var randomColor = "hsl(" + Math.random() * 360 + ",100%,50%)";
		lineColors[data[i].kommune] = randomColor;
	}
	//Tilføjer data til chartData
	var counter = 0;
	for (var i = 0; i < Object.keys(data).length; i++) {
		//Her skal alle kommuner vises med samme farveindeling i regioner
		if(kunKommune === true && currentRegion === null){
			colorData.push({"x":0, "y":counter*15, "color":lineColorRegion[data[i].region], "text":data[i].kommune});
			counter++;
			if(hvilkenLineChart === "akkumuleret"){
				for (var j = 0; j < Object.keys(data[i].displayDate).length; j++) {
				if(Object.keys(chartData).length === 0 || lastMuni !== data[i].kommune) {
					chartData.push({"kommune":data[i].kommune, "region":data[i].region, "displayDate":data[i].displayDate[j].displayDate, "antal":data[i].displayDate[j].antal, "color":lineColorRegion[data[i].region]});
					lastMuni = data[i].kommune;
					sumThis = data[i].displayDate[j].antal;
				}
				else
					sumThis = chartData[Object.keys(chartData).length-1].antal + data[i].displayDate[j].antal;

				chartData.push({"kommune":data[i].kommune, "region":data[i].region, "displayDate":data[i].displayDate[j].displayDate, "antal":sumThis, "color":lineColorRegion[data[i].region]});
				}
			}
			else if(hvilkenLineChart == "enkelt"){
				for (var j = 0; j < Object.keys(data[i].displayDate).length; j++) {
					chartData.push({"kommune":data[i].kommune, "region":data[i].region, "displayDate":data[i].displayDate[j].displayDate, "antal":data[i].displayDate[j].antal, "color":lineColorRegion[data[i].region]});
				}
			}
			
		}


		else if(currentMunicipality !== null && currentMunicipality === data[i].kommune && hvilkenLineChart == "akkumuleret" 
			|| currentRegion !== null && data[i].region === currentRegion && currentMunicipality === null && hvilkenLineChart == "akkumuleret"
			|| currentRegion === null && hvilkenLineChart == "akkumuleret"){
			colorData.push({"x":0, "y":counter*15, "color":lineColors[data[i].kommune], "text":data[i].kommune});
			counter++;
			for (var j = 0; j < Object.keys(data[i].displayDate).length; j++) {
				if(Object.keys(chartData).length === 0 || lastMuni !== data[i].kommune) {
					chartData.push({"kommune":data[i].kommune, "region":data[i].region, "displayDate":data[i].displayDate[j].displayDate, "antal":data[i].displayDate[j].antal, "color":lineColors[data[i].kommune]});
					lastMuni = data[i].kommune;
					sumThis = data[i].displayDate[j].antal;
				}
				else
					sumThis = chartData[Object.keys(chartData).length-1].antal + data[i].displayDate[j].antal;

				chartData.push({"kommune":data[i].kommune, "region":data[i].region, "displayDate":data[i].displayDate[j].displayDate, "antal":sumThis, "color":lineColors[data[i].kommune]});
				}
		}
		else if(currentMunicipality !== null && currentMunicipality === data[i].kommune && hvilkenLineChart == "enkelt" 
			|| currentRegion !== null && data[i].region === currentRegion && currentMunicipality === null && hvilkenLineChart == "enkelt" 
			|| currentRegion === null && hvilkenLineChart == "enkelt"){
			colorData.push({"x":0, "y":counter*15, "color":lineColors[data[i].kommune], "text":data[i].kommune});
			counter++;
			for (var j = 0; j < Object.keys(data[i].displayDate).length; j++) {
				chartData.push({"kommune":data[i].kommune, "region":data[i].region, "displayDate":data[i].displayDate[j].displayDate, "antal":data[i].displayDate[j].antal, "color":lineColors[data[i].kommune]});
			}
}
else{
			// console.log("IKKE FANGET AF NOGLE IF!");
		}
	}

	drawLineChartOrdinal(chartData);
}

function addCheckboks(){
	$("#chartRadioButtons").empty().append(
		'<div class="lineChartRadio"><form><div class="radio-inline"><label><input type="radio" name="skiftChart" value="enkelt">Enkelt</label></div><div class="radio"><label><input type="radio" name="skiftChart" value="akkumuleret">Akkumuleret</label></div></form></div>');
}


function drawLineChartOrdinal(chartData){
	d3.select("#graph").remove();
	var data = new Array();
	
	for (var i = 0; i < Object.keys(chartData).length; i++) {
		if(jQuery.inArray(chartData[i].kommune, doNotShow) === -1)
			data.push(chartData[i]);
	}


	var margin = {top: 20, right: 20, bottom: 30, left: 50},
	width = 800 - margin.left - margin.right,
	height = 500 - margin.top - margin.bottom;

	var dataGroup = d3.nest()
	.key(function(d) {
		return d.kommune;
	})
	.entries(data);

    // console.log(JSON.stringify(dataGroup));

    function findMin(){
		if(year !== null) return year;
		else if(startYear !== null) return startYear - 1;
		else return d3.min(data, function(d){ return d.displayDate; });
    }
    function findMax(){
		if(year !== null) return parseFloat(year) + 1;
		else if(endYear !== null) return endYear;
		else return d3.max(data, function(d){ return d.displayDate; });
    }

    var min = findMin();
    var max = findMax();

    var xScale = d3.scale.linear()
    .domain([min, max])
    .range([0, width]);

    var yScale = d3.scale.linear()
    .domain([0, d3.max(data, function(d){ return d.antal; })])
    .range([height, 0]);

    var xAxis = d3.svg.axis()
    .scale(xScale)
    .orient("bottom")
    .innerTickSize(-height)
    .outerTickSize(0)
    .tickPadding(10)
    .tickFormat(d3.format("d"));

    var yAxis = d3.svg.axis()
    .scale(yScale)
    .orient("left")
    .innerTickSize(-width)
    .outerTickSize(0)
    .tickPadding(10);

    var voronoi = d3.geom.voronoi()
    .x(function(d) { return xScale(d.displayDate); })
    .y(function(d) { return yScale(d.antal); });
    // .clipExtent([[0, 0], [width, height]]);

    var line = d3.svg.line()
    .x(function(d) { return xScale(d.displayDate); })
    .y(function(d) { return yScale(d.antal); });

    var svg = d3.select("#graphWrapper")
    .append("svg")
    .attr("id", "graph")
    .attr("width", width + margin.left + margin.right)
    .attr("height", height + margin.top + margin.bottom)
    .append("g")
    .attr("transform", "translate(" + margin.left + "," + margin.top + ")");

    svg.append("g")
    .attr("class", "x axis")
    .attr("transform", "translate(0," + height + ")")
    .call(xAxis);

    svg.append("g")
    .attr("class", "y axis")
    .call(yAxis);

    var lineGen = d3.svg.line()
    .x(function(d) { return xScale(d.displayDate); })
    .y(function(d) { return yScale(d.antal); });

    dataGroup.forEach(function(d, i) {
		svg.append('svg:path')
		.attr('d', lineGen(d.values))
		.attr('stroke', function() {
			return d.values[0].color;
			// if (kunKommune === true)
			// 	return d3.scale.category20(i);
			// else
			// 	return d.values[0].color;
		})
		.attr('stroke-width', 2)
		.attr('fill', 'none')
		.attr('id', "line_"+d.key)
		.attr('class', 'lineChartline');
    });

    var focus = svg.append("g")
        .attr("transform", "translate(-100,-100)")
        .attr("class", "focus");

      focus.append("circle")
        .attr("r", 3.5);

      focus.append("text")
        .attr("y", -10);


    var voronoiGroup = svg.append("g")
        .attr("class", "voronoi")
        .attr("id", "graph");

      voronoiGroup.selectAll("path")
        .data(voronoi(chartData))
        .enter().append("path")
        .attr("d", function(d) { if(d !== undefined) return "M" + d.join("L") + "Z";}) //return "M" + d.join("L") + "Z";
        .datum(function(d) {
          if(d !== undefined) return d.point;
        })
        .on("click", function(d){ clickedLine(d); })
        .on("mouseover", moveInLine)
        .on("mouseout", moveOutLine);

    updateFarveLinechart(chartData);

    function moveInLine(d){
		correntLeftInfo(d.antal);
		$("#dod").empty().append("<h3>Info:</h3><b>Region: </b>"+d.region+"<br /><b>Kommune: </b>"+d.kommune+"<br /> <b>Antal værker: </b>"+d.antal);
		d3.selectAll(".lineChartline")
		.transition()
		.duration(300)
		.style('stroke-width', 1);

		var lineId = "#".concat("line_").concat(d.kommune);
		var textId = "#".concat("text_").concat(d.kommune);
		d3.select(lineId)
		.transition()
		.duration(300)
		.style('stroke-width', 5);

		d3.select(textId).style('font-weight', 'bold');

		focus.attr("transform", "translate(" + xScale(d.displayDate) + "," + yScale(d.antal) + ")");
		focus.select("text").text("År: "+d.displayDate+" Antal: "+d.antal);
	}

	function moveOutLine(d){
		updateLeftInfoForLineChart();
		d3.selectAll(".lineChartline")
		.transition()
		.duration(300)
		.style('stroke-width', 2);

		d3.selectAll(".colorCodeText").style('font-weight', 'normal');

		focus.attr("transform", "translate(-100,-100)");
	}
}

function clickedLine(d){
	currentRegion = d.region;
	currentMunicipality = d.kommune;
	$("#graphWrapper").fadeOut(function(){
        $("#loadScreen").fadeIn(function(){
                drawLineChart(newData);
            $("#loadScreen").fadeOut(function(){
                $("#graphWrapper").fadeIn(function(){
                });
            });
        });
    });
	whereAmI();
}

function clickedText(d){
	var fjernKommune = d.text;
	var string = "#".concat("text_").concat(fjernKommune);

	$("#graphWrapper").fadeOut(function(){
		$("#loadScreen").fadeIn(function(){
			if(jQuery.inArray(fjernKommune, doNotShow) !== -1){
				//Er i array
				$(string).css("text-decoration", "none");
				doNotShow.splice(jQuery.inArray(fjernKommune, doNotShow),1);
				drawLineChartOrdinal(chartData);
			}
			else{
				//Er ikke i array
				$(string).css("text-decoration", "line-through");
				doNotShow.push(fjernKommune);
				drawLineChartOrdinal(chartData);
			}
			$("#loadScreen").fadeOut(function(){
				$("#graphWrapper").fadeIn(function(){
				});
			});
		});
	});
}

function updateFarveLinechart(chartData){
	var widthBox = 200;
    var heightBox = colorData.length * 15; // Skal laves dynamisk!!!
    d3.select("#svgFarve").remove();

    $("#farvekode").empty().append('<div id="buttonsForSelection" class="row"><a type="button" class="btn btn-default btn-xs" onclick="selectAll()">Vælg alle</a><a type="button" class="btn btn-default btn-xs" onclick="deselectAll()">Fravælg alle</a></div>');

    var svg = d3.select("#farvekode").append("svg").attr("id","svgFarve").attr("width", widthBox).attr("height", heightBox);
    var rects = svg.selectAll("rect").data(colorData).enter().append("rect");
    var rectAttr = rects.attr("x", function(d){return d.x; })
    .attr("y", function(d, i){return d.y; })
    .attr("width", widthBox/10)
    .attr("height", 10)
    .attr('id', function(d){return "colorBox_"+d.text; })
    .style('fill', function(d){return d.color; })
    .on('mouseover', function(d){ moveInText(d); })
    .on('mouseout', function(d){ moveOutText(d); });

    var text = svg.selectAll("text").data(colorData).enter().append("text");
    text.attr("x", function(d){return d.x + 20; })
    .attr("y", function(d, i){return d.y + 10; })
    .text(function(d){return d.text;})
    .attr('class', 'colorCodeText')
    .attr('id', function(d){return "text_"+d.text; })
    .style('text-decoration', function(d){
		if(jQuery.inArray(d.text, doNotShow) !== -1) return 'line-through';
		else return 'none';
    })
    .on('click', function(d){ clickedText(d);})
    .on('mouseover', function(d){ moveInText(d); })
    .on('mouseout', function(d){ moveOutText(d); });
}

function selectAll(){
	console.log("select all function");
	$("#graphWrapper").fadeOut(function(){
		$("#loadScreen").fadeIn(function(){
			doNotShow = [];
			drawLineChartOrdinal(chartData);
			
			$("#loadScreen").fadeOut(function(){
				$("#graphWrapper").fadeIn(function(){
				});
			});
		});
	});
}

function deselectAll(){
	console.log("deselect all function");
	$("#graphWrapper").fadeOut(function(){
		$("#loadScreen").fadeIn(function(){
			for (var i = 0; i < Object.keys(chartData).length; i++) {
				var fjernKommune = chartData[i].kommune;
				var string = "#".concat("text_").concat(fjernKommune);
				if(jQuery.inArray(fjernKommune, doNotShow) === -1){
					//Er ikke array
					$(string).css("text-decoration", "line-through");
					doNotShow.push(fjernKommune);
				}
			}
			drawLineChartOrdinal(chartData);
			$("#loadScreen").fadeOut(function(){
					$("#graphWrapper").fadeIn(function(){
					});
				});
			});
	});
}

function moveInText(d){
	updateLeftInfoForLineChart();
	d3.selectAll(".lineChartline")
	.transition()
	.duration(300)
	.style('stroke-width', 1);

	var lineId = "#".concat("line_").concat(d.text);
	d3.select(lineId)
	.transition()
	.duration(300)
	.style('stroke-width', 5);

	d3.selectAll(".colorCodeText").style('font-weight', 'normal');
	d3.select("#text_"+d.text).style('font-weight', 'bold');
}

function moveOutText(d){
	updateLeftInfoForLineChart();
	d3.selectAll(".lineChartline")
	.transition()
	.duration(300)
	.style('stroke-width', 2);

	d3.selectAll(".colorCodeText").style('font-weight', 'normal');
}