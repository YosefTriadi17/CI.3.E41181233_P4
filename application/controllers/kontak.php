<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Kontak extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
    }

    //untuk Menampilkan data kontak
    function index_get() {
        $id = $this->get('id'); //jika terdeteksi ada data id
        if ($id == '') {
            $kontak = $this->db->get('telepon')->result();
        } else { //jika tidak
            $this->db->where('id', $id);
            $kontak = $this->db->get('telepon')->result();
        }
        $this->response($kontak, 200);
    }

     //untuk Mengirim atau menambah data kontak baru
     function index_post() {
        $data = array(
                    'id'           => $this->post('id'), //ambiil data id
                    'nama'          => $this->post('nama'), //ambiil data nama
                    'nomor'    => $this->post('nomor')); //ambiil data nomor
        $insert = $this->db->insert('telepon', $data); //insert ke database
        if ($insert) { //jika suskes
            $this->response($data, 200);
        } else { //jika tidak
            $this->response(array('status' => 'fail', 502));
        }
    }

     //untuk memperbarui data kontak yang telah ada
     function index_put() {
        $id = $this->put('id'); //ambil data id
        $data = array(
                    'id'       => $this->put('id'), //ambil data id
                    'nama'          => $this->put('nama'), //ambil data nama
                    'nomor'    => $this->put('nomor')); //ambil data nomor
        $this->db->where('id', $id); //tampilkan berdasarkan id
        $update = $this->db->update('telepon', $data); //proses uopdate database
        if ($update) { //jika sukses
            $this->response($data, 200);
        } else { //jika tidak
            $this->response(array('status' => 'fail', 502));
        }
    }

       //untuk Menghapus salah satu data kontak
       function index_delete() {
        $id = $this->delete('id');
        $this->db->where('id', $id); 
        $delete = $this->db->delete('telepon'); //hapus data database berdasarkan id
        if ($delete) { //jika sukses
            $this->response(array('status' => 'success'), 201);
        } else { //jika tidak
            $this->response(array('status' => 'fail', 502));
        }
    }
}
?>