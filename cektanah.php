<?php 
    //buat koneksi ke database
    $connect = mysqli_connect("localhost", "root", "", "dbsmartfarming");
    //baca data dari tabel db
    $sql = mysqli_query($connect, "select * from tb_sensor order by id desc"); //data terakhir berada di atas
    //baca data paling atas
    $data = mysqli_fetch_array($sql);
    $tanah = $data['tanah'];
    //uji, apabila nilai suhu belum ada, anggap nilai ldr = 0
    if($tanah == "") $tanah = 0;
    
    $maxtanah = 1023;
    $tanahpercentage = ($tanah / $maxtanah) * 100;
    $response = [
        'value' => $tanah,
        'maxValue' => $maxtanah,
        'percentage' => $tanahpercentage
    ];
    //cetak nilai suhu
    header('Content-Type: application/json');
    echo json_encode($response);
?>