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

		verifikasi = function(id, nama){
			swal({
				title:'Verifikasi!',
				text:'Apakah akan memverifikasi data atas nama ' + nama + '?',
				type:'info',
				allowOutsideClick: false,
				showCancelButton: true,

				confirmButtonColor: '#0052DC',
				confirmButtonText: 'Ya',
				
				cancelButtonColor: '#D91515',
				cancelButtonText: 'Tidak'
			}).then((result) => { // ok
				$.ajax({
					url: '{{ url($pageUrl) }}/verifikasi',
					type: 'POST',
					data: {id: id},
				})
				.done(function(response) {
					swal("Berhasil", "Data telah berhasil diverifikasi", "success")
					dt.draw('page');
				})
				.fail(function(response) {
					swal("Gagal", "Data gagal diverifikasi", "success")
				})
			}, function(dismiss) { // cancel
				if (dismiss === 'cancel') { // you might also handle 'close' or 'timer' if you used those

				} else {
					throw dismiss;
				}
			})
		}


	});
</script>
@endsection