<?php

namespace App\Http\Controllers\Layanan;

// Base
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

// Models
// use App\Models\Master\XXX;

// Validations
// use App\Http\Requests\MAster\XXX;

// Libraries
use Datatables;

class LayananController extends Controller
{
    //
    protected $link = 'backend/master/';
    protected $perms  = '';

    function __construct()
    {
        $this->setLink($this->link);
        $this->setPerms($this->perms);

        $this->setTitle("List Pelayanan");
        $this->setSubtitle("List Pelayanan");
        $this->setModalSize("tiny");
        $this->setBreadcrumb(['Pelayanan' => '#']);
        
    }

    public function index()
    {
        $this->setTitle('List Pelayanan');
        
        $this->setTableStruct([
            [
                'data' => 'num',
                'name' => 'num',
                'label' => '#',
                'orderable' => false,
                'searchable' => false,
                'className' => "one wide column center aligned",
            ],
            /* --------------------------- */
            [
                'data' => 'judul',
                'name' => 'judul',
                'label' => 'Judul',
                'searchable' => false,
                'sortable' => true,
                'className' => 'four wide column'
            ],
            [
                'data' => 'created_by',
                'name' => 'created_by',
                'label' => 'Oleh',
                'searchable' => false,
                'sortable' => true,
                'className' => 'one wide column center aligned'
            ],
            [
                'data' => 'action',
                'name' => 'action',
                'label' => 'Aksi',
                'searchable' => false,
                'sortable' => false,
                'className' => "two wide column center aligned",
            ]
        ]);

        // $this->pushBreadcrumb(['List Pelayanan' => '#']);
        return $this->render('backend.layanan.layanan.index', [
            'data' => Layanan::orderBy('posisi')->get(),
            'mockup' => false
        ]);
    }

    public function grid(Request $request)
    {
        $records = Layanan::with('creator')
                           ->select('*');
        //Init Sort
        if (!isset(request()->order[0]['column'])) {
            // $records->->sort();
            $records->orderBy('posisi', 'asc');
        }
        
        //Filters
        if ($judul = $request->judul) {
            $records->where('judul', 'ILIKE', '%' . $judul . '%');
        }
        if ($layanan = $request->layanan) {
            $records->where('layanan_unggulan', $layanan);
        }

        return Datatables::of($records)
            ->addColumn('num', function ($record) use ($request) {
                return $request->get('start');
            })
            ->addColumn('keterangan', function ($record) {
                $string ='<span class="ccount more" data-ccount="118">'.strip_tags($record->keterangan).'</span>';
                return $string;
            })
            ->addColumn('created_at', function ($record) {
                return $record->created_at->format('d F Y');
            })
            ->addColumn('created_by', function ($record) {
                return $record->creator->name;
            })
            ->addColumn('status', function ($record) {
                $str = '';
                if($record->layanan_unggulan == 1){
                    $str = '<span class="ui orange label">Unggulan</span>';
                }else{
                    $str = '<span class="ui green label">Umum</span>';
                }
                return $str;
            })
            ->editColumn('home', function ($record) {
                return $record->home 
                     ? '<span class="ui green label">Tampil</span>'
                     : '<span class="ui red label">Tidak</span>';
            })

            ->addColumn('action', function ($record) {
                $btn = '';
                //Edit
                $btn .= $this->makeButton([
                    'type' => 'url',
                    'class' => 'orange icon',
                    'label' => '<i class="edit icon"></i>',
                    'target' => url($this->link.$record->id.'/edit')
                ]);
                // Delete
                $btn .= $this->makeButton([
                    'type' => 'delete',
                    'id'   => $record->id
                ]);

                return $btn;
            })
            ->rawColumns(['konten','keterangan','status','action','download', 'home'])
            ->make(true);
    }

    

    public function create()
    {
        $this->setTitle('Tambah Pelayanan');
        $this->pushBreadcrumb(['Tambah Pelayanan' => '#']);
        return $this->render('backend.layanan.layanan.create');
    }

    public function store(LayananRequest $request)
    {
        $row = $request->all();
        if($request->hasFile('photo')){
            $path = $request->file('photo')->store('uploads/layanan/layanan', 'public');
            $row['photo'] = $path;
        }
        if($request->hasFile('icon')){
            $path = $request->file('icon')->store('uploads/layanan/layanan/icon', 'public');
            $row['icon'] = $path;
        }
        if($request->hasFile('files')){
            $path = $request->file('files')->store('uploads/layanan/layanan/pdf', 'public');
            $row['files'] = $path;
        }
        $data = new Layanan;
        $data->fill($row);
        $data->save();
        
        return redirect($this->link);
        return response([
            'status' => true,
            'data'  => $data
        ]);
    }

    public function show($id)
    {
        return Layanan::find($id);
    }

    public function edit($id)
    {
        $this->setTitle('Ubah Pelayanan');
        $this->pushBreadcrumb(['Ubah Pelayanan' => '#']);
        $record = Layanan::find($id);

        return $this->render('backend.layanan.layanan.edit', ['record' => $record]);
    }

    public function update(LayananRequest $request, $id)
    {
        $row = $request->all();
        
        $data = Layanan::find($id);

        $row['photo'] = $data->photo;
        $row['files'] = $data->files;

        if($request->hasFile('icon')){
            $path = $request->file('icon')->store('uploads/layanan/layanan/icon', 'public');
            $row['icon'] = $path;
        }
        if($request->hasFile('photo')){
            $path = $request->file('photo')->store('uploads/layanan/layanan', 'public');
            $row['photo'] = $path;
        }
        if($request->hasFile('files')){
            $path = $request->file('files')->store('uploads/layanan/layanan/pdf', 'public');
            $row['files'] = $path;
        }

        $data->fill($row);
        $data->save();
        
        return redirect($this->link);
        
        return response([
            'status' => true,
            'data'  => $data
        ]);
    }
    public function removeImage($id)
    {
        $data = Layanan::find($id);
        Storage::delete($data->photo);
        $data->photo = null;
        $data->save();
        
        return response([
            'status' => true,
            'data'  => $data
        ]);
    }

    public function destroy($id)
    {
        $jenis = Layanan::find($id);
        $jenis->delete();

        return response([
            'status' => true,
        ]);
    }

    public function downloadFile($id)
    {
        $data = Layanan::where('id',$id)->first();
        $files = [];
        if($data->count() > 0)
        {
            if(file_exists(public_path('storage/'.$data->files)))
            {
                $files[] = public_path('storage/'.$data->files);
            }

            if(file_exists(public_path('storage/'.$data->files)))
            {
               return response()->download(public_path('storage/'.$data->files));
            }
           return $this->render('failed.file');
         }
         return $this->render('failed.file');
    }

    public function sort(Request $request)
    {
        if($request->sorting){
            foreach ($request->sorting as $position => $id) {
                $profil = Layanan::find($id);
                $profil->posisi = $position;
                $profil->save();
            }
                
            return response([
                'status' => true,
            ]);
        }

        return response([
            'status' => false,
        ], 422);
    }
}
