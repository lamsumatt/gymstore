<?php

namespace App\Repositories\Interfaces;

use Illuminate\Http\Request;

interface PostCatalogueRepositoryInterface
{
    public function all();
    public function findById(int $id);
    public function create(array $payload);
    public function update(int $id = 0, array $payload);
    public function delete(int $id);
    public function pagination(array $column = ['*'], 
                                array $condition = [], 
                                array $join = [], 
                                array $extend = [], 
                                int $perpage = 1,
                                array $relations = []);
    public function createLanguagePivot($model, array $payload = []);
}