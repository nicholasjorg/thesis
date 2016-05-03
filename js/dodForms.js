function updateDashboardRegion (currentRegion){
    if (currentRegion == undefined){
        return;
    }
    else {
        var identifier = "#"+currentRegion;
        $(identifier).attr('checked', 'checked')
    }
}

function updateDashboardOnDisplay (onDisplay){
    console.log("onDisplay = " + onDisplay)

    if (onDisplay == undefined){
        return;
    }
    else if (onDisplay == null){
        $("#onDisplayNull").attr('checked', 'checked');
    }

    else if (onDisplay == true) {
        $("#onDisplayTrue").attr('checked', 'checked');
    }
    else {
        $("#onDisplayFalse").attr('checked', 'checked');
    }
}