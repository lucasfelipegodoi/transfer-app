<?php

namespace App\Repositories;

use App\Core\Repositories\Repository;
use App\Models\Transactions;

class TransactionsRepository extends Repository {

	public function __construct(Transactions $model)
	{
		$this->model = $model;
	}
}
