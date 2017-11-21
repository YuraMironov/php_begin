<?php 

require 'MyErrors.php';

function myErrorHandler($errno, $errstr, $errfile, $errline)
{	
	trigger_error('Work is my error handler');
	print 'Error in file: ' . $errfile . "   on line: " . $errline;
	switch ($errno) {
		case E_WARNING:
			throw new MyWarningException("MyWarningException is worked", $errno);
			break;

		case E_PARSE:
			throw new MyParseException("MyParseException is worked", $errno);
			break;

		case E_NOTICE:
			throw new MyNoticeException("MyNoticeException is worked", $errno);
			break;

		case E_ERROR:
			throw new MyErrorException("MyErrorException is worked", $errno);
			break;

		case E_STRICT:
			throw new MyStrictException("MyStrictException is worked", $errno);
			break;

		case E_DEPRECATED:
			throw new MyDeprecatedException("MyDeprecatedException is worked", $errno);
			break;

		default:
			throw new MyDefaultException("MyDefaultException is worked", $errno);
			break;
	}
}
$oldErrorHandler = set_error_handler('myErrorHandler');
// class_exists(dhdjhd);
$a = 1 / 0;