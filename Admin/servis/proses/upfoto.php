<?php 
include '../../../database/config.php';
 
session_start();
 
if($_SESSION['status'] !="Login"){
  header("location:../../login/index.php");
}

$username = $_SESSION['username'];
$foto = $_FILES['foto']['name'];
$tmp = $_FILES['foto']['tmp_name'];

// Rename nama fotonya dengan menambahkan tanggal dan jam upload
$fotobaru = "$username.jpg";

// Set path folder tempat menyimpan fotonya
$path = "../../../assets/image/fotoservis".$fotobaru;

// Proses upload
if(move_uploaded_file($tmp, $path)){ // Cek apakah gambar berhasil diupload atau tidak
  // Proses simpan ke Database
  $query = "UPDATE `servis` SET `foto`='$fotobaru' WHERE id ='$username'";
  $updatefoto = mysqli_query($koneksi, $query); // Eksekusi/ Jalankan query dari variabel $query
  if($updatefoto){ // Cek jika proses simpan ke database sukses atau tidak
    // Jika Sukses, Lakukan :
    header("location:../../dashboard/index.php?foto=berhasil"); // Redirect ke halaman index.php
  }else{
    // Jika Gagal, Lakukan :
    header("location:../../dashboard/index.php?foto=gagal");
  }
}else{
  // Jika gambar gagal diupload, Lakukan :
  header("location:../../dashboard/index.php?foto=gagal");
}