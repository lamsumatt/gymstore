<?php

namespace App\Repositories;

use App\Models\PostCatalogue;
use App\Repositories\BaseRepository;
use App\Repositories\Interfaces\PostCatalogueRepositoryInterface;

class PostCatalogueRepository extends BaseRepository implements PostCatalogueRepositoryInterface
{
    protected $model;
    public function __construct(PostCatalogue $model)
    {
        $this->model = $model;
    }
    
    public function pagination(
        array $column = ['*'], 
        array $condition = [],
        array $join=[], 
        array $extend = [],
        int $perpage = 1,
        array $relations = [],
        array $orderBy = ['id', 'DESC'],
        array $where = []
        ){
        $query = $this->model->select($column)->where(function($query) use ($condition){
            if(isset($condition['keyword']) && !empty($condition['keyword'])){
                $query->where('name','like','%'.$condition['keyword'].'%');
            }
            if(isset($condition['publish'])  && $condition['publish'] != 0){
                $query->where('publish','=', $condition['publish']);
            }
            return $query;
        });

        if(isset($relations) && !empty($relations)){
            foreach($relations as $relation){
                $query->withCount($relation);
            }
        }

        if(isset($join) && is_array($join) && count($join)){
            foreach($join as $key => $val){
                $query->join($val[0], $val[1], $val[2], $val[3]);
            }
        }

        if(isset($orderBy) && !empty($orderBy)){
            $query->orderBy($orderBy[0], $orderBy[1]);
        }
        
        return $query->paginate($perpage)->withQueryString()->withPath(env('APP_URL').$extend['path']);
    }

    public function getPostCatalogueById(int $id = 0, $language_id = 0){
        return $this->model->select(['post_catalogue.id', 
                                     'post_catalogue.parent_id',
                                     'post_catalogue.image',
                                     'post_catalogue.icon',
                                     'post_catalogue.album',
                                     'post_catalogue.publish',
                                     'post_catalogue.follow',
                                     'tb2.name',
                                     'tb2.description',
                                     'tb2.content',
                                     'tb2.meta_title',
                                     'tb2.meta_keyword',
                                     'tb2.meta_description',
                                     'tb2.canonical',
                                    ])
                            ->join('post_catalogue_language as tb2', 'tb2.post_catalogue_id', '=', 'post_catalogue.id')
                            ->where('tb2.language_id', '=', $language_id)
                            ->findOrFail($id);
    }
}