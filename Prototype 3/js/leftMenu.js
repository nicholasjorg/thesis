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
        console.log(posibleResults);
    });

//Fylder arrays ud med de regioner eller kommuner i en valgt region som ikke er den nuværende 
var ikkeValgteRegioner = [];
var ikkeValgteKommuner = [];

for (var i = 0; i < Object.keys(newData).length; i++) {
    $("#dropdownSearch").append('<option data-tokens="'+newData[i].kommune+'">'+newData[i].kommune+'</option>');
}





}