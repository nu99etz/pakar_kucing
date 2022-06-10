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
                        <b><?php echo $this->session->userdata('validation');?></b>
                    </div>
                <?php $this->session->unset_userdata('validation');  } ?>
                <div class="alert alert-info alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-info"></i> <b>Pemberitahuan!</b></h4>
                    <b>Harap Untuk Mengisi Data Diri Hewan Terlebih Dahulu<br /></b>
                    <b>Silahkan Memilih Minimal 6 Gejala</b>
                </div>
                <form id="konsultasi" method="post" action="<?php echo $action; ?>" enctype="multipart/form-data">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Data Diri Pasien</h3>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <input type="hidden" name="id_konsul" id="id_konsul" value="<?php echo $idKonsul; ?>">
                                <div class="col-xs-4">
                                    <div class="form-group">
                                        <label for="nama_pemilik_hewan">Nama Pemilik</label>
                                        <input type="text" class="form-control rounded-0" name="nama_pemilik_hewan" id="nama_pemilik_hewan" placeholder="Nama Pemilik">
                                    </div>
                                </div>

                                <div class="col-xs-4">
                                    <div class="form-group">
                                        <label for="nama_hewan">Nama Hewan</label>
                                        <input type="text" class="form-control rounded-0" name="nama_hewan" id="nama_hewan" placeholder="Nama Hewan">
                                    </div>
                                </div>

                                <div class="col-xs-4">
                                    <div class="form-group">
                                        <label for="usia_hewan">Usia Hewan</label>
                                        <input type="number" class="form-control rounded-0" name="usia_hewan" id="usia_hewan" placeholder="Usia Hewan">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Default box -->
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Pilih Konsultasi</h3>
                        </div>
                        <div class="box-body">
                            <table id="konsultasi_tbl" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Gejala</th>
                                        <th>Penjelasan Gejala</th>
                                        <th>Jawaban</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    foreach ($gejala as $value) {
                                    ?>
                                        <tr>
                                            <td>
                                                <?php echo $no; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['kode_gejala'] . " - " . $value['nama_gejala']; ?>
                                            </td>
                                            <td>
                                                <?php if ($value['penjelasan_gejala'] == '') {
                                                ?>
                                                    -
                                                <?php   } else {
                                                ?>
                                                    <button type="button" action="<?php echo base_url(); ?>konsultasi/penjelasan_gejala/<?php echo $value['id']; ?>" class="btn-lihat btn btn-flat btn-primary btn-sm"><i class="fa fa-eye"></i> Lihat Penjelasan Gejala</button>
                                                <?php    } ?>
                                            </td>
                                            <td>
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" name="jawaban[<?php echo $value['id']; ?>]" id="jawaban" value="0">
                                                        Ya
                                                    </label>
                                                    <label>
                                                        <input type="checkbox" name="jawaban[<?php echo $value['id']; ?>]" id="jawaban" value="1">
                                                        Tidak
                                                    </label>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php $no++;
                                    } ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="4">
                                            <div style="float: right;">
                                                <button type="submit" class="btn btn-primary btn-flat"><i class="fa fa-save"></i> Simpan</button>
                                                <button type="reset" class="btn btn-warning btn-flat"><i class="fa fa-repeat"></i> Reset</button>
                                            </div>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
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