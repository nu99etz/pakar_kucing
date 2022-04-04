<?php

defined('BASEPATH') or exit('No direct script access allowed');

if (empty($penyakit)) {
    $nama_penyakit = '';
    $pengobatan_penyakit = '';
} else {
    $nama_penyakit = $penyakit['nama_penyakit'];
    $pengobatan_penyakit = $penyakit['pengobatan_penyakit'];
}

?>

<form id="penyakit" method="post" action="<?php echo $action; ?>" enctype="multipart/form-data">

    <div class="form-group">
        <label for="nama_penyakit">Nama Penyakit</label>
        <input type="text" class="form-control rounded-0" name="nama_penyakit" id="nama_penyakit" placeholder="Nama Penyakit" value="<?php echo $nama_penyakit; ?>">
    </div>

    <div class="form-group">
        <label for="pengobatan_penyakit">Pengobatan Penyakit</label>
        <textarea class="form-control" name="pengobatan_penyakit" id="pengobatan_penyakit" placeholder="Pengobatan Penyakit"><?php echo $pengobatan_penyakit; ?></textarea>
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-primary btn-flat"><i class="fa fa-save"></i> Simpan</button>
        <button type="reset" class="btn btn-warning btn-flat"><i class="fa fa-repeat"></i> Reset</button>
    </div>

</form>

<script>
    CKEDITOR.replace('pengobatan_penyakit');
</script>