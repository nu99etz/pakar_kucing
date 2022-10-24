<?php

defined('BASEPATH') or exit('No direct script access allowed');

if (empty($gejala)) {
    $nama_gejala = '';
    $is_utama = '';
    $is_priority = '';
} else {
    $nama_gejala = $gejala['nama_gejala'];
    $is_utama = $gejala['is_utama'];
    $is_priority = $gejala['is_priority'];
}

?>

<form id="gejala" method="post" action="<?php echo $action; ?>" enctype="multipart/form-data">

    <div class="form-group">
        <label for="nama_gejala">Nama Gejala</label>
        <input type="text" class="form-control rounded-0" name="nama_gejala" id="nama_gejala" placeholder="Nama Gejala" value="<?php echo $nama_gejala; ?>">
    </div>

    <div class="form-group">
        <label for="is_utama">Gejala Utama ?</label>
        <select class="form-control rounded-0 select2" name="is_utama" id="is_utama" style="width: 100%;">
        <?php if ($is_utama != '') {
                if ($is_utama == 0) {
            ?>
                    <option value="0" selected>Tidak</option>
                    <option value="1">Ya</option>
                <?php  } else {
                ?>
                    <option value="0">Tidak</option>
                    <option value="1" selected>Ya</option>
                <?php  }
            } else {
                ?>
                <option value="0">Tidak</option>
                <option value="1">Ya</option>
            <?php    } ?>
        </select>
    </div>

    <div class="form-group">
        <label for="is_priority">Gejala Prioritas ?</label>
        <select class="form-control rounded-0 select2" name="is_priority" id="is_priority" style="width: 100%;">
            <?php if ($is_priority != '') {
                if ($is_priority == 0) {
            ?>
                    <option value="0" selected>Tidak</option>
                    <option value="1">Ya</option>
                <?php  } else {
                ?>
                    <option value="0">Tidak</option>
                    <option value="1" selected>Ya</option>
                <?php  }
            } else {
                ?>
                <option value="0">Tidak</option>
                <option value="1">Ya</option>
            <?php    } ?>
        </select>
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-primary btn-flat"><i class="fa fa-save"></i> Simpan</button>
        <button type="reset" class="btn btn-warning btn-flat"><i class="fa fa-repeat"></i> Reset</button>
    </div>

</form>

<script>
    CKEDITOR.replace('penjelasan_gejala');
</script>