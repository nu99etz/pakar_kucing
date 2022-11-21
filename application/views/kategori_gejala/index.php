<?php

defined('BASEPATH') or exit('No direct script access allowed');

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Master Kategori Gejala
            <small>Master Kategori Gejala</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Master Kategori Gejala</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <!-- Default box -->
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Kategori Gejala</h3>
                    </div>
                    <div class="box-body">
                        <div style="float: right;">
                            <button action="<?php echo base_url(); ?>kategori_gejala/create" type="button" class="btn-add btn btn-flat btn-sm btn-success"><i class="fa fa-plus"></i> Tambah</button>
                        </div>
                        <br />
                        <br />
                        <table id="kategori_gejala" url="<?php echo base_url(); ?>kategori_gejala/ajax" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Kategori Gejala</th>
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

$data['modal_id'] = 'modal_kategori_gejala';
$data['modal_size'] = 'md';
$data['modal_title'] = 'Form Kategori Gejala';
$this->load->view('include/modal', $data);

?>

<script>
    let _table = $('#kategori_gejala');
    let _url = $('#kategori_gejala').attr('url');
    let _modal = $('#modal_kategori_gejala');

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

    $(document).on('click', '.btn-add', function() {
        let _url = $(this).attr('action');
        getViewModal(_url, _modal);
    });

    $(document).on('click', '.btn-import', function() {
        let _url = $(this).attr('action');
        getViewModal(_url, _modal);
    });

    $(document).on('click', '.btn-lihat', function() {
        let _url = $(this).attr('action');
        getViewModal(_url, _modal);
    });

    $(document).on('click', '.btn-edit', function() {
        let _url = $(this).attr('action');
        getViewModal(_url, _modal);
    });

    $(document).on('submit', 'form#kategori_gejala', function() {
        event.preventDefault();
        let _url = $(this).attr('action');
        let _data = new FormData($(this)[0]);
        send((data, xhr = null) => {
            if (data.status == 422) {
                FailedNotif(data.messages);
            } else if (data.status == 200) {
                SuccessNotif(data.messages);
                _modal.modal('hide');
                _table.DataTable().ajax.reload();
            }
        }, _url, 'json', 'post', _data);
    });

    $(document).on('click', '.btn-delete', function() {
        let _url = $(this).attr('action');
        console.log(_url);
        Swal.fire({
            title: 'Apakah Anda Yakin Menghapus Data Ini ?',
            showCancelButton: true,
            confirmButtonText: `Hapus`,
            confirmButtonColor: '#d33',
            icon: 'question'
        }).then((result) => {
            if (result.value) {
                send((data, xhr = null) => {
                    if (data.status == 200) {
                        Swal.fire("Sukses", data.messages, 'success');
                        _table.DataTable().ajax.reload();
                    }
                }, _url, "json", "get");
            }
        });
    });
</script>