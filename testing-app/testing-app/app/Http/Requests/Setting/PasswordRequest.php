<?php
namespace App\Http\Requests\Setting;
use App\Http\Requests\Request;
use App\Http\Rules\UnRule;
use App\Http\Rules\CoordinateRule;

class PasswordRequest extends Request
{

    
     /* Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // ambil validasi dasar
        $rules = [
            'password_lama'    => 'required',
            'password'         => 'min:2|required_with:confirm_password|same:confirm_password',
            'confirm_password' => 'min:2'
        ];

        return $rules;
    }

    public function attributes()
    {
        // ambil validasi dasar
        // $attributes = $this->attr;

        // validasi tambahan
        $attributes['password_lama']    = 'Password Lama';
        $attributes['password']         = 'Password Baru';
        $attributes['confirm_password'] = 'Confirm Password';
        return $attributes;
    }

}


