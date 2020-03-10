REST API sederhana dengan Code Igniter 3REST, 
singkatan bahasa Inggris dari Representational State Transfer

Pembuatan REST API memerlukan :
1. Xampp
2. Codeigniter dan Library Rest Server
3. Install postman

Pertama buatlah database kontak dengan kolom ‘id’ , ‘nama’, ‘nomor’, dan isi data nya terserah apa saja

Sql:
USE kontak;
CREATE TABLE IF NOT EXISTS `telepon` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`nama` varchar(50) NOT NULL,
`nomor` varchar(13) NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

USE kontak;
INSERT INTO `telepon` (`id`, `nama`, `nomor`) VALUES
(1, 'Orion', '08576666762'),
(2, 'Mars', '08576666770'),
(7, 'Alpha', '08576666765');

Lalu taruh code igniter di htdocs dan buka visual studio. Buka application/config dan ubah databasenya menjadi ‘kontak’ agar kita terhubung dengan database kontak.

Setelah itu coba akses rest server nya dengan
localhost/CI.3.E41181233_P4/rest_server/
Jika tampil seperti halamn diatas maka rest server berhasil dibuat.




Metode post
Untuk menambah data baru dari client ke server rest atau database
Metode post menggunakan method yang ada didalam application/controller/kontak.php

//Mengirim atau menambah data kontak baru
function index_post() {
$data = array(
'id' => $this->post('id'),
'nama' => $this->post('nama'),
'nomor' => $this->post('nomor'));
$insert = $this->db->insert('telepon', $data);
if ($insert) {
$this->response($data, 200);
} else {
$this->response(array('status' => 'fail', 502));
}

Codenya seperti diatas dan untuk menguji method post kita buka aplikasi postman. Pada address bar masukkan http://127.0.0.1/rest_ci/index.php/kontak ,  klik “Body” dan pilih x-www-form-urlencoded, masukkan key dan value yang mau dikirim (id,nama,nomor) dan klik send, jika data berhasil ditambahkan, gunakan method get untuk cek data.






Metode put
Untuk memperbaharui data yang sudah ada di REST API atau database.
Metode put menggunakan method yang ada didalam application/controller/kontak.php

//Memperbarui data kontak yang telah ada
function index_put() {
$id = $this->put('id');
$data = array(
'id' => $this->put('id'),
'nama' => $this->put('nama'),
'nomor' => $this->put('nomor'));
$this->db->where('id', $id);
$update = $this->db->update('telepon', $data);
if ($update) {
$this->response($data, 200);
} else {
$this->response(array('status' => 'fail', 502));
}
}

Codenya seperti diatas dan untuk menguji method put kita buka aplikasi postman. Pada address bar masukkan http://127.0.0.1/rest_ci/index.php/kontak ,  klik “Body” dan pilih x-www-form-urlencoded, masukkan key dan value yang mau diubah lalu tekan send, lalu masukkan value yang baru dan tekan send , jika data berhasil diupdate, gunakan method get untuk cek data.






Metode delete
Untuk menghapus data yang ada di REST API atau di database.
Metode delete menggunakan method yang ada didalam application/controller/kontak.php

//Menghapus salah satu data kontak
function index_delete() {
$id = $this->delete('id');
$this->db->where('id', $id);
$delete = $this->db->delete('telepon');
if ($delete) {
$this->response(array('status' => 'success'), 201);
} else {
$this->response(array('status' => 'fail', 502));
}
}

Codenya seperti diatas dan untuk menguji method delete kita buka aplikasi postman. Pada address bar masukkan http://127.0.0.1/rest_ci/index.php/kontak ,  klik “Body” dan pilih x-www-form-urlencoded, masukkan key id yang mau dihapus lalu tekan send ,jika data berhasil dihapus, gunakan method get untuk cek data.





Metode GET
untuk menampilkan data dari database. Sebelum data di tampilkan, method akan memeriksa pada address bar apakah ada property id atau tidak, jika ada maka data akan ditampilkan berdasakan id dan jika tidak, data akan ditampilkan semuanya.


Metode get menggunakan method yang ada didalam application/controller/kontak.php

<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;
class Kontak extends REST_Controller {
function __construct($config = 'rest') {
parent::__construct($config); $this->load->database(); }


//Menampilkan data kontak
function index_get() {
$id = $this->get('id');
if ($id == '') {
$kontak = $this->db->get('telepon')->result();
} else {
$this->db->where('id', $id);
$kontak = $this->db->get('telepon')->result();
}
$this->response($kontak, 200);

Codenya seperti diatas dan untuk menguji method get kita buka aplikasi postman yang sudah diinstal tadi.
Pada address bar masukkan http://127.0.0.1/rest_ci/index.php/kontak dan klik send, maka data akan ditampilkan semuanya
jika dimasukkan http://127.0.0.1/rest_ci/index.php/kontak?id=7 dan klik send maka yang ditampilkan data dengan id nomor 7 saja




