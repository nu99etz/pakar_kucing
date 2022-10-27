<?php

defined('BASEPATH') or exit('No direct script access allowed');

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Konsultasi
            <small>Konsultasi</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Konsultasi</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <?php if ($this->session->userdata('validation')) {
                ?>
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-ban"></i> <b>Gagal!</b></h4>
                        <b><?php echo $this->session->userdata('validation'); ?></b>
                    </div>
                <?php $this->session->unset_userdata('validation');
                } ?>
                <form id="konsultasi" method="post" action="<?php echo $action; ?>" enctype="multipart/form-data">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">[ <?php echo $gejala['kode_gejala']; ?> ] - Apakah <?php echo $gejala['nama_gejala']; ?> ?</h3>
                        </div>
                        <div class="box-body">
                            <!-- <div class="row"> -->
                            <div class="form-group">
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="answer" id="answer" value="0">
                                        Ya
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="answer" id="answer" value="1">
                                        Tidak
                                    </label>
                                </div>
                            </div>
                            <!-- </div> -->
                            <div style="float: right;">
                                <button type="submit" class="btn btn-primary btn-flat"><i class="fa fa-chevron-right"></i> Selanjutnya</button>
                                <?php if ($gejala['is_priority'] == 0) {
                                ?>
                                    <button type="reset" class="btn btn-warning btn-flat"><i class="fa fa-repeat"></i> Cek Penyakit</button>
                                <?php   } ?>
                                <!-- <button type="reset" class="btn btn-warning btn-flat"><i class="fa fa-repeat"></i> Reset</button> -->
                            </div>

                            <input type="hidden" name="child_gejala" id="child_gejala" value="<?php echo $gejala['id_ms_gejala']; ?>">
                            <input type="hidden" name="parent_gejala" id="parent_gejala" value="<?php echo $parent_gejala; ?>">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>

<?php

$data['modal_id'] = 'modal_gejala';
$data['modal_size'] = 'lg';
$data['modal_title'] = 'Form Gejala';
$this->load->view('include/modal', $data);

?>

<script>
    let _modal = $('#modal_gejala');
    $(document).on('click', '.btn-lihat', function() {
        let _url = $(this).attr('action');
        getViewModal(_url, _modal);
    });
</script>