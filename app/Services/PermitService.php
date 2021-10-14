<?php

namespace App\Services;

use App\Repositories\PermitRepository;

class PermitService {
    
    public function __construct(PermitRepository $permitRepository) {
        $this->permitRepository = $permitRepository;
    }

    public function getPermits() {
        return $this->permitRepository->getAll();
    }

    public function getPermit($id) {
        return $this->permitRepository->getById($id);
    }

    public function createPermit($data) {
        return $this->permitRepository->create($data);
    }
    
}