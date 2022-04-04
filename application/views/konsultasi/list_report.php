<?php

defined('BASEPATH') or exit('No direct script access allowed');

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Laporan Konsultasi
            <small>Laporan Konsultasi</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Laporan Konsultasi</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <!-- Default box -->
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Laporan Konsultasi</h3>
                    </div>
                    <div class="box-body">
                        <table id="konsultasi" url="<?php echo base_url(); ?>rep_konsultasi/ajax" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Pemilik</th>
                                    <th>Nama Hewan</th>
                                    <th>Usia</th>
                                    <th>Tanggal Konsultasi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
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

<?php

$data['modal_id'] = 'modal_konsultasi';
$data['modal_size'] = 'lg';
$data['modal_title'] = 'Form Hasil Konsultasi';
$this->load->view('include/modal', $data);

?>

<script>
    let _table = $('#konsultasi');
    let _url = $('#konsultasi').attr('url');
    let _modal = $('#modal_konsultasi');

    _table.DataTable({
        language: {
            "decimal": "",
            "emptyTable": "Data kosong",
            "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
            "infoEmpty": "Menampilkan 0 sampai 0 dari 0 data",
            "infoFiltered": "(hasil dari _MAX_ total data)",
            "infoPostFix": "",
            "thousands": ",",
            "lengthMenu": "Menampilkan _MENU_ data",
            "loadingRecords": "Memuat...",
            "processing": "Memproses...",
            "search": "Cari:",
            "zeroRecords": "Tidak ada data yang sesuai",
            "paginate": {
                "first": "Pertama",
                "last": "Terakhir",
                "next": "Selanjutnya",
                "previous": "Sebelumnya"
            },
            "aria": {
                "sortAscending": ": mengurutkan dari terkecil",
                "sortDescending": ": mengurutkan dari terbesar"
            }
        },
        autoWidth: false,
        scrollX: true,
        processing: true,
        serverSide: false,
        order: [],
        ajax: {
            url: _url,
            type: "get",
            dataType: "json"
        },
        lengthMenu: [
            [10, 25, 50, 100],
            [10, 25, 50, 100]
        ],
        columnDefs: [{
            targets: [0],
            orderable: false
        }, ],
        paging: true,
        responsive: true,
    });

    $(document).on('click', '.btn-lihat', function() {
        let _url = $(this).attr('action');
        getViewModal(_url, _modal);
    });

</script>