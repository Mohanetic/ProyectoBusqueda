<?php
	/*
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, 'https://www.falabella.com/falabella-cl/category/cat70043/');
	curl_setopt($ch, CURLOPT_HTTPHEADER, array("Accept-Language: es-es, en"));
	curl_setopt($ch, CURLOPT_TIMEOUT, 10);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

	//guardar la pagina
	$result = curl_exec($ch);
	$error  = curl_error($ch);
	curl_close($ch);

	//parsear - buscar elementos en la pagina
	preg_match_all("(<h4 class=\"fb-responsive-hdng-5 fb-pod__product-title\">(.*)</h4>)siU", $result, $matches1);

	$nombre_prod = $matches1[1][0];

	print_r($nombre_prod);

	*/

	$handler = curl_init("http://www.google.es");  
	curl_setopt($handler, CURLOPT_HTTPHEADER, array("Accept-Language: es-es, en"));
	$response = curl_exec ($handler);  
	curl_close($handler);  
	//echo $response;  

?>