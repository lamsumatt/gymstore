<?php

namespace App\Repositories;

use App\Models\District;
use App\Repositories\Interfaces\DistrictRepositoryInterface;
use App\Repositories\BaseRepository;
/**
 * Class UserService
 * @package App\Services
 */
class DistrictRepository extends BaseRepository implements DistrictRepositoryInterface
{
    protected $model;
    public function __construct(
        District $model
    )
    {
        $this ->model = $model;
    }
    public function findDistrictById(int $province_id = 0)
    {
        return $this ->model -> where('province_code','=', $province_id)->get();

    }
    /**
     * Find a model by its ID.
     *
     * @param int $modelId The ID of the model to find.
     * @param array $columns An optional array of columns to select. Defaults to ["*"].
     * @param array $relation An optional array of relations to eager load. Defaults to [].
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException If the model is not found.
     * @return \Illuminate\Database\Eloquent\Model The found model.
     */
    public function findById(int $modelId, array $columns = ["*"], array $relation = [])
    {
        return $this->model->select($columns)->with($relation)->findOrFail($modelId);
    }
}
