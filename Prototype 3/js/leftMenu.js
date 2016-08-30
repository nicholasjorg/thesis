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
    if(currentRegion === null)
        $("#dod").empty().append("<h3>Info:</h3><b>Region: </b>Alle<br /><b>Kommune: </b>Alle<br /> <b>Antal værker: </b>"+antal);
    else if(currentMunicipality === null)
        $("#dod").empty().append("<h3>Info:</h3><b>Region: </b>"+currentRegion+"<br /><b>Kommune: </b>Alle<br /> <b>Antal værker: </b>"+antal);
    else 
        $("#dod").empty().append("<h3>Info:</h3><b>Region: </b>"+currentRegion+"<br /><b>Kommune: </b>"+currentMunicipality+"<br /> <b>Antal værker: </b>"+antal);
}

function updateLeftInfoForLineChart(){
    if(currentRegion === null)
        $("#dod").empty().append("<h3>Info:</h3><b>Region: </b>Alle<br /><b>Kommune: </b>Alle");
    else if(currentMunicipality === null)
        $("#dod").empty().append("<h3>Info:</h3><b>Region: </b>"+currentRegion+"<br /><b>Kommune: </b>Alle");
    else
        $("#dod").empty().append("<h3>Info:</h3><b>Region: </b>"+currentRegion+"<br /><b>Kommune: </b>"+currentMunicipality);
}

function updateFarvekode(q){
    var widthBox = 200;
    var heightBox = 120;
    d3.select("#svgFarve").remove();
 
    var colorData = [];
    if(gennemsnit === true || median === true){
        colorData.push({"x":0, "y":0, "color":"red", "antal":"under"});
        colorData.push({"x":0, "y":25, "color":"yellow", "antal":yellowIs});
        colorData.push({"x":0, "y":50, "color":"green", "antal":"over"});
    } else {
        colorData.push({"x":0, "y":0, "color":colors.min, "antalFrom":q.min, "antalTo":q.q1 });
        colorData.push({"x":0, "y":25, "color":colors.q1, "antalFrom":q.q1, "antalTo":q.q2 });
        colorData.push({"x":0, "y":50, "color":colors.q2, "antalFrom":q.q2, "antalTo":q.q3 });
        colorData.push({"x":0, "y":75, "color":colors.q3, "antalFrom":q.q3, "antalTo":q.beforeMax });
        colorData.push({"x":0, "y":100, "color":colors.max, "antalFrom":q.max, "antalTo":q.max });
    }

    var svg = d3.select("#farvekode").append("svg").attr("id","svgFarve").attr("width", widthBox).attr("height", heightBox);
    var rects = svg.selectAll("rect").data(colorData).enter().append("rect");
    var rectAttr = rects.attr("x", function(d){return d.x; })
                    .attr("y", function(d, i){return d.y; })
                    .attr("width", widthBox/10)
                    .attr("height", 20)
                    .style('fill', function(d){return d.color; });

    var text = svg.selectAll("text").data(colorData).enter().append("text");
    // Hvis kou kommuner ses eller der er trykket ind på en region
    if(kunKommune === true || currentRegion !== null){
       text.attr("x", function(d){return d.x + 25; })
       .attr("y", function(d, i){return d.y + 15; })
       .text(function(d){return d.antalFrom + " - " + d.antalTo;});
    }
    else if(gennemsnit === true || median === true){
        text.attr("x", function(d){return d.x + 25; })
       .attr("y", function(d, i){return d.y + 15; })
       .text(function(d){return d.antal;});
    }
    //Regionsoversigt
    else {
        text.attr("x", function(d){return d.x + 25; })
        .attr("y", function(d, i){return d.y + 15; })
        .text(function(d){return d.antalFrom[1];});
    }
}