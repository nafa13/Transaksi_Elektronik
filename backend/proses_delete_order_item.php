<?php
include "backend.php";
$id = (isset($_POST['id'])) ? htmlentities($_POST['id']) : "";
$kode_order = (isset($_POST['kode_order'])) ? htmlentities($_POST['kode_order']) : "";
$meja = (isset($_POST['meja'])) ? htmlentities($_POST['meja']) : "";
$pelanggan = (isset($_POST['pelanggan'])) ? htmlentities($_POST['pelanggan']) : "";


if (!empty($_POST['delete_order_item_validate'])) {
    $query = mysqli_query($conn, "DELETE FROM tb_list_order WHERE id_list_order = '$id'");
    if ($query) {
        $massage = '<script>alert("sukses menghapus data");
        window.location="../frontend/?x=orderitem&order=' . $kode_order . '&meja=' . $meja . '&pelanggan=' . $pelanggan . '"</script>';
    } else {
        $massage = '<script>alert("gagal menghapus data")
            window.location="../frontend/?x=orderitem&order=' . $kode_order . '&meja=' . $meja . '&pelanggan=' . $pelanggan . '"</script>';
    }
}

echo $massage;
