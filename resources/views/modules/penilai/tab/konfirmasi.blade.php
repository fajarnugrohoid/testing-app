<div class="ui centered grid">
    <div class="eight wide column main-content">
        <div class="ui error message" style="margin:0px !important;"></div>
        <div class="ui info message">
            <div class="ui checkbox konfirmasi">
                <input type="checkbox" name="check">
                <label>Data yang dimasukan sudah sesuai dengan dokumen.</label>
            </div>
        </div>
    </div>
</div>

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            
            $('.ui.checkbox.konfirmasi').checkbox({
                onChange: function() {
                    // console.log($('.ui.checkbox.konfirmasi').checkbox('is checked'))
                    if ($('.ui.checkbox.konfirmasi').checkbox('is checked')) {
                        $('.button.save').removeClass('disabled')
                    } else {
                        $('.button.save').addClass('disabled')
                    }
                }
            });

        }); 
    </script>
@append