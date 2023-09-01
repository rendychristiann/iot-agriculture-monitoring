<?php 
    //buat koneksi ke database
    $connect = mysqli_connect("localhost", "root", "", "dbsmartfarming");
    //baca data dari tabel db
    $sql = mysqli_query($connect, "select * from tb_sensor order by id desc"); //data terakhir berada di atas
    //baca data paling atas
    $data = mysqli_fetch_array($sql);
    $suhu = $data['suhu'];
    //uji, apabila nilai suhu belum ada, anggap nilai suhu = 0
    if($suhu == "") $suhu = 0;
    // Maksimum nilai suhu
    $maxSuhu = 50;
    $suhupercentage = ($suhu / $maxSuhu) * 100;
    $response = [
        'value' => $suhu,
        'maxValue' => $maxSuhu,
        'percentage' => $suhupercentage
    ];
    //cetak nilai suhu
    header('Content-Type: application/json');
    echo json_encode($response);
?>