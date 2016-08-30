    function giveColors(newData){
        var q = calculateQuatil(newData);
        whereAmI();
        if(median === true){
            yellowIs = q.q2;
            for (var i = 0; i < Object.keys(newData).length; i++) {
                if(newData[i].region == "UdenforDanmark") continue;
                var string = "#".concat(newData[i].kommune);
                //Giver forskellige farver baseret på værdi ifht. kvartil
                if(newData[i].antal < q.q2) {$(string).css("fill", "red").css("stroke-width", 0.2);}
                else if(newData[i].antal == q.q2) {$(string).css("fill", "yellow").css("stroke-width", 0.2);}
                else if(newData[i].antal > q.q2) {$(string).css("fill", "green").css("stroke-width", 0.2);}
            }
            $("#gennemsnitsInfo").empty().append("<h3>Median: "+q.q2+"</h3>");
        }
        else if(gennemsnit === true){
            var avg = calculateAverage(newData);
            yellowIs = avg;
             for (var i = 0; i < Object.keys(newData).length; i++) {
                if(newData[i].region == "UdenforDanmark") continue;
                var string = "#".concat(newData[i].kommune);
                //Giver forskellige farver baseret på værdi ifht. kvartil
                if(newData[i].antal < avg) {$(string).css("fill", "red").css("stroke-width", 0.2);}
                else if(newData[i].antal == avg) {$(string).css("fill", "yellow").css("stroke-width", 0.2);}
                else if(newData[i].antal > avg) {$(string).css("fill", "green").css("stroke-width", 0.2);}
            }
            $("#gennemsnitsInfo").empty().append("<h3>Gennemsnit: "+avg+"</h3>");
        }

        //Fuldt overblik. Ser hele kortet
        else if(currentRegion === null && kunKommune === false){
             for(var key in q){
                var string = ".".concat(q[key][0]);
                if(key == "min"){$(string).css("fill", colors.min).css("stroke-width", 0.2);}
                else if(key == "q1"){$(string).css("fill", colors.q1).css("stroke-width", 0.2);}
                else if(key == "q2"){$(string).css("fill", colors.q2).css("stroke-width", 0.2);}
                else if(key == "q3"){$(string).css("fill", colors.q3).css("stroke-width", 0.2);}
                else if(key == "max"){$(string).css("fill", colors.max).css("stroke-width", "black");}
            }
        }
        //Zoomet ind på enkelt kommune
        else if(currentMunicipality !== null){
            // console.log("Skal farver en enkelt kommune som er: "+currentMunicipality);
            for (var i = 0; i < Object.keys(newData).length; i++) {
            var string = "#".concat(newData[i].kommune);
                //Giver fuld farve til valgt kommune
                if(newData[i].kommune === currentMunicipality){
                    // console.log("rigtig kommune fundet. Skulle kun ske EN gang!");
                    // console.log("Rigtig kommune valgt. Fuld farve: "+currentMunicipality+" newdata kommune : "+newData[i].kommune);
                    if(newData[i].antal === 0) {$(string).css("fill", "grey").css("stroke-width", 0.7);}
                    else if(newData[i].antal<=q.q1) {$(string).css("fill", colors.min).css("stroke-width", 0.7);}
                    else if(newData[i].antal>=q.q1 && newData[i].antal<=q.q2) {$(string).css("fill", colors.q1).css("stroke-width", 0.7);}
                    else if(newData[i].antal>=q.q2 && newData[i].antal<=q.q3) {$(string).css("fill", colors.q2).css("stroke-width", 0.7);}
                    else if(newData[i].antal>=q.q3 && newData[i].antal<=q.beforeMax) {$(string).css("fill", colors.q3).css("stroke-width", 0.7);}
                    else if(newData[i].antal==q.max) {$(string).css("fill", colors.max).css("stroke-width", 0.7);}
                    //else if(newData[i].antal==q.max) {$(string).css("fill", colors.max); $(string).css("stroke-width", 0.2);}
                }
                //Giver mindre farve til ikke valgte kommuner
                else{
                    if(newData[i].antal === 0) {$(string).css("fill", "grey").css("stroke-width", 0.2);}
                    else if(newData[i].antal<=q.q1) {$(string).css("fill", colors.min).css("stroke-width", 0.2);}
                    else if(newData[i].antal>=q.q1 && newData[i].antal<q.q2) {$(string).css("fill", colors.q1).css("stroke-width", 0.2);}
                    else if(newData[i].antal>=q.q2 && newData[i].antal<q.q3) {$(string).css("fill", colors.q2).css("stroke-width", 0.2);}
                    else if(newData[i].antal>=q.q3 && newData[i].antal<=q.beforeMax) {$(string).css("fill", colors.q3).css("stroke-width", 0.2);}
                    else if(newData[i].antal==q.max) {$(string).css("fill", colors.max).css("stroke-width", 0.2);}
                }
            }
        }
        //Zoomet ind på en region
        else if (currentRegion !== null && currentMunicipality === null){
            // console.log("Kun region bør være farver");
            for (var i = 0; i < Object.keys(newData).length; i++) {
                if(newData[i].region == "UdenforDanmark") continue;
                var string = "#".concat(newData[i].kommune);
                //Giver forskellige farver baseret på værdi ifht. kvartil
                if(newData[i].region !== currentRegion) {$(string).css("fill", "#F5F5DC").css("stroke-width", 0.2);}
                else if(newData[i].antal === 0) {$(string).css("fill", "grey").css("stroke-width", 0.2);}
                else if(newData[i].antal<=q.q1) {$(string).css("fill", colors.min).css("stroke-width", 0.2);}
                else if(newData[i].antal>=q.q1 && newData[i].antal<=q.q2) {$(string).css("fill", colors.q1).css("stroke-width", 0.2);}
                else if(newData[i].antal>=q.q2 && newData[i].antal<=q.q3) {$(string).css("fill", colors.q2).css("stroke-width", 0.2);}
                else if(newData[i].antal>=q.q3 && newData[i].antal<=q.beforeMax) {$(string).css("fill", colors.q3).css("stroke-width", 0.2);}
                else if(newData[i].antal==q.max) {$(string).css("fill", colors.max).css("stroke-width", 0.2);}
            }
        }
        //Her  farves alle kommuner
        else{
            // console.log("Sidste give color. Alt farves!");
            for (var i = 0; i < Object.keys(newData).length; i++) {
                if(newData[i].region == "UdenforDanmark") continue;
                var string = "#".concat(newData[i].kommune);
                //Giver forskellige farver baseret på værdi ifht. kvartil
                if(newData[i].antal === 0) {$(string).css("fill", "grey").css("stroke-width", 0.2);}
                else if(newData[i].antal<=q.q1) {$(string).css("fill", colors.min).css("stroke-width", 0.2);}
                else if(newData[i].antal>=q.q1 && newData[i].antal<=q.q2) {$(string).css("fill", colors.q1).css("stroke-width", 0.2);}
                else if(newData[i].antal>=q.q2 && newData[i].antal<=q.q3) {$(string).css("fill", colors.q2).css("stroke-width", 0.2);}
                else if(newData[i].antal>=q.q3 && newData[i].antal<=q.beforeMax) {$(string).css("fill", colors.q3).css("stroke-width", 0.2);}
                else if(newData[i].antal==q.max) {$(string).css("fill", colors.max).css("stroke-width", 0.2);}
            }
        }
        //Opdaterer farvekoderne fra leftmenu.js
        updateFarvekode(q);
    }

    function calculateQuatil(newData) {
        var quar = new Array();
        var min, q1, q2, q3, beforeMax, max;
        if(currentRegion !== null || median === true || kunKommune === true){
            for (var i = 0; i < Object.keys(newData).length; i++){
                quar.push(newData[i].antal);
            }
            // console.log(quar);
            // quar = sortArray(quar);
            quar.sort(function(a, b){return a-b;});

            min = quar[0];
            q1 = quar[Math.floor((quar.length / 4))];
            q2 = quar[Math.floor(quar.length/2)];   //median(quar);
            q3 = quar[Math.ceil((quar.length * (3 / 4)))];
            beforeMax = quar[quar.length-2];
            max = quar[quar.length-1];
        }
        else if(currentRegion === null && currentMunicipality === null) {
            var Hovedstaden=0, Midtjylland=0, Nordjylland=0, Sjælland=0, Syddanmark=0, UdenforDanmark=0;
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
            beforeMax = quar[3];
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
            beforeMax = quar[quar.length-2];
            max = quar[quar.length-1];
        }

        return {min, q1, q2, q3, beforeMax, max};
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
    var svg = d3.select("#graphContent").append("svg").attr({"width":472,"height":574}).attr("id", "graph");
    
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
        d3.selectAll(b)
        .style("stroke","brown").attr("stroke-width","0.2")
        .on("click", function(){ clicked(this);});

        //Hvis ingen regioner er valgt
        if(currentRegion === null){
            d3.select("#masterGroup").attr('transform', function(d) {
              return 'translate(' + 0 + ',' + 0 + ')scale(' + 1 + ')';
              });
        }

        //Hvis en kommmune er valgt vil der blive zoomet ind på denne når kortet tegnes.
        if(currentMunicipality !== null){
           var string = "#".concat(currentMunicipality);
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
        
            d3.select("#masterGroup").transition().duration(1000).attr('transform', function (d){
                var testScale = Math.max(width, height);
                var widthScale = 472 / testScale;
                var heightScale = 584 / testScale;
                var scale = Math.max(widthScale, heightScale);
                transX = -(x) * scale;
                transY = -(y) * scale;
                return 'translate(' + transX + ',' + transY + ')scale(' + scale + ')';
            }).attr('stroke-width','0.2');
        }
        //Hvis der er en aktiv valgt region. Vil dette sørge for at denne vil være zommet ind på, hvis man forlader kortet
        else if(currentRegion !== null){
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
        
            d3.select("#masterGroup").transition().duration(1000).attr('transform', function (d){
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

function clicked(d) {
    var bbox = d3.select(d).node().getBBox();

    var rectAttr = {
        x: bbox.x,
        y: bbox.y,
        width: bbox.width,
        height: bbox.height,
      };
    var transX, transY;
    
    //Class(Region) på d
    var reg = d.className.baseVal;
    //Id (Municipality) på d
    var muni = d.id;

    if(currentRegion !== null && currentMunicipality === null ||
        currentRegion !== null && currentMunicipality !== muni || kunKommune === true && active !== d){
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
        currentRegion = reg;
        active = d;
    }
    else if(currentRegion === null && kunKommune !== true){
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
    whereAmI();
}

function calculateAverage(data){
    var sum = 0;
    for (var i = 0; i < Object.keys(data).length; i++) {
        sum += newData[i].antal;
    };
    return sum / Object.keys(data).length;
}