function loadScreen(){
	d3.select("#gears").remove();
	// console.log(d3.select("#graph"));
	// console.log(d3.select("svg#graph"));



	var svg = d3.select("#graphContent").append("svg")
    .attr("width", 600)
    .attr("height", 300).attr('id','gears');

    // svg.append("rect").attr('width', 100).attr('height', 100).style('fill', '#000');

    var g = svg.append("g");

    var img = g.append("svg:image")
    .attr("xlink:href", "gears.gif")
    .attr("width", 200)
    .attr("height", 200)
    .attr("x", 228)
    .attr("y",53);
}