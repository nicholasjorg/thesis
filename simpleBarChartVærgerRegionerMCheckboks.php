<?php require("functions.php"); ?>
<?php require("generateHistogram.php");?>

<HTML>
<head>
<script type="text/javascript" src="d3/d3.js"></script>
<link rel="stylesheet" type="text/css" href="stylesheet.css">
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<!-- Latest compiled JavaScript -->
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</head>
<body>
<div class = "container">
    <div class = "row" id = "contentRow">
        <div class = "col-sm-4">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#home">Filter</a></li>
                <li><a href="#menu1">Zoom</a></li>
                <li><a href="#menu2">Compare</a></li>
                <li><a href="#menu3">Parameters</a></li>
                <li><a href="#menu4"></a></li>
            </ul>
            <div class="tab-content">
              <div id="home" class="tab-pane fade in active">
                <h3>Vælg regioner</h3>
                <div class="col-sm-4 form-filters">
                    <div class="checkbox checked">
                      <label><input type="checkbox" checked="checked" id="Hovedstaden" name="Hovedstaden" value="Hovedstaden">Hovedstaden</label>
                    </div>
                    <div class="checkbox">
                      <label><input type="checkbox"  checked="checked" id="Midtjylland" name="Midtjylland" value="Midtjylland">Midtjylland</label>
                    </div>
                    <div class="checkbox">
                      <label><input type="checkbox" checked="checked" id="Nordjylland" name="Nordjylland" value="Nordjylland">Nordjylland</label>
                    </div>
                    <div class="checkbox">
                      <label><input type="checkbox"  checked="checked" id="Sjælland" name="Sjælland" value="Sjælland">Sjælland</label>
                    </div>
                    <div class="checkbox">
                      <label><input type="checkbox" checked="checked" id="Syddanmark" name="Syddanmark" value="Syddanmark">Syddanmark</label>
                    </div>
                    <div class="checkbox">
                      <label><input type="checkbox" checked="checked" id="Udenfor Danmark" name="Udenfor Danmark" value="Udenfor Danmark">Udenfor Danmark</label>
                    </div>
                </div>
              </div>
              <div id="menu1" class="tab-pane fade">
                <h3>Single year</h3>
                <div class="dropdown">
                  <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Dropdown Example
                  <span class="caret"></span></button>
                  <ul class="dropdown-menu" id ="scroll-menu">
                    <?php
                    $result = getDisplayDateYears();
                    while ($row = mysqli_fetch_array($result)) {
                        echo '<li><a href="#">'.$row["displayDate"].'</a></li>';
                    }
                    ?>
                  </ul>
                </div>
              </div>
              <div id="menu2" class="tab-pane fade">
                <h3>Compare</h3>
                <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
              </div>
              <div id="menu3" class="tab-pane fade">
                <h3>Menu 3</h3>
                <p>Eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
              </div>
            </div>
        </div>
    </div>
</div>
    <?php
    $jsonarray = array();
    //Bygger SQL statement
    $var1 = "region";
    $var2 = "count(*)";
    $sql = 'SELECT '.$var1.', '.$var2.' FROM allData group by region';
    $result = queryDB($sql);

    while ($row = mysqli_fetch_array($result)) {
        //Indsæt de forskellige variable, ændre count(*), da det ellers fucker op i JS
        $tmparr = array($var1=>$row[$var1], antal=>$row[$var2]);
        array_push($jsonarray,$tmparr);
        }
    $jsonobj = json_encode($jsonarray);
    return $jsonobj;
    ?>
    <script>
		var jsonarr = <?php echo $jsonobj; ?>;
		var jsonarrlength = Object.keys(jsonarr).length;
		//Kloner jsonarr til filterJsonArr
		var filterJsonArr = JSON.parse(JSON.stringify(jsonarr));

		//Kører hver gang der ændres på en checkboks
		$('.form-filters input:checkbox').click(function() {
			var name = $(this).val().trim();
			var i = 0;
			var addIndex;
			//Looper igennem filterJsonArr. Tjekker om elementer eksisterer. Hvis ikke tilføjes det, ellers fjernes det.
			for(var i; i < jsonarrlength; i++){
				var exists = false;
				if(filterJsonArr[i].region == name){exists=true;  break;}
				if(jsonarr[i].region == name) {addIndex = i; break;}
			}

	 		if(exists == false){
				filterJsonArr[addIndex].region = jsonarr[addIndex].region;
                fadeOut().done(update);
	 		}
	 		else{
	 			filterJsonArr[i].region = null;
	 			fadeOut().done(update);
            }
		});
    </script>

    <script src = "js/effects.js"></script>
    <script src = "js/updateHistogram.js"></script>
    <script src = "js/tabMenu.js"></script>

</body>
</head>


