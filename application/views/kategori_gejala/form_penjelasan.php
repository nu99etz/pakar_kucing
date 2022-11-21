<div class="row">
    <div class="col-xs-12">
        <!-- Default box -->
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Penjelasan Gejala <?php echo $gejala['nama_gejala']; ?></h3>
            </div>
            <div class="box-body">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Nama Gejala</th>
                            <th>Penjelasan Gejala</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?php echo $gejala['kode_gejala'] . ' - ' . $gejala['nama_gejala']; ?></td>
                            <td><?php echo $gejala['penjelasan_gejala']; ?></td>
                        </tr>
                    </tbody>
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