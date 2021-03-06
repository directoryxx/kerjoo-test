<?php

namespace App\Http\Requests\Permit;

use App\Rules\CheckUserRule;
use Illuminate\Foundation\Http\FormRequest;

class StorePermitRequest extends FormRequest
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
        return [
            "user_id" => ['required',new CheckUserRule()],
            'submission_date' => 'required|date',
            'reason' => 'required|max:255'
        ];
    }
}
