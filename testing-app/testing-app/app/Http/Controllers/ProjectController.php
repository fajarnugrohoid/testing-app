<?php

namespace App\Http\Controllers;

// base
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

// models
use App\Models\Projects;

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


class ProjectController extends Controller
{
    //
    protected $link = 'project/';
    protected $perms  = '';

	function __construct()
	{
		$this->setLink($this->link);
    }

    public function index()
    {
        $this->setTitle("List Project");
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
                'data' => 'project_name',
                'name' => 'project_name',
                'label' => 'Project Name',
                'searchable' => false,
                'sortable' => true,
                'className' => "center aligned",
            ],
            [
                'data' => 'start_project',
                'name' => 'start_project',
                'label' => 'Start Project',
                'searchable' => false,
                'sortable' => true,
                'className' => "center aligned",
            ],
            [
                'data' => 'end_project',
                'name' => 'end_project',
                'label' => 'End Project',
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
        
        return $this->render('modules.project.list-project', ['mockup' => false]);
    }

    public function grid(Request $request)
    {
        // dd($date);
        //$records = Project::orderBy('id','desc')->get();
         //$records = Dupak::orderBy('id','desc')->get();

        $records = Projects::all()->sortBy("id");

        // base filter
        $records->where('user_id', \Auth::user()->id);

        // filter from request
        // codenya...

        // sorting
        // if (!isset(request()->order[0]['column'])) {
        //     $records->orderBy('created_at', 'desc');
        // }

        return DataTables::of($records)
            ->addColumn('num', function ($record) use ($request) {
                return $request->get('start');
            })
            ->addColumn('project_name', function ($record) {
                return $record->project_name;
            })
            ->addColumn('start_project', function ($record) {
                return Carbon::parse($record->start_project)->format('d/m/Y');
            })
            ->addColumn('end_project', function ($record) {
                return Carbon::parse($record->end_project)->format('d/m/Y');
            })
            ->addColumn('action', function ($record) {
                $btn = '';
                $btn .= $this->makeButton([
                    'type'    => 'url',
                    'class'   => 'green',
                    'tooltip' => 'Test Case',
                    'label'   => 'Proses',
                    'url'     => url('testcase/grid/' . Helper::encrypt($record->id)),
                ]);
                return $btn;
            })
            ->make(true);
    }

    public function create($id ='')
    {
        $this->setTitle("Create Project");
        /*
        $dupak  = Dupak::where('user_id', Auth::user()->id)->whereIn('status', [0,1])->get();
        if(count($dupak)>0){              
            return $this->dashboard();
        }else{
            return $this->render('modules.guru.form-create', [
                'biodata'    => \Auth::user()->biodata,
                'prajabatan' => AngkaKredit::find(4),
            ]); 
        } */
        return $this->render('modules.project.form-create', []); 
        
    }

}
