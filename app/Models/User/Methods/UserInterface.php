<?php

namespace App\Models\User\Methods;

interface UserInterface
{
    public function getListing(): array;

    public function get(&$issuccess): array;

    public function getByPrimary($primarykey, &$issuccess): array;

    public function saveuser(array $params): bool;

    public function getByLoginId(string $loginid, &$issuccess): array;

    public function getvendorproduct($vendorid, &$issuccess): array;

    public function getguestproduct(&$issuccess): array;
}
