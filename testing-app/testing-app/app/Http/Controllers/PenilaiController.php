<?php

namespace App\Http\Controllers;

// base
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

// models
use App\Models\Authentication\User;
use App\Models\Master\Biodata;
use App\Models\Master\AngkaKredit;
use App\Models\Master\Unsur;
use App\Models\Master\SubUnsur;
use App\Models\Transaction\Dupak;
use App\Models\Transaction\DupakDetail;

// validation request
use App\Http\Requests\Guru\GuruRequest;

// libraries
use Carbon;
use DataTables;
use Helpers;
use Helper;
use PDF;
class PenilaiController extends Controller
{
    //
    protected $link = 'penilai/';
    protected $perms  = '';

	function __construct()
	{
		$this->setLink($this->link);
    }

    public function index(Request $r)
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
                'width' => '160px',
            ]
        ]);
        
        if($r->input('id')){
            return $this->proses($r->input('id'));
        }else{
            return $this->render('modules.penilai.daftar-dupak', ['mockup' => false]);
        }
    }

	public function grid(Request $request)
	{
        // dd($date);
        $records = Dupak::with('golonganUsulan', 'user.biodata');

        // base filter
        $records->where('penilai_id', \Auth::user()->id);

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
                $btn = '';

                // button edit

                $btn .= $this->makeButton([
                    'type'    => 'url',
                    'class'   => 'green',
                    'tooltip' => 'Proses Penilaian',
                    'label'   => 'Proses',
                    'url'     => url('penilai/nilai/' . Helper::encrypt($record->id)),
                ]);

                $btn .= $this->makeButton([
                        'type'    => 'url',
                        'class'   => 'orange',
                        'tooltip' => 'Cetak Bukti Pendaftaran',
                        'label'   => '<i class="print icon"></i> Cetak',
                        'url'     => url('penilai/print/' . Helper::encrypt($record->id)),
                        'target'  => '_blank',
                    ]);

                return $btn;
            })
            ->rawColumns(['golongan','status','action'])
            ->make(true);
	}

    public function formNilai($id)
    {
        $this->setTitle('Form Penilaian DUPAK');

        $id = Helper::decrypt($id);

        $dupak = Dupak::with('user', 'golonganUsulan')->find($id);

        $pendidikan = $dupak->detail()
                           ->with('angkaKredit', 'angkaKredit.kategori', 'angkaKredit.kategori.subUnsur')
                           ->whereHas('angkaKredit', function($q){
                              $q->whereIn('kategori_id', [1,2]);
                           })->get();

        $penugasan = $dupak->detail()
                           ->with('angkaKredit', 'angkaKredit.kategori', 'angkaKredit.kategori.subUnsur')
                           ->whereHas('angkaKredit.kategori', function($q){
                              $q->whereIn('sub_unsur_id', [3,4,5]);
                           })->get();

        $pkb = $dupak->detail()
                           ->with('angkaKredit', 'angkaKredit.kategori', 'angkaKredit.kategori.subUnsur')
                           ->whereHas('angkaKredit.kategori', function($q){
                              $q->whereIn('sub_unsur_id', [6,7,8]);
                           })->get();

        $penunjang = $dupak->detail()
                           ->with('angkaKredit', 'angkaKredit.kategori', 'angkaKredit.kategori.subUnsur')
                           ->whereHas('angkaKredit.kategori', function($q){
                              $q->whereIn('sub_unsur_id', [9,10,11]);
                           })->get();

        // print_r($id);exit();
        return $this->render('modules.penilai.form-proses', [
            'dupak'      => $dupak,
            'penugasan'  => $penugasan,
            'pkb'        => $pkb,
            'penunjang'  => $penunjang,
            'pendidikan' => $pendidikan,
        ]);
    }

    public function showFormTolak($id)
    {
        $id = Helper::decrypt($id);

        $detail = DupakDetail::with('angkaKredit.penolakanAngkaKredit')->find($id);

        return $this->render('modules.penilai.form-tolak', [
            'detail'     => $detail,
        ]);
    }


    public function prosesTolak(Request $request)
    {
        $detail_id = $request->detail_id;
        $tolak     = $request->tolak;

        // get dupak detail
        $dt = DupakDetail::find($detail_id);

        if ($dt) {
            $dt->status = 2;
            $dt->save();

            // loop penolakan
            foreach ($tolak as $key => $val) {
                $dt->penolakan()->create([
                    'penolakan_id' => $key
                ]);
            }
        }

        return response([
            'status'    => true,
            'detail_id' => $dt->id,
        ]);
    }

    public function prosesTerima(Request $request)
    {
        $detail = DupakDetail::find($request->detail_id);

        if ($detail) {
            $detail->status = 1;
            $detail->save();
        }

        return response([
            'status'    => true,
            'detail_id' => $detail->id,
        ]);
    }

    public function store(Request $request)
    {
        $id = Helper::decrypt($request->id);

        $dupak = Dupak::find($id);

        $dupak->status = 2; // diterima
        $dupak->save();

        return response([
            'status'    => true,
        ]);
    }

    public function print($id){
        $id = Helper::decrypt($id);

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
                })->groupBy('deskripsi')->selectRaw("sum(nilai_angka_kredit) as nilai, deskripsi")->first();
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
                        // 'unsurutama'        =>$unsurUtama,
                        // 'subunsurutama'     =>$subunsurutama,
                        // 'unsurpenunjang'    =>$subunsurpenunjang,
                        'detail'            => DupakDetail::where('dupak_id',$id)->get());
        // $contentPdf = View('modules.guru.print', $data);
        // return $contentPdf;exit();
        // print pdf
        // $contentPdf = View('modules.guru.test', $data);
        // return View('modules.guru.test', $data);exit();
        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('modules.penilai.print', $data);
        return $pdf->stream();
        // Helper::printToPdf($contentPdf, [
        //     'filename' => 'print-bukti-daftar'
        // ]);
        // print_r($contentPdf);exit();
        // Helper::printToPdf();
    }
}
