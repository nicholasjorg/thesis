function updateNaviMap(){

	var svg = d3.select("#naviMap").append("naviMap").style('width', '200').style('height', '243');



    d3.xml("kort.svg", function(error, documentFragment) {
        if (error) {console.log(error); return;}
    
        var svgNode = documentFragment.getElementsByTagName("naviMap")[0];
        console.log(svgNode);
        
        svg.node().appendChild(svgNode);

        var a = document.getElementById("SVGmap");
        //d3.select(a).style('width', '200').style('height', '243');
        var b = a.querySelectorAll("g:not(#masterGroup)");
        // console.log(b);
        var c = a.getElementsByTagName("polygon");
        // console.log(c);

        var mapContainer = d3.select("#SVGmap").attr('width',200).attr('height', 243);

        var masterGroup = d3.select("#masterGroup");
        masterGroup.style('width', '200').style('height', '243');
        console.log(masterGroup);
        d3.selectAll(b).style("stroke","brown").attr("stroke-width","0.2").on("click", function(){ clicked(this);});
});

}

function updateActiveyears(){
    if(year !== null)
        $("#aktiveÅr").empty().append(year);
    else if(startYear !== null && endYear !== null)
        $("#aktiveÅr").empty().append(startYear+" - "+endYear);
}

function searchForMunicipality(){
    $("#searchField").keyup(function(){
        var posibleResults = [];
        var searchtext = $(this).val();
        for (var i = 0; i < Object.keys(newData).length; i++) {
            if ( searchtext.indexOf(newData[i].kommune) > -1 ) {
                posibleResults.push(newData[i].kommune);
                // String B contains String A
            }
        }
        console.log(posibleResults);
    });
}
function addSearchData(){

    $("#searchField").keyup(function(){
        var searchtext = $(this).val();
        var posibleResults = [];
        for (var i = 0; i < Object.keys(newData).length; i++) {
            if ( newData[i].kommune.toLowerCase().includes(searchtext.toLowerCase(),0) ) {
                posibleResults.push(newData[i].kommune);
                // String B contains String A
            }
        }
    });

//Fylder arrays ud med de regioner eller kommuner i en valgt region som ikke er den nuværende 
var ikkeValgteRegioner = [];
var ikkeValgteKommuner = [];

for (var i = 0; i < Object.keys(newData).length; i++) {
    $("#dropdownSearch").append('<option data-tokens="'+newData[i].kommune+'">'+newData[i].kommune+'</option>');
    }
}

function correntLeftInfo(antal){
    $("#dod").empty().append("<h3>Info:</h3><b>Region: </b>"+currentRegion+"<br /><b>Kommune: </b>"+currentMunicipality+"<br /> <b>Antal værker: </b>"+antal);
}

function updateFarvekode(q){
    var widthBox = 200;
    var heightBox = 120;
    d3.select("#svgFarve").remove();
    // var svg = d3.select("#farvekode").append("svg").attr("id","svgFarve").attr("width", widthBox).attr("height", heightBox);
    // svg.append("rect").attr("x", 0).attr("y", 0).attr("width", widthBox/10).attr("height", 20).style('fill', colors.min);
    // svg.append("text").attr("x", 20).attr("y", 0).text(function(){return q.min;});
    // svg.append("rect").attr("x", 0).attr("y", 25).attr("width", widthBox/10).attr("height", 20).style('fill', colors.q1);
    // svg.append("text").attr("x", 20).attr("y", 0).text(function(){return q.q1;});
    // svg.append("rect").attr("x", 0).attr("y", 50).attr("width", widthBox/10).attr("height", 20).style('fill', colors.q2);
    // svg.append("rect").attr("x", 0).attr("y", 75).attr("width", widthBox/10).attr("height", 20).style('fill', colors.q3).append("text").text("her er tekst til en boks");
    // svg.append("rect").attr("x", 0).attr("y", 100).attr("width", widthBox/10).attr("height", 20).style('fill', colors.max);

    var colorData = [];

    colorData.push({"x":0, "y":0, "color":colors.min, "antal":q.min});
    colorData.push({"x":0, "y":25, "color":colors.q1, "antal":q.q1});
    colorData.push({"x":0, "y":50, "color":colors.q2, "antal":q.q2 });
    colorData.push({"x":0, "y":75, "color":colors.q3, "antal":q.q3 });
    colorData.push({"x":0, "y":100, "color":colors.max, "antal":q.max });

    // console.log(colorData);

    var svg = d3.select("#farvekode").append("svg").attr("id","svgFarve").attr("width", widthBox).attr("height", heightBox);
    var rects = svg.selectAll("rect").data(colorData).enter().append("rect");
    var rectAttr = rects.attr("x", function(d){return d.x; })
                    .attr("y", function(d, i){return d.y; })
                    .attr("width", widthBox/10)
                    .attr("height", 20)
                    .style('fill', function(d){return d.color; });
var prev = 0;
    var text = svg.selectAll("text").data(colorData).enter().append("text");
    var textLavel = text.attr("x", function(d){return d.x + 20; })
                    .attr("y", function(d, i){return d.y + 15; })
                    .text(function(d){return prev + " - " + d.antal; prev=d.antal;});





}