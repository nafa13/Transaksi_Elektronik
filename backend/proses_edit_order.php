<?php
session_start();
include "backend.php";
$kode_order = (isset($_POST['kode_order'])) ? htmlentities($_POST['kode_order']) : "";
$meja = (isset($_POST['meja'])) ? htmlentities($_POST['meja']) : "";
$pelanggan = (isset($_POST['pelanggan'])) ? htmlentities($_POST['pelanggan']) : "";
// $catatan = (isset($_POST['catatan'])) ? htmlentities($_POST['catatan']) : "";

if (!empty($_POST['edit_order_validate'])) {
    $select = mysqli_query($conn, "SELECT *FROM tb_order WHERE id_order = '$kode_order'");
        $query = mysqli_query($conn, " UPDATE tb_order SET meja='$meja',pelanggan='$pelanggan' WHERE id_order ='$kode_order'");
        if ($query) {
            $massage = '<script>alert("sukses memasukandata data");
        window.location="../frontend/order"</script>';
        } else {
            $massage = '<script>alert("gagal memasukan data")</script>
            window.location="../frontend/order"</script>';
        }
    }

echo $massage;
