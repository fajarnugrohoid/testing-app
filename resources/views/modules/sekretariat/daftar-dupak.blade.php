@extends('layouts.list')

@section('css')
	<link rel="stylesheet" type="text/css" href="{{ asset('plugins/summernote/summernote-lite.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/semanticui-calendar/calendar.min.css') }}">
@append

@section('js')
	<script src="{{ asset('plugins/summernote/summernote-lite.js') }}"></script>
    <script src="{{ asset('plugins/semanticui-calendar/calendar.min.js') }}"></script>
@append

@section('button_toolbar')
	<button type="button" class="ui blue add button">
	    <i class="plus icon"></i>
	    Set Penilai
	</button>
@endsection

@section('filters')
	
@endsection

@section('js-filters')
	d.judul = $("input[name='filter[judul]']").val();
@endsection

@section('rules')
<script type="text/javascript">
	formRules = {
		judul: 'empty',
		sub_judul: 'empty',
		url: 'url',
	};
</script>
@endsection

@section('scripts')
<script type="text/javascript">
	$(document).ready(function() {

		// init component
		$('.pilihan').dropdown({
            fullTextSearch : true,
        })
		
		// event
		$('.ui.add.button').on('click', function(){
			// ambil nilai checkbox
			var chk = [];
			$('.ui.checkbox.penilai').each(function(index, el) {
				if ($(el).checkbox('is checked')) {
					chk.push($(el).data('id'))
				}
			});

			// show modal
			$('.modal.penilai').modal({
				bottom: 'auto',
				inverted: true,
				observeChanges: true,
				closable: false,
				detachable: false, 
				autofocus: false,
				onApprove : function() {
					$('#form-penilai').ajaxSubmit({
						success: function(resp){
							$('.modal.penilai').modal('hide');
							swal(
							'Tersimpan!',
							'Data berhasil disimpan.',
							'success'
							).then((result) => {
								return true;
							})

							dt.draw('page');
						},
						error: function(resp){
							$('.modal.penilai').find('.loading.dimmer').removeClass('active');
							var error = $('<ul class="list"></ul>');

							$.each(resp.responseJSON.errors, function(index, val) {
								error.append('<li>'+val+'</li>');
							});

							if(resp.responseJSON.status=='errors'){
								error.append('<li>'+resp.responseJSON.message+'</li>');
							}

							$('.modal.penilai').find('.ui.error.message').html(error).show();
						}
					});

					return false;
				},
				onShow: function(){
					var str = JSON.stringify(chk)
					$('input[name=dupak_id]').val(str)
				},
				onHidden: function(){
					
				}
			}).modal('show');

		})

	});
</script>
@endsection

@section('init-modal')
<script>
	$(document).ready(function() {
		
	});
</script>
@endsection

@section('modals')
	<div class="ui small modal penilai">
        <div class="ui inverted loading dimmer">
            <div class="ui text loader">Loading</div>
        </div>
        <div class="header">Set Penilai</div>
		<div class="content">
		 	<form class="ui data form" id="form-penilai" action="{{ url('sekretariat/set-penilai') }}" method="POST">
		 		<input type="hidden" name="dupak_id">
				<div class="ui error message"></div>
				{!! csrf_field() !!}
				<div class="ui grid">
		            <div class="sixteen wide column">
		                <div class="ui form">
		                    <div class="fields">
		                        <div class="sixteen wide field">
		                            <label for="">Penilai</label>
		                            <div class="ui small input">
		                                <select name="penilai_id" class="ui fluid search selection dropdown pilihan">
		                                    @foreach($penilai as $row)
		                                    	<option value="{{ $row->id }}">{{ $row->nama }}</option>
		                                    @endforeach
		                                </select>
		                            </div>
		                        </div>
		                    </div>
		                </div>      
		            </div>      
		        </div>
			</form>
		</div>
		<div class="actions">
			<div class="ui black deny button">
				Tutup
			</div>
			<div class="ui positive right labeled icon button set-penilai">
				Set Penilai
				<i class="checkmark icon"></i>
			</div>
		</div>
    </div>
@append