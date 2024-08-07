<?php

namespace App\Repositories\Interfaces;

interface BaseRepositoryInterface
{
    public function all();
    public function findById(int $id);
    public function create(array $payload);
    public function update(int $id = 0, array $payload);
    public function delete(int $id);
    public function updateByWhereIn(string $whereInField = '', array $whereIn = [], array $payload = []);
    public function pagination(array $column = ['*'], 
                                array $condition = [], 
                                array $join = [], 
                                array $extend = [], 
                                int $perpage = 1,
                                array $relations = [],
                                array $orderBy = []
                            );
    public function createLanguagePivot($model, array $payload = []);
}
