<?php

namespace App\Services\Interfaces;

interface BaseServiceInterface
{
    public function updateStatus($request);
    public function deleteMultiple($request);
    
}
