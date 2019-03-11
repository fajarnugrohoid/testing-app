<script type="text/javascript">

	function saveData(formid) {
		// show loading
		$('#' + formid).find('.loading.dimmer').addClass('active');

		// begin submit
		$("#" + formid).ajaxSubmit({
			success: function(resp){
				console.log('save...' + resp);
				swal({

					title:'Tersimpan!',
					text:'Data berhasil disimpan.',
					type:'success',
					allowOutsideClick: false,
					// showCancelButton: true,

					confirmButtonColor: '#0052DC',
					confirmButtonText: 'Tutup',
					
					cancelButtonColor: '#6E6E6E',
					cancelButtonText: 'Print'
				}).then((result) => { // ok
					location.href = '{{ url('/') }}';
					console.log('result...' + result);
				}, function(dismiss) { // cancel
					if (dismiss === 'cancel') { // you might also handle 'close' or 'timer' if you used those
						// getNewTab('{{ url('print') }}/' + resp.registration);

						// location.href = '{{ url('/') }}';
					} else {
						throw dismiss;
					}
				})
			},
			error: function(resp){
				$('#' + formid).find('.loading.dimmer').removeClass('active');
				var error = $('<ul class="list"></ul>');
				$.each(resp.responseJSON.errors, function(index, val) {
					error.append('<li>'+val+'</li>');
				});
				$('#' + formid).find('.ui.error.message').html(error).show();	
			}
		});
	}

	function deleteData(url) {
		swal({
			title: 'Nomor ID ',
			text: "Apakah akan menghapus data tersebut?",
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			confirmButtonText: 'Ya',
			cancelButtonColor: '#d33',
			cancelButtonText: 'Tidak',
			reverseButtons: true,
		}).then((result) => {
			if (result) {

				$.ajax({
					url: url,
					type: 'POST',
					dataType: 'json',
					data: {
						'_method' : 'DELETE'
					}
				})
				.done(function(response) {
					swal({
				    	title: 'Data Berhasil Dihapus',
						text: " ",
						type: 'success',
						allowOutsideClick: false
				    }).then((res) => {
				    	dt.draw('page');
				    })
				})
				.fail(function(response) {
					swal({
				    	title: 'Data Gagal Dihapus',
						text: " ",
						type: 'error',
						allowOutsideClick: false
				    }).then((res) => {

				    })
				})

			}
		})
	}

	function loadModal(param) {
		var url    = (typeof param['url'] === 'undefined') ? '#' : param['url'];
		var modal  = (typeof param['modal'] === 'undefined') ? 'formModal' : param['modal'];
		var formId = (typeof param['formId'] === 'undefined') ? 'formData' : param['formId'];
		var onShow = (typeof param['onShow'] === 'undefined') ? function(){} : param['onShow'];
		var onSuccess = (typeof param['onSuccess'] === 'undefined') ? function(){ dt.draw('page'); } : param['onSuccess'];

		$(modal).modal({
			bottom: 'auto',
			inverted: true,
			observeChanges: true,
			closable: false,
			detachable: false, 
			autofocus: false,
			onApprove : function() {
				$(formId).form('validate form');
				if($(formId).form('is valid')){
					$(modal).find('.loading.dimmer').addClass('active');
					$(formId).ajaxSubmit({
						success: function(resp){
							$(modal).modal('hide');
							swal(
							'Tersimpan!',
							'Data berhasil disimpan.',
							'success'
							).then((result) => {
								onSuccess(resp);
								return true;
							})
						},
						error: function(resp){
							$(modal).find('.loading.dimmer').removeClass('active');
							var error = $('<ul class="list"></ul>');

							$.each(resp.responseJSON.errors, function(index, val) {
								error.append('<li>'+val+'</li>');
							});

							if(resp.responseJSON.status=='errors'){
								error.append('<li>'+resp.responseJSON.message+'</li>');
							}

							$(modal).find('.ui.error.message').html(error).show();
						}
					});	
				}
				return false;
			},
			onShow: function(){
				$(modal).find('.loading.dimmer').addClass('active');
				$.get(url, { _token: "{{ csrf_token() }}" } )
				.done(function( response ) {
					$(modal).html(response);
					// execute script
					onShow();
				});
			},
			onHidden: function(){
				$(modal).html(`<div class="ui inverted loading dimmer">
										<div class="ui text loader">Loading</div>
									</div>`);
			}
		}).modal('show');
	}

	function postNewTab(url, param){
        var form = document.createElement("form");
        form.setAttribute("method", 'POST');
        form.setAttribute("action", url);
        form.setAttribute("target", "_blank");

        $.each(param, function(key, val) {
            var inputan = document.createElement("input");
                inputan.setAttribute("type", "hidden");
                inputan.setAttribute("name", key);
                inputan.setAttribute("value", val);
            form.appendChild(inputan);
        });

        document.body.appendChild(form);
        form.submit();

        document.body.removeChild(form);
    }

    function getNewTab(url){
        var win = window.open(url, '_blank');
  		win.focus();
    }

    function setExecutionStatus(id, status){
        console.log("setExecutionStatus:" + id + "-" + status);
        $.ajax({
        	url: "testcase/update", 
        	type: "post",
        	data: {
                id: id,
                status:status
            },
        	success: function(result){
	    		console.log("result:" + result);
	  		}});
    }

    viewTestCase = function(elm, id) // id detail
    {
    	/*$('.special.modal')
		  .modal({
		    centered: false
		  })
		  .modal('show'); */

        loadModal({
            url : '{{ url('testcase/view') }}/' + id,
            modal : '.large.modal',
            formId : '#form-view-testcase',
            onShow : function(){
                $('.ui.checkbox').checkbox();
            },
            onSuccess : function(response){
                var tr = $(elm).closest('tr')
                
                $(tr).find('.status').html('<span class="ui red label">Ditolak</span>');
                // $(tr).find('.aksi').html('');
            },
        });
    }

</script>