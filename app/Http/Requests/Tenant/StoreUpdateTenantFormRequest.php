<?php

namespace App\Http\Requests\Tenant;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateTenantFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = $this->id;

        return [
            'name'          => 'required|min:3|max:100',
            'domain'        => "required|min:10|max:191|unique:tenants,domain,{$id},id",
            'db_database'   => "required|min:3|max:191|unique:tenants,db_database,{$id},id",
            'db_hostname'   => 'required|min:3|max:100',
            'db_username'   => 'required|min:3|max:100',
            'db_password'   => 'required|min:3|max:35',
        ];
    }
}
