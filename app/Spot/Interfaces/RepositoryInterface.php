<?php

namespace App\Spot\Interfaces;
use Illuminate\Database\Eloquent\Model;

interface RepositoryInterface
{
    public function getModel(): Model;

    public function all($params = null, $with = []);

    public function allWithOutPaginate($params = null, $with = []);

    public function list($sortBy = 'name', $pluck = 'name'): array;

    public function find(int $id, $with = []);

    public function findOneWhere(array $where);

    public function findByUserAuth(array $params);

    public function findOrFail(int $id);

    public function create($params): Model;

    public function update(Model $entity, array $data);

    public function delete(int $id);

    public function deleteWhere(array $where);

    public function getIdByUuid(string $uuid);

    public function where(array $where, $with = []);

}
