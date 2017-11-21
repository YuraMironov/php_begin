<?php

namespace Interfaces;

use Symfony\Component\HttpFoundation\Request;
use Pimple\Container;

interface HandlerInterface
{
	public function __construct(Request $request);
	public function getRequest();
	public function setRequest(Request $request);
	public function handleRequest(Container $container);
}