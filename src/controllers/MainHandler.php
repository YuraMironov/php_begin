<?php

namespace Controllers;

use Interfaces\HandlerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Utils\Utils;
use Pimple\Container;

class MainHandler implements HandlerInterface
{
	private $request;

	public function __construct(Request $request){
		$this->setRequest($request);
	}

	public function handleRequest(Container $container)
	{

		$handler_name =  explode('/', $this->getRequest()->getRequestUri())[1];

		if (strrpos($handler_name, '?')) {
			$handler_name = explode('?', $handler_name)[0];
		}

		define('HANDLER_NAME', $handler_name);
		define('HANDLER_SIMPLE_CLASS_NAME', strtoupper(HANDLER_NAME[0]) . substr(HANDLER_NAME, 1) . 'Controller');
		define('HANDLER_FULL_CLASS_NAME', 'Controllers\\' . HANDLER_SIMPLE_CLASS_NAME);
		define('HANDLER_PARAMS', substr($this->getRequest()->getRequestUri(), strlen(HANDLER_NAME) + 2));
		
		if (class_exists(HANDLER_FULL_CLASS_NAME)) {
			$handler = $container[HANDLER_SIMPLE_CLASS_NAME];
			if ($this->getRequest()->isMethod('GET')) {
				$paramsForTwig = $handler->doGet(HANDLER_PARAMS);

				// Utils::viewLoaderByHandlerName();
				
				Utils::twigViewLoaderByHandlerName($container, $paramsForTwig);
			} else {
				$handler->doPost($this->getRequest()->request->all());
			}
		} else {
			Utils::redirect("/err404");
		}
		
	}

	public function getRequest()
	{
		return $this->request;
	}

	public function setRequest(Request $request)
	{
		$this->request = $request;
	}

}