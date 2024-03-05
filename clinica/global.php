<?php

function bases(){
	$link = mysqli_connect("localhost", "tecolot1_mainclinica", "Ex)!Uy{j=CcN");
	mysqli_select_db($link, "tecolot1_mainclinica");
	$link->set_charset("utf8");
	return $link;
}

?>