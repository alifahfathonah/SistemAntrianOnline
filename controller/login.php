<?php
session_start(); // Start session nya
include "../config/config.php"; 
$email = $_POST['email']; // Ambil value username yang dikirim dari form
$password = $_POST['password']; // Ambil value password yang dikirim dari form
// Buat query untuk mengecek apakah ada data user dengan username dan password yang dikirim dari form

$data = mysqli_query($mysqli, "SELECT * FROM users WHERE email='$email' AND password='$password'");
$data =  mysqli_fetch_array($data);
// Cek apakah variabel $data ada datanya atau tidak
if(!empty($data)){ // Jika tidak sama dengan empty (kosong)
  $_SESSION['email'] = $data['email']; // Set session untuk username (simpan username di session)
  $_SESSION['nama'] = $data['name']; // Set session untuk nama (simpan nama di session)
  
  setcookie("message","delete",time()-1); // Kita delete cookie message
  
  header("location: ../views/dash.php"); // Kita redirect ke halaman welcome.php
}else{ // Jika $data nya kosong
  // Buat sebuah cookie untuk menampung data pesan kesalahan
  setcookie("message", "Maaf, Email atau Password salah", time()+3600);
  
  header("location: ../views/index.php"); // Redirect kembali ke halaman index.php
}
?>