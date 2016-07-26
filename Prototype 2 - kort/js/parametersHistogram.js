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

//Single region DOD
function updateSingleRegion(region){
    var outputString = region.value;
    $("#aktiveRegion").text(outputString);
    $("#overskrift").text(outputString);
}

function updateVærktyper(værktyper){
    var count = 0;
    var outputString = "";
        for (var key in værktyper) {
            if(værktyper[key]==true){
                var stringKey = String(key);
                outputString = outputString + stringKey + " ";
                count++;
            }
        }
        if(count == 25){
           $("#aktiveTyper").text("Alle værktyper");
        }
        else{
            $("#aktiveTyper").text(outputString);

        }
}
/*function updateVærktyper(strCheckbox,boolKategori){
    if(boolKategori == true){
        if ($('#'+strCheckbox).prop('checked')){

        }
        else{

        }
    }
    else if(boolKategori == false){

    }
}*/

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
