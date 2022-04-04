/*
    Custom JS Created By Nugraha
*/


// Send Ajax Handler
let send = (result, _url, _dataType = "", _type = "get", _data = []) => {
    $.ajax({
        url: _url,
        type: _type,
        data: _data,
        dataType: _dataType,
        processData: false,
        contentType: false,
        success: (response, responseText, xhr) => {

            result(response, xhr);

        },
        error: (xhr) => {
            FailedNotif(JSON.parse(xhr.responseText), xhr);
        }
    })
}

// View Modal
let getViewModal = (_url, _modal) => {
    send((response, xhr = null) => {
        _modal.find('.modal-body').html(response);
        _modal.modal('show');
    }, _url, "html");
}

// View HTML To Element
let getViewHTML = (_url, _element) => {
    send((response, xhr = null) => {
        _element.html(response);
    }, _url, "html");
}


// DataTables Handler
let DataTables = (_table_id, _dataType = "json") => {
    let _all_column = $(_table_id).find('thead').find('th');
    let _url = $(_table_id).attr('url');
    let _column = [];
    $.each(_all_column, function (index, value) {
        data = _all_column.eq(index).data('column');
        name = _all_column.eq(index).data('name');
        search = _all_column.eq(index).data('searchable');
        order = _all_column.eq(index).data('orderable');

        _column.push({
            data: data,
            name: (name != 'undefined') ? name : data,
            orderable: order,
            searchable: search
        });
        
    });

    let table = $(_table_id).DataTable({
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
        serverSide: true,
        order: [],
        ajax: {
            url: _url,
            type: "post",
            dataType: _dataType,
        },
        columns: _column,
        lengthMenu: [[5, 10, 25, 50, 100], [5, 10, 25, 50, 100]],
        columnDefs: [{
            targets: [0],
            orderable: false
        },
        ],
        paging: true,
    });

    $('.dataTables_filter input').unbind();
    $('.dataTables_filter input').bind('keyup', function (e) {
        if (e.keyCode === 13) {
            table.search(this.value).draw();
        }
    })
}


// Init Toastr Biar Tidak Dobel
let initToastr = () => {
    toastr.options = {
        maxOpened: 1,
        preventDuplicates: 1,
        autoDismiss: true
    };
    return toastr;
}

// Notifikasi Sukses
let SuccessNotif = (messages) => {
    toastr = initToastr();
    toastr.success(messages);
}

// Notifikasi Gagal
let FailedNotif = (messages) => {
    // var error_messages = "";
    toastr = initToastr();
    // $.each(messages, function (index, value) {
    //     error_messages += value + "<br/>"
    // })
    toastr.error(messages);
}