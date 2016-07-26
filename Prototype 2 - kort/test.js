var main_chart_svg = d3.select("body")
        .append("svg")
        .attr({
            "width":600,
            "height":400
        });


main_chart_svg.append("rect")
    .attr({
        class:"this is just a test rect",
        width:200,
        height:100,
        fill:"none",
        "stroke":"black",
        "stroke-width":5
    });

d3.xml("kort.svg", function(error, documentFragment) {
        if (error) {console.log(error); return;}
    
        var svgNode = documentFragment
                    .getElementsByTagName("svg")[0];
    
        main_chart_svg.node().appendChild(svgNode);

        var innerSVG = main_chart_svg.select("svg");
    
        innerSVG.transition().duration(1000).delay(1000)
              .select("circle")
              .attr("r", 100);

    });





/*
This is the code of the loaded svg

<?xml version="1.0" encoding="UTF-8" standalone="no"?>
<svg xmlns="http://www.w3.org/2000/svg" width="500" height="500">
<circle cx="250" cy="250" r="210" fill="#fff" stroke="#000" stroke-width="8"/>
</svg>
*/