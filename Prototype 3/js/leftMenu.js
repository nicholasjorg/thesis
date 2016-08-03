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
