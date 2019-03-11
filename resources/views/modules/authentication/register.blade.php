@extends('layouts.register')

@section('style')
<style>
.content {
    max-width: 960px;
}
.ui.dropdown, .ui.calendar, .ui.selection.multiple {
    width: 100%
}
.ui.file.input input[type="file"] {
    display: none;
}
</style>
@append
@section('content')
<div class="ui center aligned middle aligned grid container">
    <div class="sixteen wide column content">
        {{-- @if (count($errors) > 0) --}}
        <div class="ui negative message" style="display: none;">
            <i class="close icon"></i>
            <div class="header">
                <strong>Mohon Maaf, </strong>Terjadi Kesalahan<br>
            </div>
            <ul>
                {{-- @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach --}}
            </ul>
        </div>
        {{-- @endif --}}

        <form class="ui large form" id="dataForm" role="form" method="POST" action="{{ url('/register') }}" enctype="multipart/form-data">
            {!! csrf_field() !!}
            <div class="ui top attached segment">

                <div class="ui grid">
                    <div class="sixteen wide tablet eight wide computer column">
                        {{-- <div class="ui blue ribbon label"> --}}
                            <h4 class="ui horizontal divider header">
                                <i class="user icon"></i>
                                Account Detail
                            </h4>
                        {{-- </div> --}}
                        <div class="two fields">
                            <div class="five wide field">
                                <label for="nama" style="text-align: left;">Username</label>
                            </div>
                            <div class="eleven wide field">
                                <div class="ui left icon input">
                                    <i class="user icon"></i>
                                    <input type="text"  placeholder="Username" name="username" value="{{ old('username') }}">
                                </div>
                            </div>
                        </div>
                        <div class="two fields">
                            <div class="five wide field">
                                <label for="nama" style="text-align: left;">Password</label>
                            </div>
                            <div class="eleven wide field">
                                <div class="ui left icon input">
                                    <i class="lock icon"></i>
                                    <input type="password" name="password" placeholder="Password">
                                </div>
                            </div>
                        </div>
                        <div class="two fields">
                            <div class="five wide field">
                                <label for="nama" style="text-align: left;">Confirm Password</label>
                            </div>
                            <div class="eleven wide field">
                                <div class="ui left icon input">
                                    <i class="unlock alternate icon"></i>
                                    <input type="password" name="password_confirmation" placeholder="Confirm Password">
                                </div>
                            </div>
                        </div>
                        <h4 class="ui horizontal divider header">
                            <i class="address book icon"></i>
                            Profile Detail
                        </h4>
                        <div class="two fields">
                            <div class="five wide field">
                                <label for="nama" style="text-align: left;">NIK</label>
                            </div>
                            <div class="eleven wide field">
                                <div class="ui left icon input">
                                    <i class="address card icon"></i>
                                    <input type="text" name="nik" placeholder="NIK">
                                </div>
                            </div>
                        </div>
                        <div class="two fields">
                            <div class="five wide field">
                                <label for="nama" style="text-align: left;">Nama</label>
                            </div>
                            <div class="eleven wide field">
                                {{-- <div class="two fields">
                                    <div class="field">
                                        <input type="text"  placeholder="First Name" name="first_name" value="{{ old('first_name') }}">
                                    </div>
                                    <div class="field">
                                        <input type="text"  placeholder="Last Name" name="last_name" value="{{ old('last_name') }}">
                                    </div>
                                </div> --}}
                                <div class="field">
                                    <input type="text"  placeholder="Full Name" name="nama" value="{{ old('nama') }}">
                                </div>
                            </div>
                        </div>
                        <div class="two fields">
                            <div class="five wide field">
                                <label for="nama" style="text-align: left;">Alamat Email</label>
                            </div>
                            <div class="eleven wide field">
                                <div class="ui left icon input">
                                    <i class="mail card icon"></i>
                                    <input type="email" name="email" placeholder="Email Address" value="{{ old('email') }}">
                                </div>
                            </div>
                        </div>
                        <div class="two fields">
                            <div class="five wide field">
                                <label for="nama" style="text-align: left;">Tanggal Lahir</label>
                            </div>
                            <div class="eleven wide field">
                                <div class="ui calendar" id="example2">
                                    <div class="ui input left icon">
                                        <i class="calendar icon"></i>
                                        <input type="text" placeholder="dd/mm/yyyy" name="birth_date" value="{{ old('birth_date') }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="two fields">
                            <div class="five wide field">
                                <label for="nama" style="text-align: left;">Tempat Lahir</label>
                            </div>
                            <div class="eleven wide field">
                                <div class="field">
                                    <input type="text" name="tmp_lahir" placeholder="Tempat Lahir" value="{{ old('tmp_lahir') }}">
                                </div>
                            </div>
                        </div>
                        {{-- <div class="two fields">
                            <div class="five wide field">
                                <label for="nama" style="text-align: left;">Photo</label>
                            </div>
                            <div class="eleven wide field">
                                <div class="field image-container">
                                  <div class="ui fluid file input action">
                                    <input type="text" readonly="">
                                    <input type="file" class="ten wide column" name="photo" autocomplete="off">
                                    <div class="ui blue button file">
                                      Cari...
                                    </div>
                                  </div>
                                </div>
                            </div>
                        </div> --}}
                        
                    </div>

                    <div class="sixteen wide tablet eight wide computer column">
                        
                        <div class="ui divider"></div>
                        <div class="two fields">
                            <div class="five wide field">
                                <label for="jabatan" style="text-align: left;">Jabatan</label>
                            </div>
                            <div class="eleven wide field">
                                <div class="ui left icon input">
                                    <i class="industry icon"></i>
                                    <select name="gender" class="ui dropdown" placeholder="Jenis Kelamin">
                                        <option value=""> </option>
                                        <option value="admin">Administrator</option>
                                        <option value="programmer">Programmer</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="two fields">
                            <div class="five wide field">
                                <label for="nama" style="text-align: left;">Jenis Kelamin</label>
                            </div>
                            <div class="eleven wide field">
                                <div class="ui left icon input">
                                    <i class="industry icon"></i>
                                    <select name="gender" class="ui dropdown" placeholder="Jenis Kelamin">
                                        <option value=""> </option>
                                        <option value="L">Laki - Laki</option>
                                        <option value="P">Perempuan</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="two fields">
                            <div class="five wide field">
                                <label for="nama" style="text-align: left;">No. Telepon</label>
                            </div>
                            <div class="eleven wide field">
                                <div class="ui left icon input">
                                    <i class="home icon"></i>
                                    <input type="text" name="phone" placeholder="Phone Number" value="{{ old('phone') }}">
                                </div>
                                <span id="tampil-alert-phone"></span>

                            </div>
                        </div>
                        <div class="two fields">
                            <div class="five wide field">
                                <label for="nama" style="text-align: left;">NPWP</label>
                            </div>
                            <div class="eleven wide field">
                                <div class="field">
                                    <input type="text" name="npwp" placeholder="No. NPWP" value="{{ old('npwp') }}" >
                                </div>
                                <span id="tampil-alert-npwp"></span>

                            </div>
                        </div>
                        <div class="two fields">
                            <div class="five wide field">
                                <label for="nama" style="text-align: left;">No. Rekening</label>
                            </div>
                            <div class="eleven wide field">
                                <div class="field">
                                    <input type="text" name="no_rekening" placeholder="No. Rekening" value="{{ old('no_rekening') }}" >
                                </div>
                                <span id="tampil-alert-no_rekening"></span>

                            </div>
                        </div>
                        <div class="two fields">
                            <div class="five wide field">
                                <label for="nama" style="text-align: left;">Atas Nama</label>
                            </div>
                            <div class="eleven wide field">
                                <div class="field">
                                    <input type="text" name="atas_nama" placeholder="A/n" value="{{ old('atas_nama') }}" >
                                </div>
                                <span id="tampil-alert-atas_nama"></span>

                            </div>
                        </div>
                        <div class="two fields">
                            <div class="five wide field">
                                <label for="nama" style="text-align: left;">Tanggal Masuk</label>
                            </div>
                            <div class="eleven wide field">
                                <div class="ui calendar" id="example2">
                                    <div class="ui input left icon">
                                        <i class="calendar icon"></i>
                                        <input type="text" placeholder="dd/mm/yyyy" name="tgl_masuk" value="{{ old('tgl_masuk') }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="two fields">
                            <div class="five wide field">
                                <label for="nama" style="text-align: left;">Status</label>
                            </div>
                            <div class="eleven wide field">
                                <div class="field">
                                    <input type="text" name="status" placeholder="Status" value="{{ old('status') }}" >
                                </div>
                                <span id="tampil-alert-status"></span>

                            </div>
                        </div>
                    </div>
                </div>
                {{-- <div class="ui vertical divider"></div>  --}}
            </div>

            <div class="ui bottom attached segment">
                <button type="button" class="ui fluid large blue entry button" >Register</button>
                <div class="ui divider"></div>
                <div class="center aligned" style="text-align: center">
                    <span>Sudah Memiliki Akun? <a href="{{ url('/login') }}">Login</a></span>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
    $('#terms').on('change', function(){
        if(this.checked){
            $('.blue.entry.button').removeAttr('disabled');
        }else{
            $('.blue.entry.button').attr('disabled','disabled');
        }
    });

    $('select[name=district]').on('change', function(){
        $.ajax({
            url: '{{ url('ajax/option/city') }}',
            type: 'POST',
            data: {
                province: this.value
            },
        })
        .done(function(response) {
            $('select[name=city]').html(response)
        })
        .fail(function() {
            console.log("error");
        })
        .always(function() {
            console.log("complete");
        });
    })

    $(document).on('input', 'input[name="identity_number"]', function(e){
        var x = `<div class="ui basic red pointing prompt label transition visible">Panjang Nomor harus 16</div>`;
        var d = `<div class="ui basic red pointing prompt label transition visible"> Karakter harus number</div>`;
        if ($.isNumeric(this.value))
        {
            if (this.value.length != 11) {

                $('#tampil-alert-identity_number').html(x);

            }else{
                $('#tampil-alert-identity_number').html('');
            }
        }else{
                $('#tampil-alert-identity_number').html(d);
        }
    })

    $(document).on('input', 'input[name="phone"]', function(e){
        var x = `<div class="ui basic red pointing prompt label transition visible">Panjang Number harus benar </div>`;
        var d = `<div class="ui basic red pointing prompt label transition visible"> Karakter harus number</div>`;
        if ($.isNumeric(this.value))
        {
            if (this.value.length != 10) {

                $('#tampil-alert-phone').html(x);

            }else{
                $('#tampil-alert-phone').html('');
            }
        }else{
                $('#tampil-alert-phone').html(d);
        }
    })

    $(document).on('click', '.ui.file.input input:text, .ui.button', function (e) {
        $(e.target).parent().find('input:file').click();
    });

    $(document).on('change', '.ui.file.input input:file', function (e) {
        var file = $(e.target);
        var name = '';

        for (var i = 0; i < e.target.files.length; i++) {
            name += e.target.files[i].name + ', ';
        }
        // remove trailing ","
        name = name.replace(/,\s*$/, '');
        console.log(name);

        $('input:text', file.parent()).val(name);
    });

    $('.table.fasilitas').on('click', '.modal-add', function(event) {
        event.preventDefault();
        table = $(this).closest('tbody tr:last-child')
        $('.table.fasilitas').append("<tr>" +
          "<td class='collapsing'><button type='button' data-content='Hapus Data' class='ui mini red icon modal-delete button'><i class='trash icon'></i></button></td>" +
          '<td><select name="id_organization_type[]" class="ui dropdown"></select></td>'+
          "<td><div class='field image-container fasilitas'><div class='ui fluid file input action'><input type='text' readonly=''><input type='file' class='ten wide column' name='attach[]' autocomplete='off'><div class='ui blue button file'>Cari...</div></div></div></td>" +
          "</tr>");
    })

    $('.table.fasilitas').on('click', '.modal-delete', function(event) {
        event.preventDefault();
        table = $(this).closest('tr')
        table.remove()
    })

    $('.blue.entry.button').on('click',function(event) {
        swal({
            title: 'Simpan Data?',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Simpan',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result) {
                $("#dataForm").ajaxSubmit({
                    success: function(resp){
                        location.href = '{{ url('/login') }}'
                    },
                    error: function(resp){
                        $('.ui.negative.message').css('display', '')
                        $.each(resp.responseJSON, function(index, val) {
                            $('.ui.negative.message').find('ul').append('<li>'+val+'</li>');
                        });
                    }
                });
            }
        })
    });
</script>
@append
