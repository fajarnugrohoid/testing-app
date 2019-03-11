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
        $rules = [
            'nama'        => 'required',
            'deskripsi'   => 'required',
            'tgl_mulai'   => 'required|date_format:"d/m/Y"',
            'tgl_selesai' => 'required|date_format:"d/m/Y"',
        ];

        return $rules;
    }

    public function attributes()
    {
        // validasi tambahan
        $attributes['nama']        = 'Nama Project';
        $attributes['deskripsi']   = 'Deskripsi Project';
        $attributes['tgl_mulai']   = 'Tanggal Mulai';
        $attributes['tgl_selesai'] = 'Tanggal Selesai';

        return $attributes;
    }

}