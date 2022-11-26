<?php

defined('BASEPATH') or exit('No direct script access allowed');

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Aturan Certainly Factor
            <small>Aturan Certainly Factor</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Aturan Certainly Factor</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <!-- Default box -->
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Aturan Certainly Factor</h3>
                    </div>
                    <div class="box-body">
                        <form method="post" enctype="multipart/form-data" action="#">
                            <div class="form-group">
                                <!-- <label for="penyakit">Peny</label> -->
                                <select class="form-control rounded-0 select2" name="penyakit" id="penyakit" style="width: 100%;" data-placeholder="--PILIH PENYAKIT--">
                                    <option></option>
                                    <?php foreach ($penyakit as $key => $value) {

                                    ?>
                                        <option value="<?php echo $value['id_ms_penyakit']; ?>" action="<?php echo $action . "/" . $value['id_ms_penyakit']; ?>"><?php echo "[ " . $value['kode_penyakit'] . " ] " . $value['nama_penyakit']; ?></option>
                                    <?php   } ?>
                                </select>
                            </div>
                        </form>
                        <div id="cf">

                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>

<script>
    let _url;
    $('#penyakit').select2();
    $('#penyakit').on('change', function() {
        _url = $('#penyakit').find(':selected').attr('action');
        send((data, xhr = null) => {
            if (data.status == 200) {
                $('#cf').html(data.html);
            } else {
                FailedNotif("Gagal mendapatkan respon");
            }
        }, _url, 'json', 'get');

    });
    $(document).on('submit', 'form#mb_md_set', function() {
        event.preventDefault();
        let _urlSend = $(this).attr('action');
        let _data = new FormData($(this)[0]);
        send((data, xhr = null) => {
            if (data.status == 422) {
                FailedNotif(data.messages);
            } else if (data.status == 200) {
                SuccessNotif(data.messages);
                $('#cf').html("");
                send((data, xhr = null) => {
                    if (data.status == 200) {
                        $('#cf').html(data.html);
                    } else {
                        FailedNotif("Gagal mendapatkan respon");
                    }
                }, _url, 'json', 'get');
            }
        }, _urlSend, 'json', 'post', _data);
    });
</script>