function updateRegioner(regioner){
var outputString = "";

    for (var key in regioner) {
        if(regions[key]==true) {
            var stringKey = String(key);
            outputString = outputString + stringKey + " ";
        }
    }
    console.log(outputString);
    $("#aktiveRegioner").text(outputString);
}
function updateVærktyper(værktyper){
    var outputString = "";
        for (var key in værktyper) {
            if(værktyper[key]==true) {
                var stringKey = String(key);
                outputString = outputString + stringKey + " ";
            }
        }
        $("#aktiveTyper").text(outputString);
}

function updateOnView(){
    if(onView == true)
        $("#onView").text("True");
    else if(onView == false)
        $("#onView").text("False");
    else
        $("#onView").text("Begge");
}

function updateActiveYears(){
    if(year != null)
        $("#aktiveÅr").text(year)
    else if(startYear != null && endYear !=null){
        var outputString = startYear + " - " + endYear;
        $("#aktiveÅr").text(outputString);
    }
    else
        $("#aktiveÅr").text("1918 - 2016");
}
