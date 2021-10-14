<?php

namespace App\Repositories;

use App\Permit;

class PermitRepository
{
    protected $permit;


    public function __construct(Permit $permit)
    {
        $this->permit = $permit;
    }

    public function getAll()
    {
        return $this->permit->get();
    }

    public function getById($id)
    {
        return $this->permit->find($id);
    }

    public function create($data)
    {
        return $this->permit->create($data);
    }
}