<?php 
    //buat koneksi ke database
    $connect = mysqli_connect("localhost", "root", "", "dbsmartfarming");
    //baca data dari tabel db
    $sql = mysqli_query($connect, "select * from tb_sensor order by id desc"); //data terakhir berada di atas
    //baca data paling atas
    $data = mysqli_fetch_array($sql);
    $kelembaban = $data['kelembaban'];
    //uji, apabila nilai suhu belum ada, anggap nilai kelembaban = 0
    if($kelembaban == "") $kelembaban = 0;
    //Maksimum nilai kelembaban
    $maxKelembaban = 80;
    $kelembabanpercentage = ($kelembaban / $maxKelembaban) * 100;
    $response = [
        'value' => $kelembaban,
        'maxValue' => $maxKelembaban,
        'percentage' => $kelembabanpercentage
    ];
    //cetak nilai suhu
    header('Content-Type: application/json');
    echo json_encode($response);
?>