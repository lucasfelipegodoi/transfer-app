<?php

namespace Database\Seeders;

use App\Models\UsersType;
use App\Services\UserService;
use Illuminate\Database\Seeder;

class CreateUsers extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => "Comum 1", 
                'email' => "comum1@mail.com", 
                'password' => "12345",
                'document' => "82037614020",
                'users_type_id' => UsersType::ID_TYPE_COMUM
            ],
            [
                'name' => "Comum 2", 
                'email' => "comum2@mail.com", 
                'password' => "12345",
                'document' => "29668979028",
                'users_type_id' => UsersType::ID_TYPE_COMUM
            ],
            [
                'name' => "Lojista 1", 
                'email' => "lojista1@mail.com", 
                'password' => "12345",
                'document' => "32953644000190",
                'users_type_id' => UsersType::ID_TYPE_LOJISTA
            ],
        ];


        $userService = app(UserService::class);
        foreach($data as $u){
            $userService->save($u);
        }
    }
}
