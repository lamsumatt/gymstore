<?php

namespace App\Repositories;
use App\Repositories\Interfaces\UserCatalogueRepositoryInterface;
use App\Models\UserCatalogue;
use App\Repositories\BaseRepository;
/**
 * Class UserService
 * @package App\Services
 */
class UserCatalogueRepository extends BaseRepository implements UserCatalogueRepositoryInterface
{
    protected $model;
    public function __construct(
        UserCatalogue $model
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
                $query->where('name','like','%'.$condition['keyword'].'%')
                      ->orWhere('email','like','%'.$condition['keyword'].'%')
                      ->orWhere('phone','like','%'.$condition['keyword'].'%')
                      ->orWhere('address','like','%'.$condition['keyword'].'%');
            }
            if(isset($condition['publish'])  && $condition['publish'] != -1){
                $query->where('publish','=', $condition['publish']);
            }
            return $query;
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
