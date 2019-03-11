<?php

namespace App\Http\Controllers;

// base
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

// models
use App\Models\Testcases;
use App\Models\StepConditions;

use App\Models\Master\Biodata;
use App\Models\Master\Unsur;
use App\Models\Master\SubUnsur;
use App\Models\Master\AngkaKredit;
use App\Models\Transaction\Dupak;
use App\Models\Transaction\DupakDetail;

// validation request
use App\Http\Requests\Testcase\TestcaseRequest;

// libraries
use Carbon;
use DataTables;
use Helpers;
use Helper;
use Auth;
use PDF;


class TestcaseController extends Controller
{
    //
    protected $link = 'testcase/';
    protected $perms  = '';

	function __construct()
	{
		$this->setLink($this->link);
    }

    public function index()
    {
        $this->setTitle("List Test Case");
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
                'data' => 'project_id',
                'name' => 'project_id',
                'label' => 'Project ID',
                'searchable' => false,
                'sortable' => true,
                'className' => "center aligned",
            ],
            [
                'data' => 'title',
                'name' => 'title',
                'label' => 'Title',
                'searchable' => false,
                'sortable' => true,
                'className' => "center aligned",
            ],
            [
                'data' => 'severity',
                'name' => 'severity',
                'label' => 'Severity',
                'searchable' => false,
                'sortable' => true,
                'className' => "center aligned",
            ],
            [
                'data' => 'version',
                'name' => 'version',
                'label' => 'Version',
                'searchable' => false,
                'sortable' => true,
                'className' => "center aligned",
            ],
            [
                'data' => 'type_test',
                'name' => 'type_test',
                'label' => 'Type Test',
                'searchable' => false,
                'sortable' => true,
                'className' => "center aligned",
            ],
            [
                'data' => 'description',
                'name' => 'description',
                'label' => 'Description',
                'searchable' => false,
                'sortable' => true,
                'className' => "center aligned",
            ],
            [
                'data' => 'pre_condition',
                'name' => 'pre_condition',
                'label' => 'Pre Condition',
                'searchable' => false,
                'sortable' => true,
                'className' => "center aligned",
            ],
            [
                'data' => 'execution_status',
                'name' => 'execution_status',
                'label' => 'Execution Status',
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
        
        return $this->render('modules.testcase.list-testcase', ['mockup' => false]);
    }

    public function grid(Request $request)
    {
        // dd($date);
        //$records = Project::orderBy('id','desc')->get();
         //$records = Dupak::orderBy('id','desc')->get();

        $records = Testcases::all()->sortBy("id");

        // base filter
        //$records->where('user_id', \Auth::user()->id);

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
            ->addColumn('project_id', function ($record) {
                return $record->project_id;
            })
            ->addColumn('severity', function ($record) {
                return $record->severity;
            })
            ->addColumn('version', function ($record) {
                return $record->version;
            })
            ->addColumn('type_test', function ($record) {
                return $record->type_test;
            })
            ->addColumn('description', function ($record) {
                return $record->description;
            })
            ->addColumn('pre_condition', function ($record) {
                return $record->pre_condition;
            })
            ->addColumn('execution_status', function ($record) {
                $btn = '';
                if ($record->execution_status=='1'){
                    $btn_positive = '
                                    <button class="ui button positive">Yes</button>
                                    <button class="ui button" onclick=\'setExecutionStatus("' . $record->id . '","0")\'>No</button>
                                    ';
                }else{
                    $btn_positive = '
                                    <button class="ui button" onclick=\'setExecutionStatus("' . $record->id . '","1")\'>Yes</button>
                                    <button class="ui button positive">No</button>
                                    ';
                }
                $btn = '<div class="ui buttons">'. $btn_positive .'</div>';
                return $btn;
            })
            ->addColumn('action', function ($record) {
                $btn = '';
                $btn .= $this->makeButton([
                    'type'    => 'url',
                    'class'   => 'green',
                    'tooltip' => 'Test Case',
                    'label'   => 'Proses',
                    'url'     => url('testcase/' . Helper::encrypt($record->id)),
                ]);
                return $btn;
            })
            ->rawColumns(['execution_status','action'])
            ->make(true);
    }

    public function create($id ='')
    {
        $this->setTitle("Create Test Case");
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
        return $this->render('modules.testcase.form-create', []); 
        
    }

    public function store(TestcaseRequest $request)
    {
        $id = Helper::decrypt($request->id);
        //var_dump($request);
        // return response([
        //         'status' => 'success',
        //         'id' => $id,
        //         'msg' => $request->message,
        //         'biodata' => ['nama' => $request],
        //     ], 200);
        /* transaction db */
        \DB::beginTransaction();
        try {
            $data = $request->all();
            $response = array(
              'status' => 'success',
              'msg' => $data
            );

            $testcases  = new Testcases;
            $testcases->fill([
                'project_id'   => $data['project_id'],
                'title'   => $data['title'],
                'severity'  => $data['severity'],
                'version'     => $data['version'],
                'type_test'     => $data['type_test'],
                'description'         => $data['description'],
                'pre_condition' => $data['pre_condition'],
                'execution_status' => '0',
                'created_at'    => Carbon::now()
            ]);
            $testcases->save(); 

        
        
            /*for ($i=0; $i <count($data['step_no']) ; $i++) {
                $stepConditions = new StepConditions;
                $stepConditions->fill([
                    'test_case_id'   => '1',
                    'step_no'   => $data['step_no'][$i],
                    'what_to_do'   => $data['what_to_do'][$i],
                    'expected_result'   => $data['expected_result'][$i],
                    'created_at'    => Carbon::now()
                ]);
                $stepConditions->save();
            }*/
            # insert to detail
            for ($i=0; $i <count($data['step_no']) ; $i++) {
                $testcases->step_condition()->create([
                    'step_no'           => $data['step_no'][$i],
                    'what_to_do'        => $data['what_to_do'][$i],
                    'expected_result'   => $data['expected_result'][$i]
                ]);
            }

            \DB::commit();
            return response([
                'status'       => 'success',
                'data'         => $response,
                'count'        => count($data['step_no'])
            ], 200);

        } catch (\Exception $e) {
            \DB::rollback();

            return response([
                'errors'       => ['Beban server sedang tinggi, silakan ulangi lagi.', $e->getMessage()],
            ], 422);
        }

      //return response()->json($response); 

        /*
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
        ], 422); */
    }

     public function update(Request $request)
    {
        $this->setTitle("Test Case");
        \DB::beginTransaction();
        try {
            $id = $request->id;
            $data = $request->all();

            Testcases::where('id',$id)->update(array(
                         'execution_status'=>$request->status,
                         'updated_at'    => Carbon::now()
                     ));

            \DB::commit();

            return redirect($this->link);
            // return response([
            //         'status'       => 'success',
            //     ], 200);

        } catch (\Exception $e) {
            \DB::rollback();

            return response([
                'errors'       => ['Beban server sedang tinggi, silakan ulangi lagi.', $e->getMessage()],
            ], 422);
        }

        //return $this->render('modules.testcase.list-testcase', ['mockup' => false]);
    }


}
