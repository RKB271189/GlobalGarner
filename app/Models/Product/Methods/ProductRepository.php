<?php

namespace App\Models\Product\Methods;

use App\Models\BaseMethods\BaseRepository;
use App\Models\Product\product;

class ProductRepository extends BaseRepository implements ProductInterface
{
    public function __construct(product $product)
    {
        parent::__construct($product);
        $this->model = $product;
    }

    public function saveproduct(array $params): array
    {
        try {
            return $this->InsertNewRecordWithReturn($params)->toArray();
        } catch (ProductException $ex) {
            $this->StoreException($ex);
            return [];
        }
    }
    public function updateproduct(array $params): bool
    {
        try {
            return $this->UpdateRecord($params);
        } catch (ProductException $ex) {
            $this->StoreException($ex);
            return false;
        }
    }
    public function getproductbyvendor($vendorid, &$issuccess): array
    {
        try {
            $product = $this->SelectRecord(['vendor' => $vendorid]);
            if ($product)
                return $product->toArray();
            else
                return [];
        } catch (ProductException $ex) {
            $issuccess = false;
            $this->StoreException($ex);
            return [];
        }
    }
    public function getallproduct(&$issuccess): array
    {
        try {
            $product = $this->model->with('vendor')->get();
            if ($product)
                return $product->toArray();
            else
                return [];
        } catch (ProductException $ex) {
            $this->StoreException($ex);
            $issuccess = false;
            return [];
        }
    }

    public function getproductbyid($id, &$issuccess): array
    {
        try {
            $product = $this->FindModelById($id);
            if ($product)
                return $product->toArray();
            else
                return [];
        } catch (ProductException $ex) {
            $this->StoreException($ex);
            $issuccess = false;
            return [];
        }
    }

    public function getproductforguest(&$issuccess, &$link, $filter = '', $orderby = ''): array
    {
        try {
            $paginate = 6;
            if ($filter == '' && $orderby == '')
                $product = $this->model->orderBy('createdate', 'asc')->paginate($paginate);
            else {
                $product = $this->model->orderBy($filter, $orderby)->paginate($paginate);
            }
            if ($product) {
                $link = $product->links();
                return $product->toArray();
            } else {
                return [];
            }
        } catch (ProductException $ex) {
            $this->StoreException($ex);
            $issuccess = false;
            return [];
        }
    }
}
