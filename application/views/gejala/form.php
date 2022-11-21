<?php

defined('BASEPATH') or exit('No direct script access allowed');

if (empty($gejala)) {
    $nama_gejala = '';
    $id_kategori_gejala = '';
} else {
    $nama_gejala = $gejala['nama_gejala'];
    $id_kategori_gejala = $gejala['id_ms_kategori_gejala'];
}

?>

<form id="gejala" method="post" action="<?php echo $action; ?>" enctype="multipart/form-data">

    <div class="form-group">
        <label for="is_utama">Kategori Gejala</label>
        <select class="form-control rounded-0 select2" name="id_ms_kategori_gejala" id="id_ms_kategori_gejala" style="width: 100%;" data-placeholder="--PILIH KATEGORI GEJALA--">
            <?php foreach ($kategori_gejala as $key => $value) {
            ?>
                <?php if ($id_kategori_gejala != "" && $id_kategori_gejala == $value['id_ms_kategori_gejala']) {
                ?>
                    <option value="<?php echo $value['id_ms_kategori_gejala']; ?>" selected><?php echo $value['nama_ms_kategori']; ?></option>
                <?php } else {
                ?>
                    <option value="<?php echo $value['id_ms_kategori_gejala']; ?>"><?php echo $value['nama_ms_kategori']; ?></option>
                <?php } ?>
            <?php } ?>
        </select>
    </div>

    <div class="form-group">
        <label for="nama_gejala">Nama Gejala</label>
        <input type="text" class="form-control rounded-0" name="nama_gejala" id="nama_gejala" placeholder="Nama Gejala" value="<?php echo $nama_gejala; ?>">
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-primary btn-flat"><i class="fa fa-save"></i> Simpan</button>
        <button type="reset" class="btn btn-warning btn-flat"><i class="fa fa-repeat"></i> Reset</button>
    </div>

</form>

<script>
    CKEDITOR.replace('penjelasan_gejala');
    $('.select2').select2();
</script>