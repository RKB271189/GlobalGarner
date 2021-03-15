<?php

namespace App\Models\Product\Methods;

interface ProductInterface
{

    public function saveproduct(array $params): array;

    public function updateproduct(array $params): bool;

    public function getproductbyvendor($vendorid, &$issuccess): array;

    public function getallproduct(&$issuccess): array;

    public function getproductbyid($id, &$issuccess): array;

    public function getproductforguest(&$issuccess, &$link, $filter = '', $orderby = ''): array;
}
