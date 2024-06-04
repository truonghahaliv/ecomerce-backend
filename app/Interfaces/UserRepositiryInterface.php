<?php

namespace App\Interfaces;

use App\Models\User;

interface UserRepositiryInterface
{
    //

    public function store(array $data);

    public function all();

    public function find($id);

    public function update($id, array $data);

    public function delete($id);

    public function assignRole($user, $roleName);
}
