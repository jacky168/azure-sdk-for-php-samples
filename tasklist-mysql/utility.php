<?php


function generateDropDownList($list) {
	echo "<select>";
	if(!empty($list)) 
	{
		foreach($list as $item) {
			echo "<option value=\"" . $item[0] . "\">" . $item[1] . "</option>";
		}
	}
	echo "</select>";
}
?>