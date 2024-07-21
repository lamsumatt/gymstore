<?php

namespace App\Repositories;

use App\Models\UserCatalogue;
use App\Repositories\BaseRepository;
use App\Repositories\Interfaces\UserCatalogueRepositoryInterface;

class UserCatalogueRepository extends BaseRepository implements UserCatalogueRepositoryInterface
{
    protected $model;
    public function __construct(UserCatalogue $model)
    {
        $this->model = $model;
    }
    public function findById(int $modelId, array $columns = ["*"], array $relation = [])
    {
        return $this->model->select($columns)->with($relation)->findOrFail($modelId);
    }
    
    public function updateByWhereIn(string $whereInField = '', array $whereIn = [], array $payload = []){
        return $this->model->whereIn($whereInField, $whereIn)->update($payload);
    }
    public function delete(int $id = 0){
        $model = $this -> findById($id);
        return $model->delete();
    }
}