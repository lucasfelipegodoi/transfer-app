<?php

namespace App\Repositories;

use App\Core\Repositories\Repository;
use App\Models\Log;

class LogRepository extends Repository {

	public function __construct(Log $log)
	{
		$this->model = $log;
	}
}
