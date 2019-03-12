<?php

namespace App\Http\Controllers;

// base
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

// models
use App\Models\Testcases;
use App\Models\StepConditions;
use App\Models\Projects;

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

    public function index(Request $r)
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
                'data' => 'project_name',
                'name' => 'project_name',
                'label' => 'Project Name',
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

        if($r->input('id')){
            return $this->showFormUpdate($r->input('id'));
        }else{
            return $this->render('modules.testcase.list-testcase', ['mockup' => false]);    
        }
        
        
    }

    public function show($id){

        // dd($date);
        //$records = Testcases::with('step_condition');

        // base filter
        //$records->where('id', $id);
        echo 'test';
        dd();
        $records = Testcases::all()->sortBy("id");

        

        $records = Testcases::with('step_condition')->find($id);
        //dd($records);

        //return $this->render('modules.penilai.form-tolak', ['detail'     => $detail,]);
        return $this->render('modules.testcase.form-create', ['status'=>'update', 'id'=>$id,'records'=>$records]); 
    }

    public function process($id){

        // dd($date);
        //$records = Testcases::with('step_condition');

        // base filter
        //$records->where('id', $id);
        
        $records = Testcases::all()->sortBy("id");

        $records = Testcases::with('step_condition')->find($id);
      
        return $this->render('modules.testcase.form-create', ['status'=>'process', 'id'=>$id,'records'=>$records]); 
    }

    public function edit($id){

        $records = Testcases::all()->sortBy("id");

        $records = Testcases::with('step_condition')->find($id);

        return $this->render('modules.testcase.form-create', ['status'=>'edit', 'id'=>$id,'records'=>$records]); 
    }

    public function grid(Request $request)
    {
        // dd($date);
        //$records = Project::orderBy('id','desc')->get();
         //$records = Dupak::orderBy('id','desc')->get();
        $records = Testcases::with('belongsToTestCases');

        //$records = Testcases::all()->sortBy("id");

        // base filter
        //$records->where('user_id', \Auth::user()->id);

        // filter from request
        // codenya...
        //dd($records);

        // sorting
        // if (!isset(request()->order[0]['column'])) {
        //     $records->orderBy('created_at', 'desc');
        // }

        return DataTables::of($records)
            ->addColumn('num', function ($record) use ($request) {
                return $request->get('start');
            })
            ->addColumn('project_name', function ($record) {
                return $record->belongsToTestCases->project_name;
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
                        'tooltip' => 'Edit Test Case',
                        'label'   => 'Edit',
                        'url'     => url('testcase/edit/' . $record->id),
                    ]);
                 $btn .= $this->makeButton([
                        'type'    => 'url',
                        'class'   => 'green',
                        'tooltip' => 'Process Test Case',
                        'label'   => 'Proses',
                        'url'     => url('testcase/process/' . $record->id),
                    ]);
                if ($record->execution_status=='1'){
                    $btn .= $this->makeButton([
                        'type'    => 'modal',
                        'class'   => 'blue',
                        'tooltip' => 'View Test Case',
                        'label'   => 'View',
                        'onClick' => 'viewTestCase(this, "'.$record->id.'")',
                        'url'     => '#',
                    ]);
                }
                return $btn;
            })
            ->rawColumns(['execution_status','action'])
            ->make(true);
    }

    public function create($id ='')
    {
        $this->setTitle("Create Test Case");
        /*for ($i=0;$i<10;$i++){
            echo 'i:'. $i++ . '<br/>';
        }

        for ($j=0;$j<10;$j++){
            echo 'j:'. ++$j . '<br/>';
        }

        dd(); */

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
        return $this->render('modules.testcase.form-create', ['status'=>'baru']); 
        
    }

    public function store(TestcaseRequest $request)
    {
        //$id = Helper::decrypt($request->id);
        $id = $request->id;
        //dd($request->all());
        /*return response([
                'status' => 'success',
                'id' => $id,
                'msg' => $request->all(),
            ], 200); */
        /* transaction db */
        if (isset($request->status) && ($request->status=='edit'))
        {

            \DB::beginTransaction();
            try {
                $data = $request->all();
                $response = array(
                  'status' => 'success',
                  'msg' => $data,
                  'data'=>$request
                );
                $testcases  = Testcases::find($id);
                $testcases->fill([
                    'project_id'        => $data['project_id'],
                    'title'             => $data['title'],
                    'severity'          => $data['severity'],
                    'version'           => $data['version'],
                    'type_test'         => $data['type_test'],
                    'description'       => $data['description'],
                    'pre_condition'     => $data['pre_condition'],
                    'execution_status'  => '1',
                    'created_at'        => Carbon::now()
                ]);
                $testcases->save();

                
                if (isset($data['step_condition_id']) && count($data['step_condition_id'])>0 ){
                    # update to detail
                    for ($i=0; $i <count($data['step_no']) ; $i++) {
                        
                        //dd();
                        $step_conditions = null;
                        if (array_key_exists($i, $data['step_condition_id'])==true){
                            $val_step_condition = $data['step_condition_id'][$i];
                            $step_conditions = StepConditions::find($val_step_condition);
                        }
                        
                        if ($step_conditions!=null){
                            $step_conditions->step_no = $data['step_no'][$i];
                            $step_conditions->what_to_do = $data['what_to_do'][$i];
                            $step_conditions->expected_result = $data['expected_result'][$i];
                            //$step_conditions->explanation = $data['explanation'][$i];
                            //$step_conditions->step_condition = $data['step_condition'][$i];
                            $step_conditions->explanation = '';
                            $step_conditions->step_condition = '0';
                            $step_conditions->save();
                        }else{
                            $testcases->step_condition()->create([
                                'step_no'           => $data['step_no'][$i],
                                'what_to_do'        => $data['what_to_do'][$i],
                                'expected_result'   => $data['expected_result'][$i],
                                'explanation'       => '',
                                'step_condition'    => '0'
                            ]);
                        }
                        
                    }
                }else{
                    # insert to detail
                    for ($i=0; $i <count($data['step_no']) ; $i++) {
                        $testcases->step_condition()->create([
                            'step_no'           => $data['step_no'][$i],
                            'what_to_do'        => $data['what_to_do'][$i],
                            'expected_result'   => $data['expected_result'][$i],
                            'explanation'       => '',
                            'step_condition'    => '0'
                        ]);
                    }
                }

                \DB::commit();
                return response([
                    'status'       => 'success',
                    'data'         => $response,
                    'count_step_no'        => count($data['step_no']),
                    'count_step_condition_id'        => count($data['step_condition_id']),
                ], 200);

            } catch (\Exception $e) {
                \DB::rollback();

                return response([
                    'errors'       => ['Beban server sedang tinggi, silakan ulangi lagi.', $e->getMessage()],
                ], 422);
            }
        }else if (isset($request->status) && ($request->status=='process')){
            \DB::beginTransaction();
            try {
                $data = $request->all();
                $response = array(
                  'status' => 'success',
                  'msg' => $data,
                  'data'=>$request
                );

                //dd($request->all());
                $testcases  = Testcases::find($id);
                $testcases->fill([
                    'project_id'   => $data['project_id'],
                    'title'   => $data['title'],
                    'severity'  => $data['severity'],
                    'version'     => $data['version'],
                    'type_test'     => $data['type_test'],
                    'description'         => $data['description'],
                    'pre_condition' => $data['pre_condition'],
                    'execution_status' => '1',
                    'created_at'    => Carbon::now()
                ]);
                $testcases->save();

               
                if (isset($data['step_condition_id']) && count($data['step_condition_id'])>0 ){
                    # update to detail
                    for ($i=0; $i <count($data['step_no']) ; $i++) {
                        /*$testcases->step_condition()->update([
                            'step_no'           => $data['step_no'][$i],
                            'what_to_do'        => $data['what_to_do'][$i],
                            'expected_result'   => $data['expected_result'][$i],
                            'explanation'       => $data['explanation'][$i],
                            'step_condition'    => $data['step_condition'][$i]
                        ]);*/
                        $step_conditions = StepConditions::find($data['step_condition_id'][$i]);

                        $step_conditions->step_no = $data['step_no'][$i];
                        $step_conditions->what_to_do = $data['what_to_do'][$i];
                        $step_conditions->expected_result = $data['expected_result'][$i];
                        $step_conditions->explanation = $data['explanation'][$i];
                        $step_conditions->step_condition = $data['step_condition'][$i];
                        // $testcases->step_condition()->save($step_conditions);
                        $step_conditions->save();
                    }
                }else{
                    # insert to detail
                    for ($i=0; $i <count($data['step_no']) ; $i++) {
                        $testcases->step_condition()->create([
                            'step_no'           => $data['step_no'][$i],
                            'what_to_do'        => $data['what_to_do'][$i],
                            'expected_result'   => $data['expected_result'][$i],
                            'explanation'       => '',
                            'step_condition'    => '0'
                        ]);
                    }
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
        }
        else{
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

                # insert to detail
                for ($i=0; $i <count($data['step_no']) ; $i++) {
                    $testcases->step_condition()->create([
                        'step_no'           => $data['step_no'][$i],
                        'what_to_do'        => $data['what_to_do'][$i],
                        'expected_result'   => $data['expected_result'][$i],
                        'explanation'       => '',
                        'step_condition'    => '0'
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
        }
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

    public function view($id){

        $records = Testcases::all()->sortBy("id");
        $records = Testcases::with('step_condition','belongsToTestCases')->find($id);
        $pass_count = 0;
        $fail_count = 0;
        $step_condition_count = count($records->step_condition);
        $pass_presentase = 0;
        foreach ($records->step_condition as $row) {
            if($row->step_condition=='1'){
                $pass_count++;
            }
        }
        $fail_count = $step_condition_count - $pass_count;
        $calculate_presentase = ($pass_count/$step_condition_count)*100;
        $pass_presentase = number_format((float)$calculate_presentase, 2, '.', '');

        return $this->render('modules.testcase.form-view', 
                                [
                                    'status'=>'view', 
                                    'id'=>$id,
                                    'records'=>$records,
                                    'pass_count'=>$pass_count,
                                    'fail_count'=>$fail_count,
                                    'step_condition_count'=>$step_condition_count,
                                    'pass_presentase'=>$pass_presentase,
                                ]
                            ); 
    }


}
