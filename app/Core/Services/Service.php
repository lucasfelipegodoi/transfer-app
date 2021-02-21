<?php


namespace App\Core\Services;


interface Service
{
    public function persist(array $data);

    public function delete($id);
}
