var tip = d3.tip()
  .attr('class', 'd3-tip')
  .offset([-10, 0])
  .html(function(d) {
    drawPie(d.typer);
    var url = "info omkring classifications valgt, year, startYear, endYear, onView og hvilken region";
    return "Klik for mere info om " +  d.region + " <span style='color:red' id='pie-test'></span>";
});