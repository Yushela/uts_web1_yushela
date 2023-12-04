<?php
    require_once '../koneksi/koneksi.php';
    $id = $_POST['$id'];

    try {
        $sql = 'DELETE FROM data_register WHERE id = ?';
        $qonnect = $database_connection->prepare($sql);
        $qonnect->execute([$id]);

        echo "Data deleted successfully!";
    } catch (PDOException $err) {
        die ("Error updating data: ". $err->getMessage());
    }
?>