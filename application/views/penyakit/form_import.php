<?php

defined('BASEPATH') or exit('No direct script access allowed');

?>

<form id="importPenyakit" method="post" action="<?php echo $action; ?>" enctype="multipart/form-data">

    <div class="form-group">
        <label for="penyakit">Import File</label>
        <input type="file" class="form-control rounded-0" name="upload" id="upload" placeholder="Import File">
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-primary btn-flat"><i class="fa fa-upload"></i> Import</button>
        <button type="reset" class="btn btn-warning btn-flat"><i class="fa fa-repeat"></i> Reset</button>
    </div>
</form>