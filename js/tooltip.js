var tip = d3.tip()
    .attr('class', 'd3-tip')
    .offset([-10, 0])
    .html(function(d) {
    return "Klik for mere info om " +  d.region + " <span style='color:red'></span>";
})