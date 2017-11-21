<?php
	echo 'Hello, '. $_SESSION['user']->getUsername() . '<br>';
	echo "<a href='/logout'>logout</a>";
