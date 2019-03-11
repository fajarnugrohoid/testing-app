<?php
namespace App\Http\Controllers\Ajax;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

// models
use App\Models\Master\UnitKerja;
use App\Models\Master\AngkaKredit;

class InfoController extends Controller
{
    public function unitKerja(Request $request)
    {
        $id = $request->id;

        $result = UnitKerja::find($id);

        return response(json_encode($result->toArray()), 200);
    }

    public function angkaKredit(Request $request)
    {
        $id = $request->id;

        $result = AngkaKredit::find($id);

        return response(json_encode($result->toArray()), 200);
    }
}
