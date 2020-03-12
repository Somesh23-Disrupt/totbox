<?php

/**
 * Created by PhpStorm.
 * User: Umesh Kumar Yadav
 * Date: 7/25/2017
 * Time: 7:12 AM
 */
namespace App\Http\Requests\Academic\Year;

use Illuminate\Foundation\Http\FormRequest;

class EditValidation extends FormRequest
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
            'title' => 'required |digits:4|integer|min:2000|max:'.(date('Y')+ 81).' | unique:years,title,'.$this->request->get('id'),
        ];
    }

    public function messages()
    {
        return [
            'title.unique' => 'The year already exist. Please, edit or create new.',
        ];
    }
}
