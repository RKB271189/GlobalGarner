<?php

namespace App\Http\Requests\Api;

use App\Tools\TaitMethods\TraitMisc;
use Illuminate\Foundation\Http\FormRequest;

class BaseRequest extends FormRequest
{
    use TraitMisc;
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
