
let Select2Custom = () => {
  
}
$('#tempat_lahir').select2({
  placeholder: '-- PILIH KOTA/KAB --',
  ajax: {
    url: "<?php echo base_url(); ?>master/kab_kota/ajax_select2/all",
    dataType: "json",
    processResults: function (data) {
      return {
        results: data
      }
    }
  },
  theme: "bootstrap4",
});

$('#agama').select2({
  placeholder: '-- PILIH AGAMA --',
  ajax: {
    url: "<?php echo base_url(); ?>master/agama/ajax_select2",
    dataType: "json",
    processResults: function (data) {
      return {
        results: data
      }
    }
  },
  theme: "bootstrap4",
});

$('#jenis_kelamin').select2({
  placeholder: '-- PILIH JENIS KELAMIN --',
  ajax: {
    url: "<?php echo base_url(); ?>kepegawain/pegawai/gender_select2",
    dataType: "json",
    processResults: function (data) {
      return {
        results: data
      }
    }
  },
  theme: "bootstrap4",
});

$('#wn').select2({
  placeholder: '-- PILIH WARGA KEWARGANEGARAAN --',
  ajax: {
    url: "<?php echo base_url(); ?>master/negara/ajax_select2",
    dataType: "json",
    processResults: function (data) {
      return {
        results: data
      }
    }
  },
  theme: "bootstrap4",
});

$('#status_perkawinan').select2({
  placeholder: '-- PILIH STATUS PERKAWINAN --',
  ajax: {
    url: "<?php echo base_url(); ?>master/status_pernikahan/ajax_select2",
    dataType: "json",
    processResults: function (data) {
      return {
        results: data
      }
    }
  },
  theme: "bootstrap4",
});