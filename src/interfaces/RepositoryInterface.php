<?php

namespace Interfaces;

interface RepositoryInterface
{

	public function add($item);
	public function get();
	public function update($item, $newitem);
	public function delete($item);
}	