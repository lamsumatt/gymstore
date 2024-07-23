<?php

namespace App\Repositories;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Models\User;
use App\Repositories\BaseRepository;
/**
 * Class UserService
 * @package App\Services
 */
class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    protected $model;
    public function __construct(
        User $model
    )
    {
        $this ->model = $model;
    }
 
    public function delete(int $id = 0){
        $model = $this -> findById($id);
        return $model->delete();
    }
    public function pagination(
        array $column = ['*'], 
        array $condition = [],
        array $join = [], 
        array $extend = [],
        int $perpage = 1,
        array $relations = []
    ) {
        $query = $this->model->select($column)
            ->where(function($query) use ($condition) {
                if (isset($condition['keyword']) && !empty($condition['keyword'])) {
                    $keyword = '%' . $condition['keyword'] . '%';
                    $query->where('name', 'like', $keyword)
                          ->orWhere('email', 'like', $keyword)
                          ->orWhere('phone', 'like', $keyword)
                          ->orWhere('address', 'like', $keyword);
                }
                if (isset($condition['publish']) && $condition['publish'] != 0) {
                    $query->where('publish', $condition['publish']);
                }
            })
            ->with('user_catalogues');
    
        // Join tables if provided
        if (!empty($join)) {
            foreach ($join as $joinTable) {
                $query->join(...$joinTable);
            }
        }
    
        // Handle pagination and path
        $path = $extend['path'] ?? url()->current();
        return $query->paginate($perpage)
                     ->withQueryString()
                     ->withPath($path);
    }
    

    public function findById(int $modelId, array $columns = ["*"], array $relation = [])
    {
        return $this->model->select($columns)->with($relation)->findOrFail($modelId);
    }
    
    public function updateByWhereIn(string $whereInField = '', array $whereIn = [], array $payload = []){
        return $this->model->whereIn($whereInField, $whereIn)->update($payload);
    }
}
