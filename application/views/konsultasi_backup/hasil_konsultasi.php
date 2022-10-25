<?php

defined('BASEPATH') or exit('No direct script access allowed');

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Hasil Konsultasi
            <small>Hasil Konsultasi</small>
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
                <?php if (empty($jawabanYa) && empty($penyakit)) {
                    $alertColor = 'danger';
                    $alertNotif = 'Gagal';
                    $icon = 'fa-ban';
                    $msg = 'Penyakit Tidak Ditemukan !!!';
                ?>

                <?php   } else {
                    $alertColor = 'success';
                    $alertNotif = 'Sukses';
                    $icon = 'fa-check';

                    if (count($penyakit) > 1 && $kemungkinan == 0) {
                        $msg = 'Kemungkinan Ditemukan Beberapa Penyakit !!!';
                    } else if($kemungkinan == 0) {
                        $msg = 'Kemungkinan Penyakit Ditemukan !!!';
                    } else {
                        $msg = 'Penyakit Ditemukan !!!';
                    }
                } ?>
                <div class="alert alert-<?php echo $alertColor; ?> alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa <?php echo $icon; ?>"></i> <?php echo $alertNotif; ?></h4>
                    <?php echo $msg; ?>
                </div>
                <!-- Default box -->
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Gejala Yang Dipilih</h3>
                    </div>
                    <div class="box-body">
                        <table id="gejala" class="table table-bordered table-hover">
                            <tr>
                                <th>Kode Gejala</th>
                                <th>Nama Gejala</th>
                                <th>Jawaban</th>
                            </tr>
                            <?php foreach ($jawabanYa as $key => $value) {
                            ?>
                                <tr>
                                    <td><?php echo $value['gejala']['kode_gejala']; ?></td>
                                    <td><?php echo $value['gejala']['nama_gejala']; ?></td>
                                    <td><?php echo $value['jawaban']; ?></td>
                                </tr>
                            <?php   } ?>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->

                <!-- Default box -->
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Penyakit Yang Ditemukan</h3>
                    </div>
                    <div class="box-body">
                        <table id="penyakit" class="table table-bordered table-hover">
                            <tr>
                                <th>Kode Penyakit</th>
                                <th>Nama Penyakit</th>
                                <th>Pengobatan Penyakit</th>
                            </tr>
                            <?php foreach ($penyakit as $key => $value) {
                            ?>
                                <tr>
                                    <td><?php echo $value['kode_penyakit']; ?></td>
                                    <td><?php echo $value['nama_penyakit']; ?></td>
                                    <td><?php echo $value['pengobatan_penyakit']; ?></td>
                                </tr>
                            <?php   } ?>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>