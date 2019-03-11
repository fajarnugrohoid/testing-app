<?php
namespace App\Http\Requests\Setting;
use App\Http\Requests\Request;
use App\Http\Rules\UnRule;
use App\Http\Rules\CoordinateRule;

class ProfileRequest extends Request
{

    
     /* Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // ambil validasi dasar
        $rules = [
            // 'code'                => 'required',
            'name'                => 'required',
            'address'             => 'required',
            'address_city'        => 'required',
            'address_rw'          => 'required',
            'address_rt'          => 'required',
            'address_district'    => 'required',
            'address_subdistrict' => 'required',
            'coordinate'          => ['required', new CoordinateRule()]
        ];

        return $rules;
    }

    public function attributes()
    {
        // ambil validasi dasar
        // $attributes = $this->attr;

        // validasi tambahan
        $attributes['code']                = 'Code';
        $attributes['name']                = 'Name';
        $attributes['address']             = 'Alamat';
        $attributes['address_city']        = 'Kota/Kab';
        $attributes['address_rw']          = 'RW';
        $attributes['address_rt']          = 'RT';
        $attributes['address_district']    = 'Kecamatan';
        $attributes['address_subdistrict'] = 'Kelurahan';

        return $attributes;
    }

}


