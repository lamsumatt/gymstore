<?php

namespace App\Repositories\Interfaces;

/**
 * Interface UserServiceInterface
 * @package App\Repositories\Interfaces
 */
interface DistrictRepositoryInterface
{
    public function all();
    public function findDistrictById(int $province_id);
    public function findById(int $id);

}
