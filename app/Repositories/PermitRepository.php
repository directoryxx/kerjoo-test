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

    public function getAll($request)
    {
        if (!empty($request) || $request["limit"] != "" || $request["limit"] != 0) {
            return $this->permit->paginate($request["limit"]);
        }

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