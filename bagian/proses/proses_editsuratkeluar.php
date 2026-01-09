<?php
session_start();
include '../../koneksi/koneksi.php';

$id                             = mysqli_real_escape_string($db, $_POST['id_suratkeluar']);
$tanggalkeluar_suratkeluar      = mysqli_real_escape_string($db, $_POST['tanggalkeluar_suratkeluar']);
$kode_suratkeluar               = mysqli_real_escape_string($db, $_POST['kode_suratkeluar']);
$nomor_suratkeluar              = mysqli_real_escape_string($db, $_POST['nomor_suratkeluar']);
$nama_bagian                    = mysqli_real_escape_string($db, $_POST['nama_bagian']);
$tanggalsurat_suratkeluar       = mysqli_real_escape_string($db, $_POST['tanggalsurat_suratkeluar']);
$kepada_suratkeluar             = mysqli_real_escape_string($db, $_POST['kepada_suratkeluar']);
$perihal_suratkeluar            = mysqli_real_escape_string($db, $_POST['perihal_suratkeluar']);
$operator                       = mysqli_real_escape_string($db, $_POST['operator']);
$file_suratkeluar               = $_FILES['file_suratkeluar']['name'];

date_default_timezone_set('Asia/Jakarta');
$tanggal_entry  = date("Y-m-d H:i:s");
$thnNow         = date("Y");
$tgl_keluar     = date('Y-m-d H:i:s', strtotime($tanggalkeluar_suratkeluar));
$tgl_surat      = date('Y-m-d', strtotime($tanggalsurat_suratkeluar));
$ambilnomor     = substr($nomor_suratkeluar, 0, 4);

$sql    = "SELECT * FROM tb_suratkeluar WHERE id_suratkeluar='".$id."' AND nama_bagian='".$_SESSION['nama']."'";
$query  = mysqli_query($db, $sql);
$data   = mysqli_fetch_array($query);

if (!$data) {
    echo "<Center><h2><br>Data tidak ditemukan atau Anda tidak berhak mengedit data ini</h2></center>
    <meta http-equiv='refresh' content='2;url=../datasuratkeluar.php'>";
    exit;
}

if ($file_suratkeluar == '') {
    $ext     = substr($data['file_suratkeluar'], strripos($data['file_suratkeluar'], '.'));
    $nama_b  = $thnNow.'-'.$ambilnomor.$ext;
    rename("../../admin/surat_keluar/".$data['file_suratkeluar'], "../../admin/surat_keluar/".$nama_b);
    $sqlUpdate = "UPDATE tb_suratkeluar SET 
                    tanggalkeluar_suratkeluar   = '$tgl_keluar',
                    kode_suratkeluar            = '$kode_suratkeluar',
                    nomor_suratkeluar           = '$nomor_suratkeluar',
                    nama_bagian                 = '$nama_bagian',
                    tanggalsurat_suratkeluar    = '$tgl_surat',
                    kepada_suratkeluar          = '$kepada_suratkeluar',
                    perihal_suratkeluar         = '$perihal_suratkeluar',
                    operator                    = '$operator',
                    tanggal_entry               = '$tanggal_entry',
                    file_suratkeluar            = '$nama_b'
                WHERE id_suratkeluar = $id";
    mysqli_query($db, $sqlUpdate);
    echo "<Center><h2><br>Data Surat Keluar telah diubah</h2></center>
    <meta http-equiv='refresh' content='2;url=../detail-suratkeluar.php?id_suratkeluar=".$id."'>";
} else {
    $tipe_file   = $_FILES['file_suratkeluar']['type'];
    $ukuran_file = $_FILES['file_suratkeluar']['size'];
    if (($tipe_file == "application/pdf") and ($ukuran_file <= 10340000)) {
        unlink("../../admin/surat_keluar/".$data['file_suratkeluar']);
        $ext_file  = substr($file_suratkeluar, strripos($file_suratkeluar, '.'));
        $tmp_file  = $_FILES['file_suratkeluar']['tmp_name'];
        $nama_baru = $thnNow.'-'.$ambilnomor.$ext_file;
        $path      = "../../admin/surat_keluar/".$nama_baru;
        move_uploaded_file($tmp_file, $path);
        $sqlUpdate = "UPDATE tb_suratkeluar SET 
                        tanggalkeluar_suratkeluar   = '$tgl_keluar',
                        kode_suratkeluar            = '$kode_suratkeluar',
                        nomor_suratkeluar           = '$nomor_suratkeluar',
                        nama_bagian                 = '$nama_bagian',
                        tanggalsurat_suratkeluar    = '$tgl_surat',
                        kepada_suratkeluar          = '$kepada_suratkeluar',
                        perihal_suratkeluar         = '$perihal_suratkeluar',
                        operator                    = '$operator',
                        tanggal_entry               = '$tanggal_entry',
                        file_suratkeluar            = '$nama_baru'
                    WHERE id_suratkeluar = $id";
        mysqli_query($db, $sqlUpdate);
        echo "<Center><h2><br>Data Surat Keluar telah diubah</h2></center>
        <meta http-equiv='refresh' content='2;url=../detail-suratkeluar.php?id_suratkeluar=".$id."'>";
    } else {
        echo "<Center><h2><br>File yang anda masukkan tidak sesuai ketentuan<br>Silahkan Ulangi</h2></center>
        <meta http-equiv='refresh' content='2;url=../editsuratkeluar.php?id_suratkeluar=".$id."'>";
    }
}

