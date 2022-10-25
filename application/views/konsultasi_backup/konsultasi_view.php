<div class="row">
    <div class="col-xs-12">

        <!-- Default box -->
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Indentitas Pemilik Hewan</h3>
            </div>
            <div class="box-body">
                <table id="gejala" class="table table-bordered table-hover">
                    <tr>
                        <th>Nama Pemilik</th>
                        <th>Nama Hewan</th>
                        <th>Usia</th>
                        <th>Tanggal Konsultasi</th>
                    </tr>
                    <tr>
                        <td><?php echo $konsultasi['konsultasi']['nama_pemilik_hewan']; ?></td>
                        <td><?php echo $konsultasi['konsultasi']['nama_hewan']; ?></td>
                        <td><?php echo $konsultasi['konsultasi']['usia_hewan']; ?></td>
                        <td><?php echo $konsultasi['konsultasi']['tanggal_konsultasi']; ?></td>
                    </tr>
                </table>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->

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
                    <?php foreach ($konsultasi['detail_gejala'] as $key => $value) {
                    ?>
                        <tr>
                            <td><?php echo $value['kode_gejala']; ?></td>
                            <td><?php echo $value['nama_gejala']; ?></td>
                            <td><?php if ($value['jawaban'] == 0) {
                                    echo "Ya";
                                } else if ($value['jawaban'] == 1) {
                                    echo "Tidak";
                                } ?></td>
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
                    <?php foreach ($konsultasi['detail_penyakit'] as $key => $value) {
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

    <div class="col-xs-12">
        <div style="float:right;">
            <div class="form-group">
                <button type="reset" class="btn btn-danger btn-flat" data-dismiss="modal"><i class="fa fa-close"></i> Tutup</button>
            </div>
        </div>
    </div>

</div>