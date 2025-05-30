<?php
session_start();
include "backend.php";
$kode_order = (isset($_POST['kode_order'])) ? htmlentities($_POST['kode_order']) : "";
$meja = (isset($_POST['meja'])) ? htmlentities($_POST['meja']) : "";
$pelanggan = (isset($_POST['pelanggan'])) ? htmlentities($_POST['pelanggan']) : "";
$total = (isset($_POST['total'])) ? htmlentities($_POST['total']) : "";
$uang = (isset($_POST['uang'])) ? htmlentities($_POST['uang']) : "";
$kembalian = $uang - $total;

if (!empty($_POST['bayar_validate'])) {
    if ($kembalian < 0) {
        $massage = '<script>alert("nominal uang tidak mencukupi ");
        window.location="../frontend/?x=orderitem&order=' . $kode_order . '&meja=' . $meja . '&pelanggan=' . $pelanggan . '"</script>';
    } else {
        $query = mysqli_query($conn, "INSERT INTO tb_bayar (id_bayar,nominal_uang,total_bayar) values('$kode_order','$uang','$total')");
        if ($query) {
            $massage = '<script>alert("pembayaran sukses \nkembalian RP.'.$kembalian.'");
            window.location="../frontend/?x=orderitem&order=' . $kode_order . '&meja=' . $meja . '&pelanggan=' . $pelanggan . '"</script>';
        } else {
            $massage = '<script>alert("pembayaran gagal")
                window.location="../frontend/?x=orderitem&order=' . $kode_order . '&meja=' . $meja . '&pelanggan=' . $pelanggan . '"</script>';
        }
    }
}
echo $massage;
