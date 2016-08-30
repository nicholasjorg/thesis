var doNotShow = new Array();
var chartData;
var oldData;
var lineColors;
var colorData;

function drawLineChart(data){
	oldData = data;
	chartData = new Array();
	// console.log("currentRegion : "+currentRegion+"  currentMunicipality : "+currentMunicipality);
	//Bygger datastruktur til lineChart
	var sumThis;
	var lastMuni;
	lineColors = [];
	colorData = [];
	

	//Giver random farver som key-value til alle kommuner.
	for (var i = 0; i < Object.keys(data).length; i++) {
		var randomColor = "hsl(" + Math.random() * 360 + ",100%,50%)";
		lineColors[data[i].kommune] = randomColor;
	}
	//Tilføjer data til chartData
	var counter = 0;
	for (var i = 0; i < Object.keys(data).length; i++) {
		// if(kunKommune === false && currentRegion === null){

		// 	colorData.push({"x":0, "y":counter*15, "color":"hsl(" + Math.random() * 360 + ",100%,50%)", "text":data[i].region});
		// 	counter++;
		// 	for (var j = 0; j < Object.keys(data[i].displayDate).length; j++) {
		// 		var obj = {"region":data[i].region, "displayDate":data[i].displayDate[j].displayDate, "antal":data[i].displayDate[j].antal};
		// 		var result = $.grep(chartData, function(obj) { return obj.region == data[i].region; });
		// 		if (result.length === 0) {
  //                         // not found
                          
  //                     } else if (result.length == 1) {
  //                         // access the foo property using result[0].foo
                          
  //                     }

		// 		if(Object.keys(chartData).length === 0 || lastMuni !== data[i].kommune) {
		// 			chartData.push({"kommune":data[i].region, "region":data[i].region, "displayDate":data[i].displayDate[j].displayDate, "antal":data[i].displayDate[j].antal, "color":lineColors[data[i].kommune]});
		// 			lastMuni = data[i].region;
		// 			sumThis = data[i].displayDate[j].antal;
		// 		}
		// 		else
		// 			sumThis = chartData[Object.keys(chartData).length-1].antal + data[i].displayDate[j].antal;

		// 		chartData.push({"kommune":data[i].region, "region":data[i].region, "displayDate":data[i].displayDate[j].displayDate, "antal":sumThis, "color":lineColors[data[i].kommune]});
		// 		}
		// }
		if(currentMunicipality !== null && currentMunicipality === data[i].kommune && hvilkenLineChart == "akkumuleret" 
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

	console.log(chartData);
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

    console.log("min: "+min+" max: "+max);

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
    .tickPadding(10);

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

    var svg = d3.select("#graphContent").append("svg")
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
		.attr('stroke', function() { return d.values[0].color; })
		.attr('stroke-width', 2)
		.attr('fill', 'none')
		.attr('id', "line_"+d.key)
		.attr('class', 'lineChartline');
		// .on('click', function(d){ clickedLine(this); });
		// .on('mouseover', function(d){ moveInLine(this); })
		// .on('mouseout', function(d){ moveOutLine(this); });
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
	console.log(d);
	currentRegion = d.region;
	currentMunicipality = d.kommune;
	drawLineChart(newData);
	whereAmI();
	// $("#"+d.id).css("display","none");
}

function clickedText(d){
	var fjernKommune = d.text;
	var string = "#".concat("text_").concat(fjernKommune);

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

}

function updateFarveLinechart(chartData){
	var widthBox = 200;
    var heightBox = colorData.length * 15; // Skal laves dynamisk!!!
    d3.select("#svgFarve").remove();

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