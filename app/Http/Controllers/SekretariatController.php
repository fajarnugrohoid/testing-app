<?php

namespace App\Http\Controllers;

// base
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

// models
use App\Models\Authentication\User;
use App\Models\Authentication\Role;
use App\Models\Master\Biodata;
use App\Models\Master\Unsur;
use App\Models\Master\SubUnsur;
use App\Models\Transaction\Dupak;
use App\Models\Transaction\DupakDetail;

// validation request
use App\Http\Requests\Guru\GuruRequest;

// libraries
use Auth;
use Carbon;
use DataTables;
use Helper;
use PDF;

class SekretariatController extends Controller
{
    //
    protected $link = 'sekretariat/';
    protected $perms  = '';

	function __construct()
	{
		$this->setLink($this->link);
    }

    public function index(Request $r)
    {
		$this->setTitle("Daftar Usulan sekretariatan Angka Kredit");
        $this->setTableStruct([
            [
                'data' => 'num',
                'name' => 'num',
                'label' => '#',
                'orderable' => false,
                'searchable' => false,
                'className' => "center aligned",
                'width' => '40px',
            ],
            /* --------------------------- */
            [
                'data' => 'tanggal',
                'name' => 'tanggal',
                'label' => 'Tanggal Pengajuan',
                'searchable' => false,
                'sortable' => true,
                'width' => '150px',
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
                'data' => 'unit_kerja',
                'name' => 'unit_kerja',
                'label' => 'Asal',
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
                'data' => 'penilai_id',
                'name' => 'penilai_id',
                'label' => 'Penilai',
                'searchable' => false,
                'sortable' => true,
            ],
            [
                'data' => 'action',
                'name' => 'action',
                'label' => 'Check',
                'searchable' => false,
                'sortable' => false,
                'className' => "center aligned",
                'width' => '160px',
            ]
        ]);
        
        // ambil user berdasarkan role penilai
        $penilai = User::whereHas('roles', function($q){
            $q->where('name', 'penilai');
        })->get();

        return $this->render('modules.sekretariat.daftar-dupak', [
            'penilai' => $penilai,
        ]);
    }

    public function dashboard(){
        $dupak  = Dupak::orderBy('id','desc')->whereIn('status',[0,1])->get();     
        return $this->render('modules.sekretariat.dashboard',['dupak'  => $dupak]);           
    }

	public function grid(Request $request)
	{
        // dd($date);
        $records = Dupak::with('golonganUsulan', 'user.biodata');

        // base filter
        $records->where('penilai_id', NULL)->where('status', 1);

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
            ->addColumn('unit_kerja', function ($record) {
                return $record->unitKerja->kota->nama;
            })
            ->addColumn('status', function ($record) {
                switch ($record->status) {
                    case 0:
                        return '<span class="ui violet tag label">Proses</span>'; break;
                    case 1:
                        return '<span class="ui teal tag label">Verivikasi</span>'; break;
                    case 2:
                        return '<span class="ui green tag label">Diterima</span>'; break;
                    case 3:
                        return '<span class="ui red tag label">Ditolak</span>'; break;
                }
            })
            ->addColumn('action', function ($record) {
                return '<div class="ui checkbox penilai" data-id="'.$record->id.'"><input type="checkbox"><label>&nbsp;</label></div>';
            })
            ->rawColumns(['golongan','status','action'])
            ->make(true);
	}

    public function setPenilai(Request $request){
        $dupak   = json_decode($request->dupak_id, true);
        $penilai = $request->penilai_id;

        foreach ($dupak as $val) {
            Dupak::where('id', $val)
                ->update([
                    'penilai_id' => $penilai,
                    'sekretariat_at' => Carbon::now(),
                ]);
        }

        return response([
            'status'    => true,
        ]);
    }

    public function print($id){
        // $id = Helper::decrypt($id);

        $dupak = Dupak::with('user', 'golonganUsulan')->find($id);
        $unsurUtama     =  Unsur::where('kategori','Unsur Utama')->get(); 
        $unsurPenunjang =  SubUnsur::whereHas('unsur',function($q){
            $q->where('kategori','Unsur Penunjang');
        })->get();

        $subunsurutama     = array();
        $subunsurpenunjang = array();
        
        foreach($unsurUtama as $key=>$item){
            $subunsurutama[$key] = array();
            foreach($item->subunsur as $sub){
                $val    = $sub->id;
                $value  = DupakDetail::where('dupak_id',$id)->whereHas('angkaKredit',function($q) use($val){
                    $q->whereHas('kategori',function($r) use($val){
                        $r->where('sub_unsur_id',$val);
                    });
                })->groupBy('deskripsi')->selectRaw("sum(nilai_angka_kredit) as nilai,deskripsi")->first();
                if($value){
                    array_push($subunsurutama[$key], array('nama' => $sub->nama,'nilai'=>$value->nilai,'deskripsi'=>$value->deskripsi));
                }
            }
        }

        foreach($unsurPenunjang as $item){
            $val    = $item->id;
            $value  = DupakDetail::where('dupak_id',$id)->whereHas('angkaKredit',function($q) use($val){
                    $q->whereHas('kategori',function($r) use($val){
                        $r->where('sub_unsur_id',$val);
                    });
                })->sum('nilai_angka_kredit');
            array_push($subunsurpenunjang, array('nama' => $item->nama,'nilai'=>$value));
        }

        $data   = array('dupak'             =>$dupak,
                        'unsurutama'        =>$unsurUtama,
                        'subunsurutama'     =>$subunsurutama,
                        'unsurpenunjang'    =>$subunsurpenunjang,
                        'detail'            => DupakDetail::where('dupak_id',$id)->get());
        // $contentPdf = View('modules.guru.print', $data);
        // return $contentPdf;exit();
        // print pdf
        // $contentPdf = View('modules.guru.test', $data);
        // return View('modules.sekretariat.print', $data);
        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('modules.penilai.print', $data);
        return $pdf->stream();
        // Helper::printToPdf($contentPdf, [
        //     'filename' => 'print-bukti-daftar'
        // ]);
        // print_r($contentPdf);exit();
        // Helper::printToPdf();
    }
}
