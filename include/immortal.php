<?php

function RenderIC($arg1)
{
	$birthdate = substr($arg1, 0, 6);
	$area = substr($arg1, 6, 2);
	$ic_id = substr($arg1, 8, 4);
	$lol = $birthdate."-".$area."-".$ic_id;
	return $lol;
}
?>