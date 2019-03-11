<?php

namespace App\Http\Requests\Project;

use Illuminate\Validation\Factory as ValidationFactory;
use App\Http\Requests\Request;

/* rule */

class ProjectRequest extends Request
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
                'project_name'  => 'required'
            ];

        } else {
            $rules = [

            ];
        }

        /*
        $rules = [
            'project_name'  => 'required',
            'description'   => 'required',
            'start_project' => 'required|date_format:"d/m/Y"',
            'end_project'   => 'required|date_format:"d/m/Y"',
        ]; */

        return $rules;
    }

    public function attributes()
    {
        // validasi tambahan
        $attributes['project_name']        = 'Nama Project';

        return $attributes;
    }

}