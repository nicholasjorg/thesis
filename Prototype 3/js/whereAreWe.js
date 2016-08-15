function whereAmI(){

	var dropRegion = '<div class="dropdown linkspacer"><button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"><span class="caret"></span></button><ul class="dropdown-menu" id="hvilkeRegioner"></ul></div>';
	var dropKommune = '<div class="dropdown linkspacer"><button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"><span class="caret"></span></button><ul class="dropdown-menu" id="hvilkeKommuner"></ul></div>';

	//Der er valgt en kommune
	if(currentMunicipality !== null){
		$("#whereAmI")
		.empty()
		.append("<div class='tilbageTilDanmark'>Danmark </div>")
		//.append("<select class='form-control linkspacer' id='hvilkeRegioner'></select>")
		.append(dropRegion)
		.append("<div class='tilbageTilRegion'> "+currentRegion+" </div>")
		// .append("<select class='form-control linkspacer' id='hvilkeKommuner'></select>")
		.append(dropKommune)
		.append("<div class='tilbageTilKommune'> "+currentMunicipality+" </div>");
	}
	//Der er valgt en region
	else if(currentRegion !== null){
		$("#whereAmI")
		.empty()
		.append("<div class='tilbageTilDanmark'>Danmark </div>")
		//.append("<select class='form-control linkspacer' id='hvilkeRegioner'></select>")
		.append(dropRegion)
		.append("<div class='tilbageTilRegion'> "+currentRegion+" </div>");
	}
	// onClick='eLevelBack '"'region'"');
	//Intet er valgt. Landsdækkede
	else{
		$("#whereAmI")
		.empty()
		.append("<div class='tilbageTilDanmark'>Danmark</div>");
	}

	//De enkelte tilbage links skrevet som tekst
	$(".tilbageTilDanmark").click(function() {changeDanmark();});
	$(".tilbageTilRegion").click(function() {changeRegion(currentRegion);});


//Fylder arrays ud med de regioner eller kommuner i en valgt region som ikke er den nuværende 
var ikkeValgteRegioner = [];
var ikkeValgteKommuner = [];

for (var i = 0; i < Object.keys(newData).length; i++) {
	if(newData[i].region !== currentRegion){
		if(ikkeValgteRegioner.indexOf(newData[i].region) === -1)
			ikkeValgteRegioner.push(newData[i].region);
	}
	if(newData[i].region === currentRegion && newData[i].kommune !== currentMunicipality){
		if(ikkeValgteKommuner.indexOf(newData[i].kommune) === -1)
			ikkeValgteKommuner.push(newData[i].kommune);
	}
}

//Tilføjer regioner og kommuner til dropdown menu
$.each(ikkeValgteKommuner, function(index, value) {
    if(currentMenu === "kort") $("#hvilkeKommuner").append("<li onClick='changeMunicipality("+value+")'>"+value+"</li>");
    else if (currentMenu === "histogram") $("#hvilkeKommuner").append("<li onClick='changeMunicipality(this.id)' id='"+value+"'>"+value+"</li>");
});

$.each(ikkeValgteRegioner, function(index, value) {
    $("#hvilkeRegioner").append("<li onClick='changeRegion(this.id)' id='"+value+"'>"+value+"</li>");
});

}

//Funktioner til at modtage input fra dropdown menu
function changeDanmark(){
	currentRegion = null;
	currentMunicipality = null;
	drawDiagram(newData);
}

function changeRegion(newRegion){
	currentRegion = newRegion;
	currentMunicipality = null;
	drawDiagram(newData);
}

function changeMunicipality(newMunicipality){
	if(currentMenu === "kort") currentMunicipality = newMunicipality.id;
    else if (currentMenu === "histogram") currentMunicipality = newMunicipality;
	drawDiagram(newData);

}
