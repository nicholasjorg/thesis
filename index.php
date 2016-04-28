<?php require("functions.php");?>

<HTML>
<head>
<script type="text/javascript" src="d3/d3.js"></script>
<link rel="stylesheet" type="text/css" href="stylesheet.css">
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
</head>
<body>

<a href="cleanDisplayDate.php">Clean display date</a></br>
<br/>
<a href="simpleBarChartVærgerRegionerMCheckboks.php">Simple bar chart værker regioner: Med checkbox</a>


<script type="text/javascript">
drawPie();
function drawPie(){
        var testData = [5, 10, 23, 42, 3, 4, 4, 20, 32, 10, 12, 21, 1, 3,4,5,6];
        var color = d3.scale.category20();
        var pie = d3.layout.pie();
        var w = 300;
        var h = 400;
        var outerRadius = w/2;
        var innerRadius = 0;
        var arc = d3.svg.arc().innerRadius(innerRadius).outerRadius(outerRadius);
        var svg = d3.select("body").append("svg").attr("width",w).attr("height",h);
        var arcs = svg.selectAll("g.arc").data(pie(testData)).enter().append("g").attr("class", "arc").attr("transform", "translate("+outerRadius+", "+outerRadius+")");
        arcs.append("path").attr("fill", function(d,i){return color(i);}).attr("d",arc); 

        console.log(pie(testData));
       
    }
</script>
    



</body>
</HTML>