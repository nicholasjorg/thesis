 function updateDashboardRegion (currentRegion){
    var identifier = "#"+currentRegion;
    console.log(identifier);
    $(identifier).attr('checked', 'checked')
 }