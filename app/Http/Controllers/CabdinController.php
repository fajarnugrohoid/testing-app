<?php

namespace App\Http\Controllers;

// base
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

// models
use App\Models\Master\Biodata;
use App\Models\Master\Unsur;
use App\Models\Master\SubUnsur;
use App\Models\Master\AngkaKredit;
use App\Models\Transaction\Dupak;
use App\Models\Transaction\DupakDetail;

// validation request
// use App\Http\Requests\Cabdin\CabdinRequest;

// libraries
use Carbon;
use DataTables;
use Helpers;
use Helper;
use Auth;

class CabdinController extends Controller
{
    //
    protected $link = 'cabdin/';
    protected $perms  = '';

	function __construct()
	{
		$this->setLink($this->link);
    }

    public function index()
    {
		$this->setTitle("Daftar Usulan Penilaian Angka Kredit");
        $this->setTableStruct([
            [
                'data' => 'num',
                'name' => 'num',
                'label' => '#',
                'orderable' => false,
                'searchable' => false,
                'className' => "center aligned",
                'width' => '1%',
            ],
            /* --------------------------- */
            [
                'data' => 'tanggal',
                'name' => 'tanggal',
                'label' => 'Tanggal Pengajuan',
                'searchable' => false,
                'sortable' => true,
                'className' => "center aligned",                
                'width' => '1%',
            ],
            [
                'data' => 'user.biodata.nama',
                'name' => 'nama',
                'label' => 'Nama',
                'searchable' => false,
                'sortable' => true,
            ],
            [
                'data' => 'golongan',
                'name' => 'golongan',
                'label' => 'Golongan/Pangkat',
                'searchable' => false,
                'sortable' => true,
            ],
            [
                'data' => 'golongan_usulan.jabatan',
                'name' => 'jabatan',
                'label' => 'Jabatan',
                'searchable' => false,
                'sortable' => true,
            ],
            [
                'data' => 'status',
                'name' => 'status',
                'label' => 'Status',
                'searchable' => false,
                'sortable' => true,
                'className' => "center aligned",
            ],
            [
                'data' => 'action',
                'name' => 'action',
                'label' => 'Aksi',
                'searchable' => false,
                'sortable' => false,
                'className' => "center aligned",
                // 'width' => 'auto',
            ]
        ]);
        
        return $this->render('modules.cabdin.daftar-dupak', ['mockup' => false]);
    }

    public function dashboard(){
        $dupak  = Dupak::where('user_id',Auth::user()->id)->first();
        return $this->render('modules.cabdin.dashboard',['dupak'  => $dupak]);
    }

	public function grid(Request $request)
	{
        // dd($date);
        $records = Dupak::with('golonganUsulan', 'user.biodata');

        // base filter
        $records->whereHas('unitKerja.kota', function($q){
            $q->where('cadisdik_id', \Auth::user()->cabang_dinas_id);
        });

        // filter from request
        // codenya...

        // sorting
        if (!isset(request()->order[0]['column'])) {
            $records->orderBy('created_at', 'desc');
        }

        return DataTables::of($records)
            ->addColumn('num', function ($record) use ($request) {
                return $request->get('start');
            })
            ->addColumn('tanggal', function ($record) {
                return Carbon::parse($record->tanggal)->format('d/m/Y');
            })
            ->addColumn('golongan', function ($record) {
                return $record->golonganUsulan->nama . ' - ' . $record->golonganUsulan->pangkat;
            })
            ->addColumn('status', function ($record) {
                switch ($record->status) {
                    case 0:
                        return '<span class="ui orange tag label"><i class="refresh icon"></i>Butuh Verifikasi</span>'; break;
                    case 1:
                        return '<span class="ui teal tag label"><i class="redo icon"></i>Terverifikasi</span>'; break;
                }
            })
            ->addColumn('action', function ($record) {
                $btn = '';

                // button edit
                if($record->status == 0){
                    $btn .= $this->makeButton([
                        'type'    => 'url',
                        'class'   => 'green',
                        'tooltip' => 'Verifikasi',
                        'label'   => '<i class="edit icon"></i> Verifikasi',
                        'url'     => 'javascript:void(0);',
                        'onClick' => 'verifikasi("'.Helper::encrypt($record->id).'", "'.str_replace("'", " ", $record->user->biodata->nama).'");',
                    ]);
                }

                return $btn;
            })
            ->rawColumns(['golongan','status', 'action'])
            ->make(true);
	}

    public function verifikasi(Request $request)
    {
        $id = Helper::decrypt($request->id);

        $dupak = Dupak::find($id);
        if ($dupak) {
            $dupak->status = 1;
            $dupak->cabdin_at = date('Y-m-d H:i:s');
            $dupak->save();

            return response([
                'status' => 'success',
                'biodata' => ['nama' => $dupak->user->biodata->nama],
            ], 200);
        }

        return response([
            'status' => 'error',
        ], 422);
    }

}
