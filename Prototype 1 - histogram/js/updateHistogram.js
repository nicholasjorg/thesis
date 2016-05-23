    //Funktion til at opdatere graf
    var update = function(){
        //Fjerner gammel graf
        d3.select("svg").remove();

        var newData = new Array();
        for(var h=0; h<Object.keys(filterJsonArr).length; h++){
            if(filterJsonArr[h].region == "needschanging") { filterJsonArr[h].region = null }
            if(filterJsonArr[h].region != null) { newData.push(filterJsonArr[h]); }
        }
        //Sorterer newData ascending order
        newData.sort(function(a,b){
            return parseFloat(a.antal) - parseFloat(b.antal);
        });

        //Sætter variable
        var margin = {top: 10, right: 0, bottom: 10, left: 40};
        var w = 500, h = 500;

        //Laver svg element til at komme figuren
        var svg = d3.select("#contentRow").append("svg").attr("id","graph").attr("width", w).attr("height", h);

        //Laver scale
        var min = newData[0].antal;
        var max = newData[Object.keys(newData).length-1].antal;
        var yScale = d3.scale.linear().domain([0,max]).range([h-margin.top-margin.bottom,margin.top]).nice();
        var xScale = d3.scale.ordinal().domain(newData.map(function (d){return d.region})).rangeRoundBands([margin.left, w-margin.left-margin.right], 0.1);

        //Tegner rectangels
        svg.selectAll("rect").data(newData).enter().append("rect")
        .attr("x",function(d,i){ return xScale(d.region)})
        .attr("y", function (d){ return yScale(d.antal)})
        .attr("width", xScale.rangeBand() )
        .attr("height", function (d){ return yScale(0) - yScale(d.antal) })
        .attr("fill", "teal");

        //Bygger akser
        var xAxis = d3.svg.axis().scale(xScale).orient("bottom");
        svg.append("g").attr("class", "axis").attr("transform","translate(0,"+(h-margin.top-margin.bottom)+")").call(xAxis);
        var yAxis = d3.svg.axis().scale(yScale).orient("left").ticks(15);
        svg.append("g").attr("class", "axis").attr("transform", "translate("+margin.left+",0)").call(yAxis);
    }
    //Kalder update første gang.
    fadeOut().done(update);