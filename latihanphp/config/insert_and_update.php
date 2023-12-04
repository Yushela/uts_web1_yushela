<?php
require_once '../koneksi/koneksi.php';

$nama_depan = $_POST['ndepan'];
$nama_belakang = $_POST['nbelakang'];
$email = $_POST['mail'];
$password = $_POST['pwd'];
$photo_name = $_FILES['filephoto']['name'];
$photo_tmp = $_FILES['filephoto']['tmp_name'];

if (!empty($_POST['id'])){
    //kalau id tidak kosong, maka update
try{
    move_uploaded_file($photo_tmp, '../photo/'.$photo_name);
    $sql = 'UPDATE `data_pendaftar` SET `nama_depan` = ?, `nama_belakang` = ?, `email` = ?, `password` = ?, `photo` = ? WHERE id = ?';
    $qonnect = $database_connection->prepare($sql);
    $qonnect->execute([$nama_depan, $nama_belakang, $email, sha1($password), 'photo/' . $photo_name, $_POST['id']]);

    echo"Data update succesfully!";
} catch(PDOException $err){
    die("Error updating data: " . $err->getMessage);
}
} else{
    //kalau kosong, insert
try{
    move_uploaded_file($photo_tmp, '../photo/'.$photo_name);
    $sql = 'INSERT INTO `data_pendaftar` (`nama_depan`, `nama_belakang`, `email`, `password`, `photo`)
    VALUES (?, ?, ?, ?, ?)';
    $qonnect = $database_connection->prepare($sql);
    $qonnect->execute([$nama_depan, $nama_belakang, $email, sha1($password), 'photo/' . $photo_name]);

    echo "Data inserted successfully!";
} catch (PDOException $err) {
    die("Error inserting data: " . $err->getMessage());
}
}

?>