function showInfo(data){
//Fjerner gammel graf
d3.select("#graph").remove();

var typeData = [{Type:"Foto", antal:0},{Type:"Skulptur", antal:0},{Type:"Maleri", antal:0}, {Type:"Tegning", antal:0},
{Type:"Grafik", antal:0}, {Type:"Smykker", antal:0}, {Type:"Andet", antal:0}, {Type:"Design", antal:0}, {Type:"Relief", antal:0},
{Type:"Akvarel", antal:0},{Type:"Tekstil", antal:0}, {Type:"Keramik", antal:0}, {Type:"Collage", antal:0}, {Type:"Glas", antal:0},
{Type:"Møbel", antal:0}, {Type:"Digital", antal:0}, {Type:"Video", antal:0}, {Type:"Integreret kunst", antal:0},
{Type:"Indretning", antal:0}, {Type:"Print", antal:0}, {Type:"Mixed Media", antal:0}, {Type:"Grafisk design", antal:0},
{Type:"Performance", antal:0}, {Type:"Installation", antal:0}, {Type:"Lys", antal:0}];

var total = 0;
for (var i = 0; i < Object.keys(data).length; i++) {
	if(currentMunicipality !== null && currentMunicipality === data[i].kommune){
		for (var j = 0; j < Object.keys(data[i].typer).length; j++) {
			for (var h = 0; h < Object.keys(typeData).length; h++) {
				if(data[i].typer[j].classification == typeData[h].Type)
					{typeData[h].antal = data[i].typer[j].antal; total+=data[i].typer[j].antal; break;}
			}
		}
		break;
	}
	else if(currentRegion !== null && currentMunicipality === null && currentRegion === data[i].region){
		console.log("currentRegion !== null && currentMunicipality === null && currentRegion === data[i].region");
		console.log(data[i].region);
		for (var g = 0; g < Object.keys(data[i].typer).length; g++) {
			for (var h = 0; h < Object.keys(typeData).length; h++) {
				if(data[i].typer[g].classification == typeData[h].Type){
					typeData[h].antal = parseFloat(typeData[h].antal) + parseFloat(data[i].typer[g].antal); 
					total += parseFloat(data[i].typer[g].antal);
				}
			}
		}
	}
	else{
		for (var g = 0; g < Object.keys(data[i].typer).length; g++) {
			for (var h = 0; h < Object.keys(typeData).length; h++) {
				if(data[i].typer[g].classification == typeData[h].Type){
					typeData[h].antal = parseFloat(typeData[h].antal) + parseFloat(data[i].typer[g].antal); 
					total += parseFloat(data[i].typer[g].antal);
				}						
			}
		}
	}
}

typeData.sort(function(a, b) {
	return parseFloat(b.antal) - parseFloat(a.antal);
});

correntLeftInfo(total);

// create table
var table = d3.select("#graphWrapper").append("table").attr('id','graph').attr('class','table table-hover table-striped table-condensed'), thead = table.append("thead"), tbody = table.append("tbody");



// create the table header
thead = d3.select("thead").selectAll("th")
.data(d3.keys(typeData[0]))
.enter().append("th").text(function(d){return d;});
// fill the table
// create rows
var tr = d3.select("tbody").selectAll("tr")
.data(typeData).enter().append("tr");
// cells
var td = tr.selectAll("td")
.data(function(d){return d3.values(d);})
.enter().append("td")
.text(function(d) {return d;});



}
