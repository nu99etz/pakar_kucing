<?php

defined('BASEPATH') or exit('No direct script access allowed');

if (!empty($aturan)) {
    $explode_gejala = explode(',', $aturan['gejala']);
    $list_gejala = $explode_gejala;
}

?>

<form id="aturan" method="post" action="<?php echo $action; ?>" enctype="multipart/form-data">

    <div class="form-group">
        <label for="nama_penyakit">Nama Penyakit</label>
        <select class="form-control rounded-0 select2" name="nama_penyakit" id="nama_penyakit" style="width: 100%;" data-placeholder="--PILIH PENYAKIT--">
            <option></option>
            <?php foreach ($penyakit as $key => $value) {
                if (!empty($aturan)) {
                    if ($aturan['id_ms_penyakit'] == $value['id_ms_penyakit']) {
            ?>
                        <option value="<?php echo $value['id_ms_penyakit']; ?>" selected><?php echo $value['kode_penyakit']; ?> - <?php echo $value['nama_penyakit']; ?></option>
                    <?php    } else {
                    ?>
                        <option value="<?php echo $value['id_ms_penyakit']; ?>"><?php echo $value['kode_penyakit']; ?> - <?php echo $value['nama_penyakit']; ?></option>
                    <?php }
                } else {
                    ?>
                    <option value="<?php echo $value['id_ms_penyakit']; ?>"><?php echo $value['kode_penyakit']; ?> - <?php echo $value['nama_penyakit']; ?></option>
                <?php        }
                ?>
            <?php   } ?>
        </select>
    </div>

    <div class="form-group">
        <label for="gejala">Gejala</label>
        <select class="form-control rounded-0 select2" name="gejala[]" id="gejala" style="width: 100%;" multiple="multiple" data-placeholder="--PILIH GEJALA--">
            <option></option>
            <?php foreach ($gejala as $key => $value) {
                if (!empty($list_gejala)) {
                    if (in_array($value['id_ms_gejala'], $list_gejala)) {
            ?>
                        <option value="<?php echo $value['id_ms_gejala']; ?>" selected><?php echo $value['kode_gejala']; ?> - <?php echo $value['nama_gejala']; ?></option>
                    <?php   } else {
                    ?>
                        <option value="<?php echo $value['id_ms_gejala']; ?>"><?php echo $value['kode_gejala']; ?> - <?php echo $value['nama_gejala']; ?></option>
                    <?php    }
                } else {
                    ?>
                    <option value="<?php echo $value['id_ms_gejala']; ?>"><?php echo $value['kode_gejala']; ?> - <?php echo $value['nama_gejala']; ?></option>
                <?php    }
                ?>
            <?php   } ?>
        </select>
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-primary btn-flat"><i class="fa fa-save"></i> Simpan</button>
        <button type="reset" class="btn btn-warning btn-flat"><i class="fa fa-repeat"></i> Reset</button>
    </div>

</form>

<script>
    $('.select2').select2();
</script>