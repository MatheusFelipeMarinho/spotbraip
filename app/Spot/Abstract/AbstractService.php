<?php

namespace App\Spot\Abstract;

use App\Spot\Interfaces\ServiceInterface;

class AbstractService implements ServiceInterface
{
    protected $with = [];

    public function getAll(array $params): array
    {
        return $this->getRepository()->getAll($params, $this->with);
    }

    public function find(int $id, array $with)
    {
        $result = $this->getRepository()->find($id, $with);

        if($result == null){
            return throw new \Exception('Registro não encontrado');
        }

        return $result;
    }

    public function beforeSave(array $data)
    {
        return $data;
    }

    public function beforeUpdate(array $data)
    {
        return $data;
    }

    public function save(array $params)
    {
        $data = $this->beforeSave($params);

        if($this->validateOnInsert($data) !== false){
            $entity = $this->getRepository()->create($data);
            $this->afterSave($entity, $params);
            return $entity;
        }
    }

    public function afterSave($entity, array $params)
    {
        return $entity;
    }

    public function update(array $params)
    {
        $data = $this->beforeUpdate($params);

        if($this->validateOnUpdate($data) !== false){
            $entity = $this->getRepository()->update($data);
            $this->afterUpdate($entity, $params);
            return $entity;
        }
    }

    public function afterUpdate($entity, array $params)
    {
        return $entity;
    }

    public function delete(int $id)
    {
        $this->validateOnDelete($id);
        $this->beforeDelete($id);
        $this->getRepository()->delete($id);
        $this->afterDelete($id);
        return $id;
    }

    public function afterDelete(int $id)
    {
        return $id;
    }

    public function toSelect(bool $withGenerateSelectOption = true)
    {
        return $this->getRepository()->toSelect($withGenerateSelectOption);
    }

    public function validateOnInsert(array $params)
    {
        return true;
    }

    public function validateOnUpdate(array $params)
    {
        return true;
    }

    public function validateOnDelete(array $params)
    {
        return true;
    }

    public function getRepository()
    {
        return $this->repository;
    }

    public function getUserAuth()
    {
        return auth()->user();
    }

    public function preRequisite($id = null)
    {
        return true;
    }

    public function create(array $data)
    {
        $entity = $this->repository->create($data);

        $this->afterSave($entity, $data);

        return $entity;
    }

    public function makeRequest(string $url, string $messageComparation): bool
    {
        $response = Http::get($url);
		return
			$response->status() === Response::HTTP_OK &&
			$response->json()['message'] == $messageComparation;
    }



}
