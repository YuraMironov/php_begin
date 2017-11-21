<?php
	$params = split('/', HANDLER_PARAMS);
	for ($i = 0; $i < intval($params[1]); $i++) {
		echo 'Hello, ' . $params[0] . '!<br>';
	}