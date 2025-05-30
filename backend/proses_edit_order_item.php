<?php
session_start();
include "backend.php";

$id = (isset($_POST['id'])) ? htmlentities($_POST['id']) : "";
$kode_order = (isset($_POST['kode_order'])) ? htmlentities($_POST['kode_order']) : "";
$meja = (isset($_POST['meja'])) ? htmlentities($_POST['meja']) : "";
$pelanggan = (isset($_POST['pelanggan'])) ? htmlentities($_POST['pelanggan']) : "";
$catatan = (isset($_POST['catatan'])) ? htmlentities($_POST['catatan']) : "";
$menu = (isset($_POST['menu'])) ? htmlentities($_POST['menu']) : "";
$jumlah = (isset($_POST['jumlah'])) ? htmlentities($_POST['jumlah']) : "";

if (!empty($_POST['edit_order_item_validate'])) {

    $query = mysqli_query($conn, "UPDATE tb_list_order SET menu='$menu',jumlah='$jumlah',catatan='$catatan' WHERE id_list_order='$id'");
    if ($query) {
        $massage = '<script>alert("sukses mengedit data");
        window.location="../frontend/?x=orderitem&order=' . $kode_order . '&meja=' . $meja . '&pelanggan=' . $pelanggan . '"</script>';
    } else {
        $massage = '<script>alert("gagal mengedit data")
            window.location="../frontend/?x=orderitem&order=' . $kode_order . '&meja=' . $meja . '&pelanggan=' . $pelanggan . '"</script>';
    }
}

echo $massage;
