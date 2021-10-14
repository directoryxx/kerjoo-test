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
    
}