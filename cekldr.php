<?php 
    //buat koneksi ke database
    $connect = mysqli_connect("localhost", "root", "", "dbsmartfarming");
    //baca data dari tabel db
    $sql = mysqli_query($connect, "select * from tb_sensor order by id desc"); //data terakhir berada di atas
    //baca data paling atas
    $data = mysqli_fetch_array($sql);
    $ldr = $data['ldr'];
    //uji, apabila nilai suhu belum ada, anggap nilai suhu = 0
    if($ldr == "") $ldr = 0;
    $maxldr = 4095;
    $ldrpercentage = ($ldr / $maxldr) * 100;
    $response = [
        'value' => $ldr,
        'maxValue' => $maxldr,
        'percentage' => $ldrpercentage
    ];
    //cetak nilai suhu
    header('Content-Type: application/json');
    echo json_encode($response);
?>