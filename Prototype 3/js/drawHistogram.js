function drawHistogram(data){
    // console.log("CurrentRegion: "+currentRegion+ "  currentMunicipality: "+currentMunicipality+ " kunKommune: "+kunKommune);
        if(currentRegion !== null && currentMunicipality === null || kunKommune === true)
            {drawHistogramKommune(data); console.log("drawHistogramKommune(data);"); }
        else if(currentMunicipality !== null)
            drawHistogramInstitutions(data);
        else
            drawHistogramRegion(data);
}

function drawHistogramRegion(data){
    //Fjerner gammel graf
    d3.select("svg").remove();

    var regions = {Hovedstaden:true, Midtjylland:true, Nordjylland:true, Sjælland:true, Syddanmark:true, UdenforDanmark:true};

    var newData = Array();
        //Kopiere de relevante regioner og typer ind i newData
        for(var i=0; i<Object.keys(data).length; i++){
            for (var key in regions) {
                if(regions[key] === true) {
                    if(data[i].region === key){
                        var result = $.grep(newData, function(e){ return e.region == key;});
                        var antalVærker = data[i].antal;
                        if (result.length === 0) {
                          // not found
                          var tmpArr = {region:key, antal:antalVærker};
                          newData.push(tmpArr);
                      } else if (result.length == 1) {
                          // access the foo property using result[0].foo
                          result[0].antal = result[0].antal+antalVærker;
                      }
                  }
              }
          }
      }
        //Sorterer data fra parametreret ascending order
        newData.sort(function(a,b){
            return parseFloat(a.antal) - parseFloat(b.antal);
        });
        
        //Sætter variable
        var margin = {top: 10, right: 0, bottom: 10, left: 40};
        var w = 500, h = 600;

        //Laver svg element til at komme figuren
        var svg = d3.select("#graphContent").append("svg").attr("id","graph").attr("width", w).attr("height", h);

        //Tooltip
        var tip = d3.tip()
          .attr('class', 'd3-tip')
          .offset([-10, 0])
          .html(function(d) {
            return "Klik for mere info om " +  d.region;
        });

        //Laver scale
        var min = newData[0].antal;
        var max = newData[Object.keys(newData).length-1].antal;
        var yScale = d3.scale.linear().range([h-margin.top-margin.bottom,margin.top]).nice();
        var xScale = d3.scale.ordinal().rangeRoundBands([margin.left, w-margin.left-margin.right], 0.1);
        var xScale2 = d3.scale.ordinal().rangeBands([0+margin.left, w+margin.left],0);

        yScale.domain([0,max]);
        xScale.domain(newData.map(function (d){return d.region;}));
        xScale2.domain(newData.map(function (d){return d.region;}));
        //From tooltip.js
        svg.call(tip);

        //Tegner rectangels
        svg.selectAll("rect").data(newData).enter()
        .append("svg:a")
        .append("rect")
        .attr("class",function(d,i){return "rectangle";})
        .attr("id",function(d,i){return d.region;})
        .attr("x",function(d,i){ return xScale(d.region);})
        .attr("y", function (d){ return yScale(d.antal);})
        .attr("width", xScale.rangeBand() )
        .attr("height", function (d){ return yScale(0) - yScale(d.antal);})
        .on("click", function(d){tip.hide(d); clickedRegion(data, this);})
        .on('mouseover', tip.show)
        .on('mouseout', tip.hide);

        //Bygger akser
        var xAxis = d3.svg.axis().scale(xScale).orient("bottom");
        svg.append("g").attr("class", "axis").attr("transform","translate(0,"+(h-margin.top-margin.bottom)+")").call(xAxis);
        var yAxis = d3.svg.axis().scale(yScale).orient("left").ticks(15);
        svg.append("g").attr("class", "axis").attr("transform", "translate("+margin.left+",0)").call(yAxis);

        if(gennemsnit === true){
            //Tegner gennemsnitsstreg
            var dataSum = d3.sum(newData, function(d) { return d.antal; });

            var avg = dataSum/newData.length;

            svg.append("line")
            .style("stroke", "black")
            .attr("x1", 0+margin.left)
            .attr("y1", yScale(avg))
            .attr("x2", w-margin.right)
            .attr("y2", yScale(avg))
            .attr("id", "averageLine")
            .attr("class", "line");

            $("#gennemsnitsInfo").empty().append("<h3>Gennemsnit:</h3><b>Gennemsnitstal: </b>"+avg);
        }
    }

    function clickedRegion(data, d){
        // console.log(data);
        // console.log(d);
        currentRegion = d.id;
        whereAmI();
        // console.log("currentregion: "+currentRegion);
        drawHistogramKommune(data);

    }

function drawHistogramKommune(data){
    //Fjerner gammel graf
    d3.select("svg").remove();

    var newData = Array();

    //Kopiere de relevante regioner og typer ind i newData, hvis dette er ingen for en enkelt region
    if(kunKommune === false || currentRegion !== null){
        for(var i=0; i<Object.keys(data).length; i++){
                if(data[i].region == currentRegion){
                    var result = $.grep(newData, function(e){ return e.region == currentRegion;});
                    var antalVærker = data[i].antal;
                    var tmpKommune = data[i].kommune;
                    if (result.length === 0) {
                        // not found
                        var tmpArr = {kommune:tmpKommune, antal:antalVærker};
                        newData.push(tmpArr);
                    } else if (result.length == 1) {
                        // access the foo property using result[0].foo
                        result[0].antal = result[0].antal+antalVærker;
                    }
                }
            }
    }
    else newData = data;
    
        //Sorterer data fra parametreret ascending order
        newData.sort(function(a,b){
            return parseFloat(a.antal) - parseFloat(b.antal);
        });

        //Sætter variable
        var margin = {top: 10, right: 0, bottom: 100, left: 40};
        var w = 500, h = 600;

        //Laver svg element til at komme figuren
        var svg = d3.select("#graphContent").append("svg").attr("id","graph").attr("width", w).attr("height", h);

        //Tooptip
        var tip = d3.tip()
          .attr('class', 'd3-tip')
          .offset([-10, 0])
          .html(function(d) {
            return "Klik for mere info om " +  d.kommune;
        });

        //Laver scale
        var min = newData[0].antal;
        var max = newData[Object.keys(newData).length-1].antal;
        var yScale = d3.scale.linear().range([h-margin.top-margin.bottom,margin.top]).nice();
        var xScale = d3.scale.ordinal().rangeRoundBands([margin.left, w-margin.left-margin.right], 0.1);
        var xScale2 = d3.scale.ordinal().rangeBands([0+margin.left, w+margin.left],0);

        yScale.domain([0,max]);
        xScale.domain(newData.map(function (d){return d.kommune;}));
        xScale2.domain(newData.map(function (d){return d.kommune;}));
        //From tooltip.js
        svg.call(tip);

        //Tegner rectangels
        svg.selectAll("rect").data(newData).enter()
        .append("svg:a")
        .append("rect")
        .attr("class",function(d,i){return "rectangle";})
        .attr("id",function(d,i){return d.kommune;})
        .attr("x",function(d,i){ return xScale(d.kommune);})
        .attr("y", function (d){ return yScale(d.antal);})
        .attr("width", xScale.rangeBand() )
        .attr("height", function (d){ return yScale(0) - yScale(d.antal);})
        .on("click", function(d){tip.hide(d); clickedKommune(data, this);})
        .on('mouseover', tip.show)
        .on('mouseout', tip.hide);


        //Titel på diagram
        svg.append("text")
        .attr("x", w / 2 )
        .attr("y", 30)
        .style("text-anchor", "middle")
        .text("Antal værker i region "+currentRegion);

        //Bygger akser
        var xAxis = d3.svg.axis().scale(xScale).orient("bottom");
        svg.append("g").attr("class", "axis").attr("transform","translate(0,"+(h-margin.top-margin.bottom)+")").call(xAxis)
        .selectAll("text")
        .attr("y", 0)
        .attr("x", 9)
        .attr("dy", ".35em")
        .attr("transform", "rotate(90)")
        .style("text-anchor", "start");
        var yAxis = d3.svg.axis().scale(yScale).orient("left").ticks(15);
        svg.append("g").attr("class", "axis").attr("transform", "translate("+margin.left+",0)").call(yAxis);

        if(gennemsnit === true){
            //Tegner gennemsnitsstreg
            var dataSum = d3.sum(newData, function(d) { return d.antal; });

            var avg = dataSum/newData.length;

            svg.append("line")
            .style("stroke", "black")
            .attr("x1", 0+margin.left)
            .attr("y1", yScale(avg))
            .attr("x2", w-margin.right)
            .attr("y2", yScale(avg))
            .attr("id", "averageLine")
            .attr("class", "line");

            var landMed = d3.median(data, function(d) { return d.antal; });
            console.log("meidan: "+landMed);
            var landMean = d3.mean(data, function(d) { return d.antal; });
            console.log("Mean: "+landMean);

            $("#gennemsnitsInfo").empty().append("<h3>Gennemsnit:</h3><b>Gennemsnitstal: </b>"+avg);
        }
    }

    function clickedKommune(data, d){
        currentMunicipality = d.id;
        for (var i = 0; i < Object.keys(newData).length; i++) {
            if(newData[i].kommune === currentMunicipality){
                currentRegion = newData[i].region;
                break;
            }
        };
        whereAmI();
        drawHistogramInstitutions(data);
        document.getElementById("indbyggertalCheck").checked = false;
    }

    function drawHistogramInstitutions(data){
    //Fjerner gammel graf
    d3.select("svg").remove();

    var newData = Array();
    //Kopiere de relevante regioner og typer ind i newData
    for(var i=0; i<Object.keys(data).length; i++){
        if(data[i].kommune == currentMunicipality){
           for(var j=0; j<Object.keys(data[i].institioner).length; j++){
            if(data[i].institioner[j].antal !== 0)
                newData.push(data[i].institioner[j]);
           }
        break;
        }
    }
        //Sorterer data fra parametreret ascending order
        newData.sort(function(a,b){
            return parseFloat(a.antal) - parseFloat(b.antal);
        });

        //Sætter variable
        var margin = {top: 10, right: 0, bottom: 100, left: 40};
        var w = 500, h = 600;

        //Laver svg element til at komme figuren
        var svg = d3.select("#graphContent").append("svg").attr("id","graph").attr("width", w).attr("height", h);

        //Laver scale
        var min = newData[0].antal;
        var max = newData[Object.keys(newData).length-1].antal;
        var yScale = d3.scale.linear().range([h-margin.top-margin.bottom,margin.top]).nice();
        var xScale = d3.scale.ordinal().rangeRoundBands([margin.left, w-margin.left-margin.right], 0.1);
        var xScale2 = d3.scale.ordinal().rangeBands([0+margin.left, w+margin.left],0);

        yScale.domain([0,max]);
        xScale.domain(newData.map(function (d){return d.institution;}));
        xScale2.domain(newData.map(function (d){return d.institution;}));
        //From tooltip.js
        // svg.call(tip);

        //Tegner rectangels
        svg.selectAll("rect").data(newData).enter()
        .append("svg:a")
        .append("rect")
        .attr("class",function(d,i){return "rectangleIns";})
        .attr("id",function(d,i){return d.institution;})
        .attr("x",function(d,i){ return xScale(d.institution);})
        .attr("y", function (d){ return yScale(d.antal);})
        .attr("width", xScale.rangeBand() )
        .attr("height", function (d){ return yScale(0) - yScale(d.antal);});
        // .on('mouseover', tip.show)
        // .on('mouseout', tip.hide);

        //Titel på diagram
        svg.append("text")
        .attr("x", w / 2 )
        .attr("y", 30)
        .style("text-anchor", "middle")
        .text("Fordelingen på institioner i "+currentMunicipality);

        //Bygger akser
        var xAxis = d3.svg.axis().scale(xScale).orient("bottom");
        svg.append("g").attr("class", "axis").attr("transform","translate(0,"+(h-margin.top-margin.bottom)+")").call(xAxis)
        .selectAll("text")
        .attr("y", 0)
        .attr("x", 9)
        .attr("dy", ".35em")
        .attr("transform", "rotate(90)")
        .style("text-anchor", "start");
        var yAxis = d3.svg.axis().scale(yScale).orient("left").ticks(15);
        svg.append("g").attr("class", "axis").attr("transform", "translate("+margin.left+",0)").call(yAxis);
    }