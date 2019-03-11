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
	    Buat Dupak
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

@section('init-modal')
<script>
	$(document).ready(function() {
		$('.ui.month').calendar({
			type: 'month'
		});

		// $('.ui.add.button').on('click', function(event) {
		// 	event.preventDefault();
		// 	// /* Act on the event */
		// 	loadModal({
		// 		'url' : '{{ url($pageUrl) }}/create',
		// 		'modal' : '.large.modal',
		// 		'formId' : '#dataForm',
		// 		'onShow' : function(){ 
		// 			// console.log('fungsi dari script')
		// 			$('.ui.calendar').calendar(calendarOpts);
		// 		},
		// 	})
		// });
		$('.ui.add.button').on('click', function(event) {
			event.preventDefault();
			// /* Act on the event */
			location.href = '{{ url('guru/create') }}'
		});

		editModal = function(id){
			loadModal({
				'url' : '{{ url($pageUrl) }}/'+id+'/edit',
				'modal' : '.large.modal',
				'formId' : '#dataForm',
				'onShow' : function(){ 
					// console.log('fungsi dari script')
					$('.ui.calendar').calendar(calendarOpts);
				},
			})
		}

		confirm = function(id){
			swal({
			  title: 'Yakin akan mengirim data ?',
			  text: "Pastikan data ini sudah benar dan  tidak ada kesalahan!",
			  type: 'warning',
			  showCancelButton: true,
			  confirmButtonColor: '#3085d6',
			  cancelButtonColor: '#d33',
			  confirmButtonText: 'Kirim'
			}).then((result) => {
			  $.ajax({
			  	url: '{{ url($pageUrl) }}/confirm',
			  	type: 'POST',
			  	data: {id: id},
			  })
			  .done(function() {
				    swal(
				      'Terkirim !',
				      'Data berhasil di kirim.',
				      'success'
				    )
				    .then((result) => {
								dt.draw('page');
								return true;
					})
			  })
			  .fail(function() {
				    swal(
				      'Gagal !',
				      'Data gagal di kirim.',
				      'error'
				    )
			  })
			  .always(function() {
			  	console.log("complete");
			  });
			})
		}
	});

</script>
@endsection