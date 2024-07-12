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
    
    // public function getAllPaginate(){
    //     return  User::paginate(10);
    // }
    public function delete(int $id = 0){
        $model = $this -> findById($id);
        return $model->delete();
    }

    public function pagination(
        array $column = ['*'], 
        array $condition = [],
        array $join=[], 
        array $extend = [],
        int $perpage = 1
        ){
        $query = $this->model->select($column)->where(function($query) use ($condition){
            if(isset($condition['keyword']) && !empty($condition['keyword'])){
                $query->where('name','like','%'.$condition['keyword'].'%');
            }
        });
            if(!empty($join)){
            $query->join(...$join);
            }
            return $query->paginate($perpage)->withQueryString()->withPath(env('APP_URL').$extend['path']);
            }

    public function findById(int $modelId, array $columns = ["*"], array $relation = [])
    {
        return $this->model->select($columns)->with($relation)->findOrFail($modelId);
    }
    
    public function updateByWhereIn(string $whereInField = '', array $whereIn = [], array $payload = []){
        return $this->model->whereIn($whereInField, $whereIn)->update($payload);
    }
}
