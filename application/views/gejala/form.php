<?php

defined('BASEPATH') or exit('No direct script access allowed');

if (empty($gejala)) {
    $nama_gejala = '';
    $penjelasan_gejala = '';
} else {
    $nama_gejala = $gejala['nama_gejala'];
    $penjelasan_gejala = $gejala['penjelasan_gejala'];
}

?>

<form id="gejala" method="post" action="<?php echo $action; ?>" enctype="multipart/form-data">

    <div class="form-group">
        <label for="nama_gejala">Nama Gejala</label>
        <input type="text" class="form-control rounded-0" name="nama_gejala" id="nama_gejala" placeholder="Nama Gejala" value="<?php echo $nama_gejala; ?>">
    </div>

    <div class="form-group">
        <label for="penjelasan_gejala">Penjelasan Gejala</label>
        <textarea class="form-control" name="penjelasan_gejala" id="penjelasan_gejala" placeholder="Penjelasan Gejala"><?php echo $penjelasan_gejala; ?></textarea>
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-primary btn-flat"><i class="fa fa-save"></i> Simpan</button>
        <button type="reset" class="btn btn-warning btn-flat"><i class="fa fa-repeat"></i> Reset</button>
    </div>
</form>

<script>
    CKEDITOR.replace('penjelasan_gejala');
</script>