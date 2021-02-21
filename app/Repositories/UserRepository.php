<?php

namespace App\Repositories;

use App\Core\Repositories\Repository;
use App\Models\User;

class UserRepository extends Repository {

	public function __construct(User $user)
	{
		$this->model = $user;
	}
}
