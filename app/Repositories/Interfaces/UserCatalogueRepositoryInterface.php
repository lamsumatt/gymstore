<?php

namespace App\Repositories\Interfaces;

use Illuminate\Http\Request;

interface UserCatalogueRepositoryInterface
{
    public function create(array $payload);
    public function update(int $id = 0, array $payload);
    public function pagination(array $column = ['*'], array $condition = [], array $join = [], array $extend = [], int $perpage = 1);
}