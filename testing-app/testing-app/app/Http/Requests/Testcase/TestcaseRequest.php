<?php

namespace App\Http\Requests\Testcase;

use Illuminate\Validation\Factory as ValidationFactory;
use App\Http\Requests\Request;

/* rule */

class TestcaseRequest extends Request
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
                'version'  => 'numeric',
                'title'  => 'required',
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
        $attributes['version'] = 'version';
        $attributes['title'] = 'title';

        return $attributes;
    }

}