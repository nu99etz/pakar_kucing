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

            <!-- Default box -->
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Form Konsultasi</h3>
                </div>
                <div class="box-body">
                    <table width="100%" class="table table-bordered table-hover">
                        <thead>
                            <th>No</th>
                            <th>Kategori Gejala</th>
                            <th>Nama Gejala</th>
                            <th>Jawaban</th>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($gejala as $key => $value) {
                                foreach ($value as $key_value => $value_gejala) {
                            ?>
                                    <tr>
                                        <td><?php echo $no; ?></td>
                                        <?php if ($key_value == 0) {
                                        ?>
                                            <td rowspan="<?php echo count($value); ?>" style="vertical-align : middle;text-align:center;"><?php echo $key; ?></td>
                                        <?php   } else {
                                        ?>
                                            <!-- <td></td> -->
                                        <?php   } ?>
                                        <td><?php echo "[ " . $value_gejala['kode_gejala'] . " ] - " . $value_gejala['nama_gejala']; ?></td>
                                        <td>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" name="jawaban[<?php echo $value_gejala['id_ms_gejala']; ?>]" id="jawaban" value="0">
                                                </label>
                                            </div>
                                        </td>
                                    </tr>
                            <?php $no++;
                                }
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