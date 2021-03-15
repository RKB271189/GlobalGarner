<?php

namespace App\Tools\TaitMethods;

use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

trait TraitMisc
{
    /**
     * Method to hash given string
     * @return string
     */
    public function MakeHash(string $value): string
    {
        $hased = Hash::make($value);
        return $hased;
    }
    /**
     * Method to generate 4 digit otp number
     * @return string
     */
    public function GenerateOTP(): string
    {
        $sequence = '123456789';
        $sequence = str_shuffle($sequence);
        $otp = substr($sequence, 0, 4);
        return $otp;
    }

    /**
     * Method to store web generated exception     
     */
    public function StoreException(Exception $ex)
    {
        $errorstring = "****************************Exception****************************\n";
        $errorstring .= "Date-Time : " . date('Y-m-d H:i:s') . "\n";
        $errorstring .= "Trace :" . $ex->getTraceAsString();
        $errorstring .= "Error : " . $ex->getMessage() . "\n";
        $errorstring .= "***************************End-Exception*************************\n";
        $fileName = 'log/error.txt';
        Storage::disk('public')->append($fileName, $errorstring);
    }
    /**
     * Method to store order log     
     */    
    /**
     * Method to convert given array in | seperated string to pass to route in url
     * Ex: report showing with from and to datetime filter
     * @return string
     */
    public function FormatDataToString(array $data): string
    {
        $formatedstring = '';
        foreach ($data as $key => $val) {
            $formatedstring .= $key . '|' . trim($val) . ',';
        }
        $formatedstring = substr($formatedstring, 0, -1);
        return $formatedstring;
    }
    /**
     * Method to convert | seperated string to array 
     * Ex : Start_Time | 2020-11-09
     * @return array
     */
    public function FormatStringToData(string $data): array
    {
        $data = explode(',', $data);
        $formatedarray = [];
        for ($i = 0; $i < count($data); $i++) {
            $val = explode('|', $data[$i]);
            $formatedarray += [
                $val[0] => $val[1]
            ];
        }
        return $formatedarray;
    }    
}
