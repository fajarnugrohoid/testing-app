<?php
namespace App\Http\Controllers\Ajax;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

// models
use App\Models\Master\UnitKerja;
use App\Models\Master\AngkaKredit;

class OptionController extends Controller
{
    public function unitKerja(Request $request)
    {
        $kota = $request->kota_id;

        return UnitKerja::options('nama', 'id', [
            'filters' => [
                'kota_id' => $kota
            ]
        ], '-- Pilih --');
    }

    public function angkaKredit(Request $request)
    {
        $kategori = $request->kategori_id;

        return AngkaKredit::options('nama', 'id', [
            'filters' => [
                'kategori_id' => $kategori
            ]
        ], '-- Pilih --');
    }
}
