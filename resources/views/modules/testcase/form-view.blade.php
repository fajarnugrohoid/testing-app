<script type="text/javascript">
    $(document).ready(function() {
        $('#progress_bar_step_condition').progress();
    });
</script>

<div class="ui inverted loading dimmer">
    <div class="ui text loader">Loading</div>
</div>
<div class="header">Result Test Case</div>
<div class="content">
    <form class="ui data form" id="form-view-testcase" action="{{ url('penilai/proses-tolak') }}" method="POST">
        <div class="ui error message"></div>
        <div class="ui segment">
            <div class="fields">
                <div class="eight wide field">
                    <label for="">Project</label>
                    <div class="ui small input">
                        {!! 
                            \App\Models\Projects::readonly('project_name', 'id', [
                                'selected' => isset($records->project_id) ? $records->project_id : '',
                            ])
                        !!}
                    </div>
                </div>
                <div class="eight wide field">
                    <label for="">Title</label>
                    <div class="ui small input">
                        @if(isset($records->title))
                            {{ $records->title }}
                        @endif
                    </div>
                </div>
                
            </div>
            <div class="fields">
                <div class="eight wide field">
                    <label for="">Severity</label>
                    <div class="ui small input">
                            {!! 
                                 \App\Models\Master\Severity::readonly('severity_name', 'id', [
                                    'selected' => isset($records->severity) ? $records->severity : '',
                                ])
                            !!}
                    </div>
                </div>
                <div class="eight wide field">
                    <label for="">Type Test</label>
                    <div class="ui small input">
                            {!! 
                                 \App\Models\Master\TypeTest::readonly('name', 'id', [
                                    'selected' => isset($records->type_test) ? $records->type_test : '',
                                ])
                            !!}
                    </div>
                </div>
                
            </div>

            <div class="fields">
                <div class="eight wide field">
                    <label for="">Version</label>
                    <div class="ui small input">
                        {{ $records->version }}
                    </div>
                </div>
                
            </div>
            <div class="fields">
                <div class="thirteen wide field">
                    <label for="">Pre Conditions</label>
                    <div class="ui small input">
                        @if(isset($records->pre_condition))
                            {{ $records->pre_condition }}
                        @endif
                    </div>
                </div>
                <div class="thirteen wide field">
                    <label for="">Description</label>
                    <div class="ui small input">
                        @if(isset($records->description))
                            {{ $records->description }}
                        @endif
                    </div>
                </div>
            </div>

            <div class="fields">
                <div class="sixteen wide field">
                    <table class="ui celled table">
                        <thead>
                            <tr>
                                <th width="10%">Step No</th>
                                <th>What To Do</th>
                                <th>Expected Result</th>
                                <th>Explanation</th>
                                <th width="20%">Status</th>
                            </tr>
                        </thead>
                        <tbody id="step_tbody">
                            @if(isset($records->step_condition))
                                @foreach($records->step_condition as $row)
                                <tr>
                                    <td>
                                        {{$row->step_no}}
                                    </td>
                                    <td>
                                        {{$row->what_to_do}}
                                    </td>
                                    <td>
                                        {{$row->expected_result}}
                                    </td>
                                    <td>
                                        {{$row->explanation}}
                                    </td>
                                    <td>
                                        @if($row->step_condition=='1')
                                            Pass
                                        @else
                                            Fail
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            @endif
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="4">Step Condition : {{$step_condition_count}}</td>
                                <td>
                                    Pass : {{$pass_count}} - 
                                    Fail : {{$fail_count}}
                                </td>
                            </tr>
                            
                        </tfoot>
                    </table>
                </div>
            </div>{{--fields--}}

            <div class="ui teal progress" data-percent="{{$pass_presentase}}" id="progress_bar_step_condition">
                <div class="bar"></div>
                <div class="label">
                    {{$pass_presentase}}% Step Condition
                </div>
            </div>

        </div>{{--ui segment--}}
    </form>
</div>
<div class="actions">
    <div class="ui black deny button">
        Close
    </div>
</div>