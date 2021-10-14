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
        if ( (!empty($request) || !isset($request)) && (!empty($request["limit"]) && !empty($request["page"]))) {
            return $this->permit->paginate($request["limit"]);
        }

        return $this->permit->get();
    }

    public function getById($id)
    {
        return $this->permit->where('id', $id)->first();
    }

    public function create($data)
    {
        return $this->permit->create($data);
    }
}