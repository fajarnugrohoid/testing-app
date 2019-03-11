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
use App\Http\Requests\Guru\GuruRequest;

// libraries
use Carbon;
use DataTables;
use Helpers;
use Helper;
use Auth;
use PDF;
class GuruController extends Controller
{
    //
    protected $link = 'guru/';
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
        
        return $this->render('modules.guru.daftar-dupak', ['mockup' => false]);
    }

    public function dashboard(){
        $dupak  = Dupak::orderBy('id','desc')->where('user_id',Auth::user()->id)->first();
        return $this->render('modules.guru.dashboard',['dupak'  => $dupak]);
    }

	public function grid(Request $request)
	{
        // dd($date);
        $records = Dupak::with('golonganUsulan', 'user.biodata');

        // base filter
        $records->where('user_id', \Auth::user()->id);

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
                        return '<span class="ui blue tag label"><i class="refresh icon"></i>Proses</span>'; break;
                    case 1:
                        return '<span class="ui teal tag label"><i class="redo icon"></i>Verifikasi</span>'; break;
                    case 2:
                        return '<span class="ui green tag label"><i class="check icon"></i>Diterima</span>'; break;
                    case 3:
                        return '<span class="ui red tag label"><i class="exclamation triangle icon"></i>Ditolak</span>'; break;
                }
            })
            ->addColumn('action', function ($record) {
                $btn = '';

                // button edit
                if($record->status == 0){
                    
                    $btn .= $this->makeButton([
                        'type'    => 'url',
                        'class'   => 'green',
                        'tooltip' => 'Ubah',
                        'label'   => '<i class="edit icon"></i> Ubah',
                        'url'     => url(''),
                    ]);
                }

                $btn .= $this->makeButton([
                        'type'    => 'url',
                        'class'   => 'teal',
                        'tooltip' => 'Lihat Detail',
                        'label'   => '<i class="info icon"></i> Detail',
                        'url'     => url(''),
                    ]);

                $btn .= $this->makeButton([
                        'type'    => 'url',
                        'class'   => 'orange',
                        'tooltip' => 'Cetak Bukti Pendaftaran',
                        'label'   => '<i class="print icon"></i> Cetak',
                        'url'     => url('guru/print/' . Helper::encrypt($record->id)),
                        'target'  => '_blank',
                    ]);

                return $btn;
            })
            ->rawColumns(['golongan','status','action'])
            ->make(true);
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
        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('modules.guru.print', $data);
        return $pdf->stream();
        // Helper::printToPdf($contentPdf, [
        //     'filename' => 'print-bukti-daftar'
        // ]);
        // print_r($contentPdf);exit();
        // Helper::printToPdf();
    }

    public function create($id ='')
    {
        $dupak  = Dupak::where('user_id', Auth::user()->id)->get();

        if (count($dupak) == 0) { // belum punya dupak, maka isi dupak sebelumnya
            $this->setTitle("");
            return $this->render('modules.guru.form-sebelum', [
                'biodata'    => \Auth::user()->biodata,
                'utama1a'    => AngkaKredit::where('kategori_id', 1)->first(),
                'utama1b'    => AngkaKredit::where('kategori_id', 2)->first(),
                'utama2a'    => AngkaKredit::where('kategori_id', 3)->first(),
                'utama2b'    => AngkaKredit::where('kategori_id', 4)->first(),
                'utama2c'    => AngkaKredit::where('kategori_id', 5)->first(),
                'utama3a'    => AngkaKredit::where('kategori_id', 6)->first(),
                'utama3b'    => AngkaKredit::where('kategori_id', 8)->first(),
                'utama3c'    => AngkaKredit::where('kategori_id', 18)->first(),
                'penunjang1' => AngkaKredit::where('kategori_id', 23)->first(),
                'penunjang2' => AngkaKredit::where('kategori_id', 24)->first(),
                'penunjang3' => AngkaKredit::where('kategori_id', 25)->first(),
            ]);

        } else { 
            $this->setTitle("Buat Dupak");
            // cek apa masih ada yg masih proses?
            $dupak  = Dupak::where('user_id', Auth::user()->id)->whereIn('status', [0,1])->get();
            if(count($dupak)>0){              
                return $this->dashboard();
            }else{
                return $this->render('modules.guru.form-create', [
                    'biodata'    => \Auth::user()->biodata,
                    'prajabatan' => AngkaKredit::find(4),
                ]); 
            }
        }
    }

    public function store(GuruRequest $request)
    {
        // dd($request->all());
        /* transaction db */
        \DB::beginTransaction();
        try {
            // get all data from request
            $data = $request->all();

            // reformat
            $data['tgl_lahir']    = Carbon::createFromFormat('d/m/Y', $request->tgl_lahir)->format('Y-m-d');
            $data['tmt_golongan'] = Carbon::createFromFormat('d/m/Y', $request->tmt_golongan)->format('Y-m-d');

            //# update biodata
            $biodata = Biodata::where('nip', \Auth::user()->biodata->nip)->first();
            $biodata->fill($data);
            $biodata->save();

            //# insert to dupak
            $dupak = new Dupak();
            $dupak->fill([
                'user_id'              => \Auth::user()->id,
                'tanggal'              => date('Y-m-d'),
                'pendidikan'           => $data['pendidikan'],
                'jurusan'              => $data['jurusan'],
                'tahun_lulus'          => $data['tahun_pendidikan'],
                'golongan_sekarang_id' => $request->status == 'lama' ? ($data['golongan_id'] == 1 ? 1 : ((int) $data['golongan_id'] - 1)) : $data['golongan_id'],
                'golongan_target_id'   => $request->status == 'lama' ? $data['golongan_id'] : ((int) $data['golongan_id'] + 1),
                'tmt_golongan'         => $data['tmt_golongan'],
                'unit_kerja_id'        => $data['unit_kerja_id'],
                'status'               => $request->status == 'lama' ? 2 : 0,
            ]);
            $dupak->save();

            # insert to detail
            for ($i=0, $c=count($data['angkakredit_id']); $i<$c; $i++) {
                $dupak->detail()->create([
                    'angka_kredit_id'    => $data['angkakredit_id'][$i],
                    'nilai_angka_kredit' => $data['angkakredit_nilai'][$i],
                    'deskripsi'          => $data['angkakredit_deskripsi'][$i],
                    'tahun'              => $data['angkakredit_tahun'][$i],
                ]);
            }


            \DB::commit();
            return response([
                'status'       => 'success',
            ], 200);

        } catch (\Exception $e) {
            \DB::rollback();

            return response([
                'errors'       => ['Beban server sedang tinggi, silakan ulangi lagi.', $e->getMessage()],
            ], 422);
        }
    }

}
