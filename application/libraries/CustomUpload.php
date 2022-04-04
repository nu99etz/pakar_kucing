<?php

defined('BASEPATH') or exit('No direct script access allowed');

class CustomUpload
{

  private $ci;

  public function __construct()
  {
    $this->ci = &get_instance();
  }


  public function Upload($name, $namefile = null, $dir)
  {

    // Check Folder
    if (!file_exists('./assets/'.$dir)) {
      $mkdir = mkdir('./assets/' . $dir, 0777);
      if (!$mkdir) {
        $respond = array(
          'status' => 'error',
          'messages' => 'Tidak Bisa Membuat Folder'
        );
      }
    }
    $config = array();
    $config['upload_path'] = './assets/' . $dir . '/';
    $config['allowed_types'] = '*';
    $ext = explode('.', $_FILES[$name]['name']);
    $x = strtolower(end($ext));
    if ($namefile != null) {
      $config['file_name'] = $dir . "$namefile";
    } else if ($namefile == null) {
      $config['file_name'] = $dir . date("M-y-d H:i:s") . '.' . $x;
    }
    $config['overwrite'] = true;
    $config['max_size'] = 5000;
    $this->ci->load->library('upload', $config);
    if ($this->ci->upload->do_upload($name)) {
      $respond =  array(
        'status' => 'ok',
        'file' => $this->ci->upload->data("file_name"),
        'debug' => $this->ci->upload->data()
      );
    } else {
      $respond = array(
        'status' => 'error',
        'messages' => $this->ci->upload->display_errors()
      );
    }
    return $respond;
  }
}
