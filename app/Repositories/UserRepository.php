<?php

namespace App\Repositories;

use App\Interfaces\UserRepositiryInterface;
use App\Models\User;
use PhpParser\Node\Expr\Array_;

class UserRepository implements UserRepositiryInterface
{
    protected User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function paginate($perPage = 10)
    {
        return $this->user->select('id', 'name', 'email')->orderBy('id', 'desc')->paginate($perPage);
    }

    public function find($id)
    {
        return $this->user->find($id);
    }

    public function all()
    {
        return $this->user->select('id', 'name', 'email')->orderBy('id', 'desc')->get();
    }

    public function store(array $data)
    {
        return $this->user->create($data);
    }

    public function update($id, array $data)
    {
        $user = User::find($id);
        $user->update($data);
        return $user;
    }

    public function delete($id)
    {
        $user = User::find($id);
        $user->delete();
        return $user;
    }

    public function assignRole($user, $roleName)
    {
        $user->assignRole($roleName);
    }
}
