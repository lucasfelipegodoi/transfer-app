<?php

namespace App\Repositories;

use App\Core\Repositories\Repository;
use App\Models\Wallet;

class WalletRepository extends Repository {

	public function __construct(Wallet $model)
	{
		$this->model = $model;
	}
}
