    var colors = {"min":"#b3d9ff", "q1":"#66b3ff", "q2":"#1a8cff", "q3":"#0066cc", "max":"#004080"};

    function giveColors(newData){
        console.log("Så skal der farve på drengen!");
        var q = calculateQuatil(newData);
        // updateFarvekode(q);
        // console.log(q);
        //console.log("min: "+q.min+" q1: "+q.q1+" q2: "+q.q2+" q3: "+q.q1+" max: "+q.max);
        // console.log("currentRegion: "+currentRegion);
        // console.log("CurrentRegion: "+currentRegion+ "  currentMunicipality: "+currentMunicipality);
        if(gennemsnit === true){
            console.log("gennemsnit er true");
            console.log(q);
            for (var i = 0; i < Object.keys(newData).length; i++) {
                if(newData[i].region == "UdenforDanmark") continue;
                var string = "#".concat(newData[i].kommune);
                //Giver forskellige farver baseret på værdi ifht. kvartil
                if(newData[i].antal < q.q2) {$(string).css("fill", "red"); $(string).css("opacity", 1);}
                else if(newData[i].antal == q.q2) {$(string).css("fill", "yellow"); $(string).css("opacity", 1);}
                else if(newData[i].antal > q.q2) {$(string).css("fill", "green"); $(string).css("opacity", 1);}
            }
        }

        //Fuldt overblik. Ser hele kortet
        else if(currentRegion === null){
             for(var key in q){
                var string = ".".concat(q[key][0]);
                if(key == "min"){$(string).css("fill", colors.min); $(string).css("opacity", 1);}
                else if(key == "q1"){$(string).css("fill", colors.q1); $(string).css("opacity", 1);}
                else if(key == "q2"){$(string).css("fill", colors.q2); $(string).css("opacity", 1);}
                else if(key == "q3"){$(string).css("fill", colors.q3); $(string).css("opacity", 1);}
                else if(key == "max"){$(string).css("fill", colors.max); $(string).css("opacity", 1);}
            }
        }
        //Zoomet ind på enkelt kommune
        else if(currentMunicipality !== null){
            console.log("Skal farver en enkelt kommune");
            for (var i = 0; i < Object.keys(newData).length; i++) {
            var string = "#".concat(newData[i].kommune);
                //Giver fuld farve til valgt kommune
                if(newData[i].kommune === currentMunicipality){
                    console.log("Rigtig kommune valgt. Fuld farve: "+currentMunicipality+" newdata kommune : "+newData[i].kommune);
                    if(newData[i].antal === 0) {$(string).css("fill", "grey"); $(string).css("opacity", 1);}
                    else if(newData[i].antal<=q.q1) {$(string).css("fill", colors.min); $(string).css("opacity", 1);}
                    else if(newData[i].antal>=q.q1 && newData[i].antal<=q.q2) {$(string).css("fill", colors.q1); $(string).css("opacity", 1);}
                    else if(newData[i].antal>=q.q2 && newData[i].antal<=q.q3) {$(string).css("fill", colors.q2); $(string).css("opacity", 1);}
                    else if(newData[i].antal>=q.q3) {$(string).css("fill", colors.q3); $(string).css("opacity", 1);}
                }
                //Giver mindre farve til ikke valgte kommuner
                else{
                    if(newData[i].antal === 0) {$(string).css("fill", "grey"); $(string).css("opacity", 0.7);}
                    else if(newData[i].antal<=q.q1) {$(string).css("fill", colors.min); $(string).css("opacity", 0.7);}
                    else if(newData[i].antal>=q.q1 && newData[i].antal<=q.q2) {$(string).css("fill", colors.q1); $(string).css("opacity", 0.7);}
                    else if(newData[i].antal>=q.q2 && newData[i].antal<=q.q3) {$(string).css("fill", colors.q2); $(string).css("opacity", 0.7);}
                    else if(newData[i].antal>=q.q3) {$(string).css("fill", colors.q3); $(string).css("opacity", 0.7);}
                }
            }
        }
        //Zoomet ind på en region
        else if (currentRegion !== null && currentMunicipality === null){
            for (var i = 0; i < Object.keys(newData).length; i++) {
                if(newData[i].region == "UdenforDanmark") continue;
                var string = "#".concat(newData[i].kommune);
                //Giver forskellige farver baseret på værdi ifht. kvartil
                if(newData[i].region != currentRegion) {$(string).css("fill", "#F5F5DC"); $(string).css("opacity", 1);}
                else if(newData[i].antal === 0) {$(string).css("fill", "grey"); $(string).css("opacity", 1);}
                else if(newData[i].antal<=q.q1) {$(string).css("fill", colors.min); $(string).css("opacity", 1);}
                else if(newData[i].antal>=q.q1 && newData[i].antal<=q.q2) {$(string).css("fill", colors.q1); $(string).css("opacity", 1);}
                else if(newData[i].antal>=q.q2 && newData[i].antal<=q.q3) {$(string).css("fill", colors.q2); $(string).css("opacity", 1);}
                else if(newData[i].antal>=q.q3) {$(string).css("fill", colors.q3); $(string).css("opacity", 1);}
            }
        }
        else{
            console.log("I else statement. Her skal fuck farves");
            for (var i = 0; i < Object.keys(newData).length; i++) {
                if(newData[i].region == "UdenforDanmark") continue;
                var string = "#".concat(newData[i].kommune);
                //Giver forskellige farver baseret på værdi ifht. kvartil
                if(newData[i].antal === 0)
                    $(string).css("fill", colors.min);
                else if(newData[i].antal<=q.q1)
                    $(string).css("fill", colors.q1);
                else if(newData[i].antal>=q.q1 && newData[i].antal<=q.q2)
                    $(string).css("fill", colors.q2);
                else if(newData[i].antal>=q.q2 && newData[i].antal<=q.q3)
                    $(string).css("fill", colors.q3);
                else if(newData[i].antal>=q.q3)
                    $(string).css("fill", colors.max);
            }
        }
    }

    function colorAllMunicipalities(){

    }


    function calculateQuatil(newData) {
        var quar = new Array();
        var min, q1, q2, q3, max;
        if(currentRegion !== null || gennemsnit === true){
            // for (var i = 0; i < Object.keys(newData).length; i++)
            //     {if(newData[i].region === currentRegion) quar.push(newData[i].antal);}
            console.log(newData);
            for (var i = 0; i < Object.keys(newData).length; i++){
                quar.push(newData[i].antal);
            }
            console.log(quar);
            // quar = sortArray(quar);
            quar.sort(function(a, b){return a-b});

            console.log(quar);


            min = quar[0];
            q1 = quar[Math.floor((quar.length / 4))];
            q2 = Math.floor(quar.length/2);   //median(quar);
            q3 = quar[Math.ceil((quar.length * (3 / 4)))];
            max = quar[quar.length-1];

            console.log("Min: "+min+" q1: "+q1+" q2: "+q2+" q3: "+q3+" Max: "+max);
        }
        else if(regionEllerKommune  == "region"){
            Hovedstaden=0, Midtjylland=0, Nordjylland=0, Sjælland=0, Syddanmark=0, UdenforDanmark=0;
            for (var i = 0; i < Object.keys(newData).length; i++) {
                switch (newData[i].region){
                    case "Hovedstaden": Hovedstaden = Hovedstaden + newData[i].antal; break;
                    case "Midtjylland": Midtjylland = Midtjylland + newData[i].antal; break;
                    case "Nordjylland": Nordjylland = Nordjylland + newData[i].antal; break;
                    case "Sjælland": Sjælland = Sjælland + newData[i].antal; break;
                    case "Syddanmark": Syddanmark = Syddanmark + newData[i].antal; break;
                    case "UdenforDanmark": UdenforDanmark = UdenforDanmark + newData[i].antal; break;
                }
            }
            quar.push(["Hovedstaden",Hovedstaden]);
            quar.push(["Midtjylland",Midtjylland]);
            quar.push(["Nordjylland",Nordjylland]);
            quar.push(["Sjælland",Sjælland]);
            quar.push(["Syddanmark",Syddanmark]);

            quar = sortArray(quar);

            min = quar[0];
            q1 = quar[1];
            q2 = quar[2];
            q3 = quar[3];
            max = quar[4];
        }
        else{
            for (var i = 0; i < Object.keys(newData).length; i++){
                quar.push(newData[i].antal);
            }
            quar = sortArray(quar);

            min = quar[0];
            q1 = quar[Math.floor((quar.length / 4))];
            q2 = median(quar);
            q3 = quar[Math.ceil((quar.length * (3 / 4)))];
            max = quar[quar.length-1];
        }

        return {min, q1, q2, q3, max};
    };

    function sortArray(array){
        array.sort(function(a,b){
            return parseFloat(a[1]) - parseFloat(b[1]);
        });
        return array;
    }

    function median(values) {
        var half = Math.floor(values.length/2);
        if(values.length % 2) return values[half];
        else return (values[half-1] + values[half]) / 2.0;
    }


function drawMap(newData){
    d3.select("svg").remove();
    var svg = d3.select("#graphContent").append("svg").attr({"width":472,"height":574});
    
    d3.xml("kort.svg", function(error, documentFragment) {
        if (error) {console.log(error); return;}
    
        var svgNode = documentFragment.getElementsByTagName("svg")[0];
    
        svg.node().appendChild(svgNode);

        var a = document.getElementById("SVGmap");
        // console.log(a);
        var b = a.querySelectorAll("g:not(#masterGroup)");
        // console.log(b);
        var c = a.getElementsByTagName("polygon");
        // console.log(c);

        var masterGroup = d3.select("#masterGroup");
        d3.selectAll(b).style("stroke","brown").attr("stroke-width","0.2").on("click", function(){ clicked(this);});

        //Hvis ingen regioner er valgt
        if(currentRegion === null){
            d3.select("#masterGroup").attr('transform', function(d) {
              return 'translate(' + 0 + ',' + 0 + ')scale(' + 1 + ')';
              });
        }
        
        //Hvis der er en aktiv valgt region. Vil dette sørge for at denne vil være zommet ind på, hvis man forlader kortet
        if(currentRegion !== null){
            var string = ".".concat(currentRegion);
            var allChildNodes = d3.select("#masterGroup").selectAll(string)[0];

            //Udregner størrelsen af Border Box
            var x = d3.min(allChildNodes, function(d) {return d.getBBox().x;}),
                y = d3.min(allChildNodes, function(d) {return d.getBBox().y;}),
                width = d3.max(allChildNodes, function(d) {
                    var bb = d.getBBox();
                    return (bb.x + bb.width) - x;
                }),
                height = d3.max(allChildNodes, function(d) {
                    var bb = d.getBBox();
                    return (bb.y + bb.height) - y;
                });
        
            d3.select("#masterGroup").attr('transform', function (d){
                var testScale = Math.max(width, height);
                var widthScale = 472 / testScale;
                var heightScale = 584 / testScale;
                var scale = Math.max(widthScale, heightScale);
                transX = -(x) * scale;
                transY = -(y) * scale;
                return 'translate(' + transX + ',' + transY + ')scale(' + scale + ')';
            }).attr('stroke-width','0.2');
        }

        giveColors(newData);

    });
}

function updateFarvekode(q){
    var widthBox = 200;
    var heightBox = 120;
    d3.select("#svgFarve").remove();
    var svg = d3.select("#farvekode").append("svg").attr("id","svgFarve").attr("width", widthBox).attr("height", heightBox);
    // svg.append("rect").attr("x", 0).attr("y", 0).attr("width", widthBox/10).attr("height", 2016).style('fill', colors.min);
    // svg.append("p").text("Det her er min: "+q.min);
    // svg.append("rect").attr("x", 0).attr("y", 25).attr("width", widthBox/10).attr("height", 20).style('fill', colors.q1);
    // svg.append("rect").attr("x", 0).attr("y", 50).attr("width", widthBox/10).attr("height", 20).style('fill', colors.q2);
    // svg.append("rect").attr("x", 0).attr("y", 75).attr("width", widthBox/10).attr("height", 20).style('fill', colors.q3);
    // svg.append("rect").attr("x", 0).attr("y", 100).attr("width", widthBox/10).attr("height", 20).style('fill', colors.max);

    var bar = svg.selectAll("g")
    .data(q)
    .enter().append("g")
    //.attr("transform", function(d, i) { return "translate(0," + i * 20 + ")"; })
    .append("rect")
    .attr("width", 20)
    .attr("height", 20);

    // bar.append("text")
    //   .attr("x", function(d, i) { return i*20; })
    //   .attr("y", 0)
    //   .text(function(d) { return d; });

    // console.log("min: "+q.min);
    // console.log("q1: "+q.q1);
    // console.log("q2: "+q.q2);
    // console.log("q3: "+q.q3);
    // console.log("max: "+q.max);
}

function clicked(d) {
    var bbox = d3.select(d).node().getBBox();

    var rectAttr = {
        x: bbox.x,
        y: bbox.y,
        width: bbox.width,
        height: bbox.height,
      };
    var transX, transY;
    
    var reg = d.className.baseVal;
    var muni = d.id;

    if(currentRegion !== null && currentMunicipality === null || currentRegion !== null && currentMunicipality !== muni){
        d3.select("#masterGroup").transition().duration(1000).attr('transform', function(d) {
        var testScale = Math.max(rectAttr.width+10, rectAttr.height+10);
        var widthScale = 472 / testScale;
        var heightScale = 584 / testScale;
        var scale = Math.max(widthScale, heightScale);
        // console.log('scale',rectAttr)
        transX = -(rectAttr.x) * scale;
        transY = -(rectAttr.y) * scale;

        return 'translate(' + transX + ',' + transY + ')scale(' + scale + ')';
        }).attr('stroke-width', '0.2');
        currentMunicipality = muni;
        giveColors(newData);
        active = d;
    }
    else if(currentRegion === null){
        var string = ".".concat(reg);
        currentRegion = reg;

        var allChildNodes = d3.select("#masterGroup").selectAll(string)[0];

        //Udregner størrelsen af Border Box
        var x = d3.min(allChildNodes, function(d) {return d.getBBox().x;}),
            y = d3.min(allChildNodes, function(d) {return d.getBBox().y;}),
            width = d3.max(allChildNodes, function(d) {
                var bb = d.getBBox();
                return (bb.x + bb.width) - x;
            }),
            height = d3.max(allChildNodes, function(d) {
                var bb = d.getBBox();
                return (bb.y + bb.height) - y;
            });

            //Viser border box
            // d3.select("#masterGroup").append('rect')
            // .attr('x', x )
            // .attr('y', y)
            // .attr('width', width)
            // .attr('height', height)
            // .style('fill', '#000');
    
        d3.select("#masterGroup").transition().duration(1000).attr('transform', function (d){
            var testScale = Math.max(width, height);
            var widthScale = 472 / testScale;
            var heightScale = 584 / testScale;
            var scale = Math.max(widthScale, heightScale);
            // console.log('scale',rectAttr)
            transX = -(x) * scale;
            transY = -(y) * scale;

            return 'translate(' + transX + ',' + transY + ')scale(' + scale + ')';
        }).attr('stroke-width','0.2');
        giveColors(newData);
        regionEllerKommune = "kommune";
        active=d;
    }
    else {
        d3.select("#masterGroup").transition().duration(1000).attr('transform', function(d) {
        return 'translate(' + 0 + ',' + 0 + ')scale(' + 1 + ')';
        });
        regionEllerKommune = "region";
        active = null;
        currentMunicipality = null;
        currentRegion = null;
        giveColors(newData);
    }
    
}