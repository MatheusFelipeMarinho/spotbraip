<?php

namespace App\Spot\Abstract;

use Illuminate\Support\Facades\Auth;
use App\Spot\Interfaces\RepositoryInterface;

class AbstractRepository implements RepositoryInterface
{
   public function getModel(): Model
   {
        return $this->model;
   }

    public function all($params = null, $with = [])
    {
          return $this->getModel()->with($with)->query($params)->paginate()->withQueryString();
    }

    public function allWithOutPaginate($params = null, $with = [])
    {
        return $this->getModel()->with($with)->query($params)->get();
    }

    public function list($sortBy = 'name', $pluck = 'name'): array
    {
        return $this->getModel()->orderBy($sortBy)->pluck($pluck, 'id')->all();
    }

    public function find(int $id, $with = [])
    {
        if(is_numeric($id)){
            return $this->getModel()->with($with)->find($id);
        }

        return $this->findOneWhere(['uuid' => $id]);
    }

    public function findOneWhere(array $where)
    {
        $object = $this->where($where);
        return $object->first();
    }

    public function findByUserAuth(array $params)
    {
        if (isset($params['id_user']) && !empty($params['id_user'])) {
			return $this->findOrFail($params['id_user']);
		}

		return Auth::user()->id;
    }

    public function findOrFail(int $id)
    {
        return $this->getModel()->findOrFail($id);
    }

    public function create($params): Model
    {
        return $this->getModel()->create($params);
    }

    public function update(Model $entity, array $data)
    {
       return $entity->forceFill($data)->save();
    }

    public function delete(int $id)
    {
        $model = $this->find($id);
        $model->delete();
    }

    public function deleteWhere(array $where)
    {
        $this->getModel()->where($where)->delete();
    }

    public function getIdByUuid(string $uuid)
    {
        return $this->getModel()->where('uuid', $uuid)->first()->id;
    }

    public function where(array $where, $with = [])
    {
        return $this->getModel()->with($with)->where($where)->get();
    }


    
}
