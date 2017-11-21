<?php

namespace Models;

use Interfaces\RepositoryInterface;
use Core\PDBC;

class CRUDRepository implements RepositoryInterface
{
	protected $connection;
	public function __construct()
	{
		$this->connection = PDBC::getConnection();
	}
	public function add($item){}
	public function get(){}
	public function update($item, $newitem){}
	public function delete($item){}
}