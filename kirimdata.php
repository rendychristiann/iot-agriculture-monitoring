<?php 
    //buat koneksi ke database
    $connect = mysqli_connect("localhost", "root", "", "dbsmartfarming");
    //baca data yang dikirim dari ESP32
    $suhu = $_GET['suhu'];
    $kelembaban = $_GET['kelembaban'];
    $ldr = $_GET['ldr'];
    $tanah = $_GET['tanah'];
    //simpan ke tabel tb_sensor
    
    //auto increment = 1
    mysqli_query($connect, "ALTER TABLE tb_sensor AUTO_INCREMENT = 1");
    //simpan data sensor ke tabel tb_sensor
    $simpan = mysqli_query($connect, "insert into tb_sensor(suhu, kelembaban, ldr, tanah)values('$suhu', '$kelembaban', '$ldr', '$tanah')");
    //uji simpan untuk memberikan respon
    if($simpan)
        echo "Berhasil terkirim";
    else
        echo "Gagal terkirim";
?>