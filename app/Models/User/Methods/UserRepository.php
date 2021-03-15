<?php

namespace App\Models\User\Methods;

use App\Models\BaseMethods\BaseRepository;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRepository extends BaseRepository implements UserInterface
{
    public function __construct(User $user)
    {
        parent::__construct($user);
    }
    public function getListing(): array
    {
        try {
            $list = $this->GetTableListing();
            return $list;
        } catch (UserException $ex) {
            $this->StoreException($ex);
            return [];
        }
    }
    public function get(&$issucess): array
    {
        try {
            $user = $this->SelectAllRecord();
            if ($user) {
                return $user->toArray();
            }
            return [];
        } catch (UserException $ex) {
            $issucess = false;
            $this->StoreException($ex);
            return [];
        }
    }
    public function getByPrimary($primarykey, &$issuccess): array
    {
        try {
            $user = $this->FindOrFailModelById($primarykey);
            if ($user) {
                return $user->toArray();
            }
            return [];
        } catch (UserException $ex) {
            $issuccess = false;
            $this->StoreException($ex);
            return [];
        }
    }

    public function saveuser(array $params): bool
    {
        try {
            if (array_key_exists('password', $params)) {
                $params['password'] = Hash::make($params['password']);
            }
            return $this->InsertNewRecord($params);
        } catch (UserException $ex) {
            $this->StoreException($ex);
            return false;
        }
    }

    public function getByLoginId(string $loginid, &$issuccess): array
    {
        try {
            $condititon = [
                'loginid' => $loginid
            ];
            $user = $this->FindModelFirst($condititon);
            if ($user)
                return $user->toArray();
            else
                return [];
        } catch (UserException $ex) {
            $this->StoreException($ex);
            $issuccess = false;
            return [];
        }
    }
    public function getvendorproduct($vendorid, &$issuccess): array
    {
        try {
            $product = $this->model->with('product')->where('id', $vendorid)->get();
            if ($product)
                return $product->toArray();
            else
                return [];
        } catch (UserException $ex) {
            $issuccess = false;
            $this->StoreException($ex);
            return [];
        }
    }

    public function getguestproduct(&$issuccess): array
    {
        try {
            $product = $this->model->with('product')->where('role', 'vendor')->get();
            if ($product)
                return $product->toArray();
            else
                return [];
        } catch (UserException $ex) {
            $issuccess = false;
            $this->StoreException($ex);
            return [];
        }
    }
}
