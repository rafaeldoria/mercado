<?php
function dataConvert($data){
	$partes = explode("/", $data);
	return "{$partes[2]}-{$partes[1]}-{$partes[0]}";
}

function databr ($dataMysql){
	var_dump($data = new Datetime($dataMysql));
	return $data->format('d/m/Y');
}