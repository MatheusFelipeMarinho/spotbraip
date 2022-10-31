<?php

namespace App\Spot\Interfaces;

interface ServiceInterface
{
    public function getAll(array $params): array;

    public function find(int $id, array $with);

    public function beforeSave(array $data);

    public function beforeUpdate(array $data);

    public function save(array $params);

    public function afterSave($entity, array $params);

    public function update(array $params);

    public function afterUpdate($entity, array $params);

    public function delete(int $id);

    public function afterDelete(int $id);

    public function toSelect(bool $withGenerateSelectOption = true);

    public function validateOnInsert(array $params);

    public function validateOnUpdate(array $params);

    public function validateOnDelete(array $params);

    public function getRepository();

    public function getUserAuth();

    public function preRequisite($id = null);

    public function create(array $data);

    public function makeRequest(string $url, string $messageComparation): bool;
}
