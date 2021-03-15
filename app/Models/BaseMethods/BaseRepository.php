<?php

namespace App\Models\BaseMethods;

use App\Tools\TaitMethods\TraitMisc;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model as DatabaseModel;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;

class BaseRepository implements BaseInterface
{
    use TraitMisc;
    protected $model;
    public function __construct(DatabaseModel $databasemodel)
    {
        $this->model = $databasemodel;
    }
    public function GetTableListing(): ?array
    {
        try {
            /**
             * commented line is to get all column of a table
             */
            //return $this->model->getConnection()->getSchemaBuilder()->getColumnListing($this->model->getTable());
            return $this->model->getFormColumn();
        } catch (QueryException $ex) {
            $this->StoreException($ex);
            return null;
        }
    }
    public function InsertNewRecord(array $params): bool
    {
        try {
            return $this->model->insert($params);
        } catch (QueryException $ex) {
            $this->StoreException($ex);
            return false;
        }
    }
    public function InsertNewRecordWithReturn(array $params): ?DatabaseModel
    {
        try {
            return $this->model->create($params);
        } catch (QueryException $ex) {
            $this->StoreException($ex);
            return null;
        }
    }
    public function UpdateRecord(array $params): bool
    {
        try {
            $databasemodel = $this->FindModelById($params['id']);
            $databasemodel->fill($params);
            return $databasemodel->save();
        } catch (QueryException $ex) {
            $this->StoreException($ex);
            return false;
        }
    }
    public function UpdateRecordWithReturn(array $params): ?DatabaseModel
    {
        try {
            $databasemodel = $this->FindModelById($params['id']);
            $record = tap($databasemodel)->update($params);
            return $record;
        } catch (QueryException $ex) {
            $this->StoreException($ex);
            return null;
        }
    }
    public function DeleteRecordWithPrimary($primarykeyvalue): bool
    {
        try {
            return $this->model->destroy($primarykeyvalue);
        } catch (QueryException $ex) {
            $this->StoreException($ex);
            return false;
        }
    }
    public function DeleteRecord(array $params): bool
    {
        try {
            return $this->model->where($params)->delete();
        } catch (QueryException $ex) {
            $this->StoreException($ex);
            return false;
        }
    }
    public function DeleteRecordSignCondition(string $columnname, string $sign, $value): bool
    {
        try {
            return $this->model->where($columnname, $sign, $value)->delete();
        } catch (QueryException $ex) {
            $this->StoreException($ex);
            return false;
        }
    }
    public function FindModelById($primarykeyvalue): ?DatabaseModel
    {
        try {
            return $this->model->find($primarykeyvalue);
        } catch (ModelNotFoundException $ex) {
            $this->StoreException($ex);
            return null;
        }
    }
    public function FindOrFailModelById($primarykeyvalue): ?DatabaseModel
    {
        try {
            return $this->model->findorFail($primarykeyvalue);
        } catch (ModelNotFoundException $ex) {
            return null;
        }
    }
    public function FindModelFirst(array $condition): ?DatabaseModel
    {
        try {
            return $this->model->where($condition)->firstorfail();
        } catch (ModelNotFoundException $ex) {
            $this->StoreException($ex);
            return null;
        }
    }
    public function SelectAllRecord(array $column = ['*']): ?Collection
    {
        try {
            return $this->model->get($column);
        } catch (QueryException $ex) {
            $this->StoreException($ex);
            return null;
        }
    }
    public function SelectRecord(array $params = [], array $column = ['*'], string $orderby = '', string $sortby = 'asc', int $take = 0): ?Collection
    {
        try {
            $table = $this->model;
            if (count($params) > 0) {
                $table = $table->where($params);
            }
            if (!empty($orderby)) {
                $table = $table->orderBy($orderby, $sortby);
            }
            if ($take > 0) {
                $table = $table->take($take);
            }
            $record = $table->get($column);
            return $record;
        } catch (QueryException $ex) {
            $this->StoreException($ex);
            return null;
        }
    }
}
