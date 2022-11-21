<?php

defined('BASEPATH') or exit('No direct script access allowed');

if (empty($kategori_gejala)) {
    $nama_kategori_gejala = '';
} else {
    $nama_kategori_gejala = $kategori_gejala['nama_ms_kategori'];
}

?>

<form id="kategori_gejala" method="post" action="<?php echo $action; ?>" enctype="multipart/form-data">

    <div class="form-group">
        <label for="nama_ms_kategori">Nama Kategori Gejala</label>
        <input type="text" class="form-control rounded-0" name="nama_ms_kategori" id="nama_ms_kategori" placeholder="Nama Kategori Gejala" value="<?php echo $nama_kategori_gejala; ?>">
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-primary btn-flat"><i class="fa fa-save"></i> Simpan</button>
        <button type="reset" class="btn btn-warning btn-flat"><i class="fa fa-repeat"></i> Reset</button>
    </div>

</form>