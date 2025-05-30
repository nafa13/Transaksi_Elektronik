<?php
session_start();
include "backend.php";
$kode_order = (isset($_POST['kode_order'])) ? htmlentities($_POST['kode_order']) : "";
$meja = (isset($_POST['meja'])) ? htmlentities($_POST['meja']) : "";
$pelanggan = (isset($_POST['pelanggan'])) ? htmlentities($_POST['pelanggan']) : "";


if (!empty($_POST['input_order_validate'])) {
    $select = mysqli_query($conn, "SELECT *FROM tb_order WHERE id_order = '$kode_order'");
    if (mysqli_num_rows($select) > 0) {
        $massage = '<script>alert("order telah ada ");
        window.location="../frontend/order"</script>';
    } else {
        $query = mysqli_query($conn, "INSERT INTO tb_order (id_order,meja,pelanggan,pelayan) values('$kode_order','$meja','$pelanggan','$_SESSION[id_kopiku]')");
        if ($query) {
            $massage = '<script>alert("sukses memasukandata data");
        window.location="../frontend/?x=orderitem&order='.$kode_order.'&meja='.$meja.'&pelanggan='.$pelanggan.'"</script>';
        } else {
            $massage = '<script>alert("gagal memasukan data")</script>
            window.location="../frontend/order"</script>';
        }
    }
}
echo $massage;
