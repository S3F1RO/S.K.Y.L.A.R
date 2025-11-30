<?php

	// Data to server
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, "https://www.google.fr/");										// Server URL
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);															// Get data instead of displaying
	curl_setopt($curl, CURLOPT_COOKIESESSION, false);															// Do not use cookies from previous sessions
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);														// Self-signed SSL for HTTPS : do not check the CA auth chain
	curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);														// Self-signed SSL for HTTPS : do not check if hostname/certname matches
	curl_setopt($curl, CURLOPT_POST, true);																				// Send POST data
	curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query(array('key1' => 'val1'))); // Data to send
	$distantData = curl_exec($curl);
	curl_close($curl);

	// Distant data
	if ($distantData) {

	}

?>
