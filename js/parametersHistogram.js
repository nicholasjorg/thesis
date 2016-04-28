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

function updateOnDisplay(){
    $("#onDisplay").text("Hello");
}