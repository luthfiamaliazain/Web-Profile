<?php 
include '../../../database/config.php';
session_start();
 
if($_SESSION['status'] !="Login"){
	header("location:../../login/index.php");
}

// membuat variabel untuk menampung data dari form
	
	$id = $_GET['id'];
	$info = $_POST['info'];
	$foto = $_FILES['foto']['name'];
	 //cek dulu jika ada gambar produk jalankan coding ini
if($foto != "") {
  $ekstensi_diperbolehkan = array('png','jpg'); //ekstensi file gambar yang bisa diupload 
  $x = explode('.', $foto); //memisahkan nama file dengan ekstensi yang diupload
  $ekstensi = strtolower(end($x));
  $file_tmp = $_FILES['foto']['tmp_name'];   
  $angka_acak     = rand(1,999);
  $nama_foto_baru = $angka_acak.'-'.$foto; //menggabungkan angka acak dengan nama file sebenarnya
        if(in_array($ekstensi, $ekstensi_diperbolehkan) === true)  {     
                move_uploaded_file($file_tmp, '../../../assets/img/fotoservis/'.$nama_foto_baru); //
                      
                    // jalankan query UPDATE berdasarkan ID yang produknya kita edit
                   $query  = "UPDATE servis SET `foto` = '$nama_foto_baru', `info` = '$info'";
                    $query .= "WHERE id = '$id'";
                    $masuk = mysqli_query($koneksi, $query);
                    // periska query apakah ada error
                    if(!$masuk){
                        die ("Query gagal dijalankan: ".mysqli_errno($koneksi).
                             " - ".mysqli_error($koneksi));
                    } else {
                      //tampil alert dan akan redirect ke halaman index.php
                      //silahkan ganti index.php sesuai halaman yang akan dituju
                      echo "<script>alert('Data berhasil diubah.');window.location='../index.php';</script>";
                    }
              } else {     
               //jika file ekstensi tidak jpg dan png maka alert ini yang tampil
                  echo "<script>alert('Ekstensi gambar yang boleh hanya jpg atau png.');window.location='editdataservis.php';</script>";
              }
    } else {
      // jalankan query UPDATE berdasarkan ID yang produknya kita edit
      $query  = "UPDATE servis SET `info` = '$info'";
      $query .= "WHERE id = '$id'";
      $masuk = mysqli_query($koneksi, $query);
      // periska query apakah ada error
      if(!$masuk){
            die ("Query gagal dijalankan: ".mysqli_errno($koneksi).
                             " - ".mysqli_error($koneksi));
      } else {
        //tampil alert dan akan redirect ke halaman index.php
        //silahkan ganti index.php sesuai halaman yang akan dituju
          echo "<script>alert('Data berhasil diubah.');window.location='../index.php';</script>";
      }
    }

 ?>