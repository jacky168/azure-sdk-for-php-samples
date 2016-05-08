<?php


function generateDropDownList($list) {
	echo $list;
	if(!empty($list)) 
	{
		foreach($list as $item) {
			echo $item[0] . " " . $item[1];
		}
	}

}
?>