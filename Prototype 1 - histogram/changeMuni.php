<?php
$json = $_GET["data"];
$list = json_decode($json, true);
echo '<div class="kommune-filter">';
foreach($list as $key => $value) {
	if($value == 1){
        echo '<div class="checkbox" id="kommunecheck">';
        echo '<label><input type="checkbox" checked="checked" id="'.$key.'" name="'.$key.'" value="'.$key.'">'.$key.'</label>';
        echo '</div>';

	}
	else{
		echo '<div class="checkbox">';
        echo '<label><input type="checkbox" id="'.$key.'" name="'.$key.'" value="'.$key.'">'.$key.'</label>';
        echo '</div>';
	}
}
echo '</div>';

?>
