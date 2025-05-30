<?php
session_start();
include "backend.php";
$kode_order = (isset($_POST['kode_order'])) ? htmlentities($_POST['kode_order']) : "";
$meja = (isset($_POST['meja'])) ? htmlentities($_POST['meja']) : "";
$pelanggan = (isset($_POST['pelanggan'])) ? htmlentities($_POST['pelanggan']) : "";
$catatan = (isset($_POST['catatan'])) ? htmlentities($_POST['catatan']) : "";
$menu = (isset($_POST['menu'])) ? htmlentities($_POST['menu']) : "";
$jumlah = (isset($_POST['jumlah'])) ? htmlentities($_POST['jumlah']) : "";

if (!empty($_POST['input_order_item_validate'])) {
    $select = mysqli_query($conn, "SELECT *FROM tb_list_order WHERE menu = '$menu' && kode_order=$kode_order");
    if (mysqli_num_rows($select) > 0) {
        $massage = '<script>alert("item telah ada ");
        window.location="../frontend/?x=orderitem&order=' . $kode_order . '&meja=' . $meja . '&pelanggan=' . $pelanggan . '"</script>';
    } else {
        $query = mysqli_query($conn, "INSERT INTO tb_list_order (menu,kode_order,jumlah,catatan) values('$menu','$kode_order','$jumlah','$catatan')");
        if ($query) {
            $massage = '<script>alert("sukses memasukandata data");
        window.location="../frontend/?x=orderitem&order=' . $kode_order . '&meja=' . $meja . '&pelanggan=' . $pelanggan . '"</script>';
        } else {
            $massage = '<script>alert("gagal memasukan data")
            window.location="../frontend/?x=orderitem&order=' . $kode_order . '&meja=' . $meja . '&pelanggan=' . $pelanggan . '"</script>';
        }
    }
}
echo $massage;
