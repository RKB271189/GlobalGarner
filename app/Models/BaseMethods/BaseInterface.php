<?php

namespace App\Models\BaseMethods;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model as DatabaseModel;

interface BaseInterface
{
    /**
     *Method to get column name of the model          
     *@return array
     */
    public function GetTableListing(): ?array;
    /**
     * Method to create new record
     * @return bool
     */
    public function InsertNewRecord(array $params): bool;

    /**
     * Method to create new record with new model return
     * @return Model
     */
    public function InsertNewRecordWithReturn(array $params): ?DatabaseModel;

    // /**
    //  * Method to create new record with Array
    //  * @return bool
    //  */
    // public function InsertNewRecordArray(array $params): bool;
    /**
     * Method to update existing record
     * $params should contian id key as primary key 
     * Ex: $params['id']=primarykey
     * @return bool
     */
    public function UpdateRecord(array $params): bool;

    /**
     * Method to update existing record and return model
     * $params should contian id key as primary key 
     * Ex: $params['id']=primarykey
     * @return Model
     */
    public function UpdateRecordWithReturn(array $params): ?DatabaseModel;

    /**
     * Method to delete record on primary key
     * It accepts primary value in the form $primaryvalue=1 or $primaryvalue='1,2,3' or $primaryvalue=array(1,2,3) 
     * @return bool
     */
    public function DeleteRecordWithPrimary($primaryvalue): bool;

    /**
     * Method to delete record using where condition
     * @return bool
     */

    public function DeleteRecord(array $primarykeyvalue): bool;

    /**
     * Method to delete record where condition has sign
     * where $sign='>' or '<' or '!=';
     * $columname= database column name
     * Ex: $model->where('age','>',100)->delete()
     * @return bool
     */
    public function DeleteRecordSignCondition(string $columnname, string $sign, $value): bool;

    /**
     * Recommonded method when dealing with primary key value
     * Method to retrive record using primary key value
     * Here $primarykeyvalue=1 or $primarykeyvalue=array(1,2,3)
     * @return Model
     */
    public function FindOrFailModelById($primarykeyvalue): ?DatabaseModel;

    /**
     * Method to retrive record using primary key value
     * Here $primarykeyvalue=1 or $primarykeyvalue=array(1,2,3)
     * @return Model
     */
    public function FindModelById($primarykeyvalue): ?DatabaseModel;

    /**
     * Method to retrive first row of record using where condition
     * Here $condition=['columnname',$value];
     * @return Model or null
     */
    public function FindModelFirst(array $condition): ?DatabaseModel;
    /**
     * Select All Data From Model
     * @return Collection
     */
    public function SelectAllRecord(array $column = ['*']): ?Collection;
    /**
     * Select data based on where condition
     * @return Collection
     */
    public function SelectRecord(array $params = [], array $column = ['*'], string $orderby = '', string $sortby = 'asc', int $take = 0): ?Collection;
}
