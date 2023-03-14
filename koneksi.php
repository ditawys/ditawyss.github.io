<?php
    $host = "localhost";
    $user = "root";
    $pass = "";
    $database = "f55121098";
    $koneksi = mysqli_connect($host, $user, $pass, $database);
    // cek status koneksi
    if(mysqli_connect_errno()){
        echo "Koneksi Database Gagal:".mysqli_connect_error();
    }
?>