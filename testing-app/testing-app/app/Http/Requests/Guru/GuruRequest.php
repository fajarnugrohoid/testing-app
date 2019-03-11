<?php

namespace App\Http\Requests\Guru;

use Illuminate\Validation\Factory as ValidationFactory;
use App\Http\Requests\Request;

/* rule */

class GuruRequest extends Request
{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // ambil validasi dasar
        $rules = $this->rules;

        // validasi tambahan
        if (request()->status == 'baru') {
            $rules = [
                'nik'  => 'required|numeric',
                'nama'  => 'required',
            ];

        } else {
            $rules = [

            ];
        }

        return $rules;
    }

    public function attributes()
    {
        // validasi tambahan
        $attributes['nik'] = 'NIK';
        $attributes['nama'] = 'Nama';

        return $attributes;
    }

}